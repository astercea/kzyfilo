/**
 * kzyfilo — Araç Karşılaştırma ve Listem Sayfası JavaScript Modülü
 * KZY Executive Motion — Redesigned Fleet Comparison System
 */

(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        initVehicleCompare();
        initFavoritesListPage();
    });

    // ─── Araç Karşılaştırma Sayfası ─────────────────────────────────
    function initVehicleCompare() {
        const tableWrapper = document.getElementById('compare-table-wrapper');
        const emptyState = document.getElementById('compare-empty-state');
        const toolbar = document.getElementById('compare-toolbar');
        const highlightToggle = document.getElementById('toggle-compare-diff');
        const clearBtn = document.getElementById('btn-clear-compare');
        const shareBtn = document.getElementById('btn-share-compare');
        const openPickerBtn = document.getElementById('btn-open-picker');

        // Modal elements
        const pickerModal = document.getElementById('modal-vehicle-picker');
        const closePickerBtn = document.getElementById('btn-close-picker-modal');
        const pickerSearchInput = document.getElementById('picker-search-input');
        const pickerFilterBtns = document.querySelectorAll('.picker-filter-btn');
        const pickerVehiclesGrid = document.getElementById('picker-vehicles-grid');

        if (!tableWrapper || !window.allVehiclesData) return;

        const MAX_SLOTS = 4;
        let pickerActiveCategory = 'all';
        let activeCompareIds = [];

        // Sayfa açıldığında URL'den veya localStorage'dan araçları al, ardından localStorage'ı temizle
        (function initCompareList() {
            const urlParams = new URLSearchParams(window.location.search);
            const idsParam = urlParams.get('ids') || urlParams.get('araclar');
            if (idsParam) {
                const parsedIds = idsParam.split(',').map(id => parseInt(id.trim(), 10)).filter(id => !isNaN(id));
                if (parsedIds.length > 0) {
                    activeCompareIds = parsedIds.slice(0, MAX_SLOTS);
                }
            } else if (window.KZYFavorites) {
                activeCompareIds = window.KZYFavorites.getCompareList().slice(0, MAX_SLOTS);
            }

            // Karşılaştırma sayfasına girildiği anda alt menüyü tamamen temizle ve kapat
            if (window.KZYFavorites) {
                window.KZYFavorites.saveCompareList([]);
            }
        })();

        function renderComparison() {
            const vehicles = window.allVehiclesData.filter(v => activeCompareIds.includes(v.id));

            if (vehicles.length === 0) {
                tableWrapper.classList.add('hidden');
                if (toolbar) toolbar.classList.add('hidden');
                if (emptyState) emptyState.classList.remove('hidden');
                return;
            }

            tableWrapper.classList.remove('hidden');
            if (toolbar) toolbar.classList.remove('hidden');
            if (emptyState) emptyState.classList.add('hidden');

            const theadRow = document.getElementById('compare-table-head-row');
            const tbody = document.getElementById('compare-table-body');
            if (!theadRow || !tbody) return;

            const hasEmptySlot = vehicles.length < MAX_SLOTS;
            const baseUrl = window.KZY?.baseUrl || '/';

            const totalColumns = vehicles.length + (hasEmptySlot ? 1 : 0);
            const colWidth = (100 / totalColumns).toFixed(3) + '%';

            // ─── Thead (SADECE ARAÇ SÜTUNLARI - EŞİT VE SABİT BOYUTLAR) ───
            theadRow.innerHTML = '';

            vehicles.forEach(function (v) {
                const th = document.createElement('th');
                th.style.width = colWidth;
                th.innerHTML = `
                    <div class="compare-vehicle-header">
                        <button type="button" class="compare-vehicle-remove btn-remove-compare" data-id="${v.id}" title="Karşılaştırmadan Çıkar" aria-label="${v.brand} ${v.model} aracını çıkar">
                            <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                        <div class="compare-vehicle-img-wrap">
                            <img src="${v.image}" alt="${v.brand} ${v.model}" width="220" height="120">
                        </div>
                    </div>
                `;
                theadRow.appendChild(th);
            });

            // If slots remain, show minimal empty add slot
            if (hasEmptySlot) {
                const addTh = document.createElement('th');
                addTh.style.width = colWidth;
                addTh.innerHTML = `
                    <div class="compare-empty-slot" id="btn-slot-open-picker" title="Katalogdan Araç Ekle">
                        <div class="compare-empty-slot-icon">+</div>
                        <div class="compare-empty-slot-title">+ Araç Ekle</div>
                    </div>
                `;
                theadRow.appendChild(addTh);

                const slotBtn = addTh.querySelector('#btn-slot-open-picker');
                if (slotBtn) {
                    slotBtn.addEventListener('click', openPicker);
                }
            }

            // ─── Tbody Rows (Düz Liste - Kategori Başlıkları Olmadan) ───
            const specRows = [
                { label: 'Marka & Model', getValue: v => `<strong>${v.brand} ${v.model}</strong>` },
                { label: 'Donanım / Versiyon', getValue: v => v.version || '—' },
                { label: 'Kategori', getValue: v => (v.category ? v.category.toUpperCase() : 'BİNEK') },
                { label: 'Segment', getValue: v => v.segment || '—' },
                { label: 'Kasa Tipi', getValue: v => (v.body ? v.body.toUpperCase() : '—') },
                { label: 'Koltuk Sayısı', getValue: v => `${v.seats || 5} Kişi` },
                { label: 'Bagaj Hacmi', getValue: v => v.luggage || '—' },
                { label: 'Hızlı Teslimat', getValue: v => (v.is_fast_delivery ? '✓ Stokta Hazır' : 'Standart Sipariş') },
                { label: 'Yakıt Türü', getValue: v => (v.fuel ? v.fuel.toUpperCase() : '—') },
                { label: 'Vites Tipi', getValue: v => (v.transmission ? v.transmission.toUpperCase() : '—') },
                { label: 'Motor Hacmi', getValue: v => v.specs?.engine?.['Motor Hacmi'] || '—' },
                { label: 'Maksimum Güç', getValue: v => v.specs?.engine?.['Maksimum Güç'] || '—' },
                { label: 'Maksimum Tork', getValue: v => v.specs?.engine?.['Maksimum Tork'] || '—' },
                { label: 'Ortalama Tüketim', getValue: v => v.specs?.fuel_performance?.['Ortalama Tüketim'] || '—' },
                { label: '0-100 Hızlanma', getValue: v => v.specs?.fuel_performance?.['0-100 Hızlanma'] || '—' },
                { label: 'Hava Yastığı', getValue: v => v.specs?.safety?.['Hava Yastığı'] || '6 Adet' },
                { label: 'Fren Destek Sistemleri', getValue: v => v.specs?.safety?.['Fren Sistemi'] || 'ABS, ESP, Hill Holder' },
                { label: 'Multimedya & Ekran', getValue: v => v.specs?.interior?.['Multimedya'] || 'Dokunmatik Ekran & CarPlay' },
                { label: 'Hız Sabitleyici', getValue: v => v.specs?.interior?.['Hız Sabitleyici'] || 'Cruise Control' },
                { label: 'Aylık Başlangıç Kirası', getValue: v => `<span style="font-size: 1.25rem; font-weight: 800; color: var(--color-orange);">${v.starting_price.toLocaleString('tr-TR')} ₺</span> <span style="font-size: 0.78rem; color: var(--color-text-muted);">/ ay + KDV</span>` },
                { label: 'Hızlı Başvuru', getValue: v => `<a href="${baseUrl}hizli-teklif.php?arac=${v.slug}" class="btn btn-primary btn-sm" style="padding: 8px 24px; font-size: 13px; font-weight: 700; display: inline-flex;">Teklif Al</a>` }
            ];

            tbody.innerHTML = '';

            // Group Rows (Kategori başlıkları olmadan doğrudan özellik sıralaması)
            specRows.forEach(function (row) {
                const tr = document.createElement('tr');
                const values = vehicles.map(v => row.getValue(v));
                const allSame = values.every(val => val === values[0]);

                if (!allSame && vehicles.length > 1) {
                    tr.classList.add('has-diff');
                }

                let rowHtml = '';
                values.forEach(val => {
                    rowHtml += `
                        <td>
                            <div class="compare-cell-label">${row.label}</div>
                            <div class="compare-cell-value">${val}</div>
                        </td>
                    `;
                });

                if (hasEmptySlot) {
                    rowHtml += `
                        <td class="compare-cell-empty">
                            <div class="compare-cell-label">${row.label}</div>
                            <div class="compare-cell-value text-muted">—</div>
                        </td>
                    `;
                }

                tr.innerHTML = rowHtml;
                tbody.appendChild(tr);
            });

            // Event listener: Remove button ✕
            tableWrapper.querySelectorAll('.btn-remove-compare').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const id = parseInt(this.getAttribute('data-id'), 10);
                    activeCompareIds = activeCompareIds.filter(itemId => itemId !== id);
                    renderComparison();

                    if (window.showToast) {
                        window.showToast('Araç karşılaştırmadan çıkarıldı.', 'primary');
                    }
                });
            });

            checkHighlight();
        }

        function checkHighlight() {
            if (!highlightToggle) return;
            const diffRows = tableWrapper.querySelectorAll('tbody tr.has-diff');
            if (highlightToggle.checked) {
                diffRows.forEach(r => r.classList.add('is-different'));
            } else {
                diffRows.forEach(r => r.classList.remove('is-different'));
            }
        }

        if (highlightToggle) {
            highlightToggle.addEventListener('change', checkHighlight);
        }

        // ─── Modal Vehicle Picker Logic ─────────────────────────────
        function openPicker() {
            if (!pickerModal) return;
            pickerModal.classList.add('is-open');
            renderPickerVehicles();
        }

        function closePicker() {
            if (!pickerModal) return;
            pickerModal.classList.remove('is-open');
        }

        function renderPickerVehicles() {
            if (!pickerVehiclesGrid || !window.allVehiclesData) return;

            const query = (pickerSearchInput ? pickerSearchInput.value : '').toLowerCase().trim();

            const filtered = window.allVehiclesData.filter(v => {
                const matchesCat = (pickerActiveCategory === 'all' || v.category === pickerActiveCategory);
                const titleStr = `${v.brand} ${v.model} ${v.version || ''}`.toLowerCase();
                const matchesQuery = !query || titleStr.includes(query);
                return matchesCat && matchesQuery;
            });

            pickerVehiclesGrid.innerHTML = '';

            if (filtered.length === 0) {
                pickerVehiclesGrid.innerHTML = '<div style="grid-column: 1/-1; text-align: center; padding: 24px; color: var(--color-text-muted);">Aramanıza uygun araç bulunamadı.</div>';
                return;
            }

            filtered.forEach(v => {
                const isAlreadyIn = activeCompareIds.includes(v.id);
                const card = document.createElement('div');
                card.className = 'picker-card';
                card.innerHTML = `
                    <img src="${v.image}" alt="${v.brand} ${v.model}" width="160" height="75">
                    <span class="badge badge-accent mb-1" style="font-size: 10px;">${v.segment || 'C Segment'}</span>
                    <div style="font-size: 0.88rem; font-weight: 700; color: var(--color-navy-950); margin-bottom: 2px;">${v.brand} ${v.model}</div>
                    <div style="font-size: 0.75rem; color: var(--color-text-muted); margin-bottom: 6px;">${v.starting_price.toLocaleString('tr-TR')} ₺ / ay</div>
                    <button type="button" class="btn ${isAlreadyIn ? 'btn-ghost' : 'btn-primary'} btn-sm btn-picker-select" data-id="${v.id}" ${isAlreadyIn ? 'disabled' : ''} style="width: 100%; font-size: 11px; padding: 6px 10px;">
                        ${isAlreadyIn ? '✓ Ekli' : '+ Karşılaştır'}
                    </button>
                `;
                pickerVehiclesGrid.appendChild(card);
            });

            pickerVehiclesGrid.querySelectorAll('.btn-picker-select:not([disabled])').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = parseInt(this.getAttribute('data-id'), 10);
                    if (activeCompareIds.length >= MAX_SLOTS) {
                        if (window.showToast) {
                            window.showToast(`En fazla ${MAX_SLOTS} araç karşılaştırabilirsiniz.`, 'error');
                        }
                        return;
                    }
                    if (!activeCompareIds.includes(id)) {
                        activeCompareIds.push(id);
                        renderComparison();
                        closePicker();
                        if (window.showToast) {
                            window.showToast('Araç karşılaştırmaya eklendi.', 'success');
                        }
                    }
                });
            });
        }

        if (openPickerBtn) openPickerBtn.addEventListener('click', openPicker);
        if (closePickerBtn) closePickerBtn.addEventListener('click', closePicker);
        if (pickerModal) {
            pickerModal.addEventListener('click', function (e) {
                if (e.target === pickerModal) closePicker();
            });
        }

        if (pickerSearchInput) {
            pickerSearchInput.addEventListener('input', renderPickerVehicles);
        }

        pickerFilterBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                pickerFilterBtns.forEach(b => b.classList.remove('is-active'));
                this.classList.add('is-active');
                pickerActiveCategory = this.getAttribute('data-cat');
                renderPickerVehicles();
            });
        });

        // Clear all button
        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                activeCompareIds = [];
                renderComparison();
                if (window.showToast) {
                    window.showToast('Karşılaştırma listesi temizlendi.', 'primary');
                }
            });
        }

        // Share comparison button
        if (shareBtn) {
            shareBtn.addEventListener('click', function () {
                if (activeCompareIds.length === 0) return;
                const shareUrl = window.location.origin + window.location.pathname + '?ids=' + activeCompareIds.join(',');
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(shareUrl).then(() => {
                        if (window.showToast) {
                            window.showToast('Karşılaştırma bağlantısı panoya kopyalandı.', 'success');
                        }
                    });
                }
            });
        }

        renderComparison();
    }

    // ─── Listem (Favoriler) Sayfası ─────────────────────────────────
    function initFavoritesListPage() {
        const grid = document.getElementById('favorites-vehicle-grid');
        const emptyState = document.getElementById('favorites-empty-state');
        const clearAllBtn = document.getElementById('btn-clear-favorites');
        const shareListBtn = document.getElementById('btn-share-list');

        if (!grid || !window.allVehiclesData) return;

        function renderFavorites() {
            const favoriteIds = window.KZYFavorites ? window.KZYFavorites.getFavorites() : [];
            const vehicles = window.allVehiclesData.filter(v => favoriteIds.includes(v.id));

            if (vehicles.length === 0) {
                grid.classList.add('hidden');
                if (emptyState) emptyState.classList.remove('hidden');
                return;
            }

            grid.classList.remove('hidden');
            if (emptyState) emptyState.classList.add('hidden');

            grid.innerHTML = '';
            vehicles.forEach(function (v) {
                const card = document.createElement('div');
                card.className = 'vehicle-card';
                card.setAttribute('data-id', v.id);
                card.innerHTML = `
                    <div class="vehicle-card-image">
                        <a href="${window.KZY.baseUrl}arac-detay.php?slug=${v.slug}">
                            <img src="${v.image}" alt="${v.brand} ${v.model}" width="360" height="225">
                        </a>
                        <div class="vehicle-card-actions-top">
                            <button type="button" class="vehicle-card-action-btn is-active btn-favorite-toggle" data-id="${v.id}" title="Listeden Çıkar">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            </button>
                        </div>
                    </div>
                    <div class="vehicle-card-body">
                        <div class="vehicle-card-brand">${v.brand}</div>
                        <h3 class="vehicle-card-model"><a href="${window.KZY.baseUrl}arac-detay.php?slug=${v.slug}">${v.model}</a></h3>
                        <div class="vehicle-card-footer">
                            <div class="vehicle-card-price">
                                <span class="vehicle-card-price-label">Aylık (Demo)</span>
                                <div class="vehicle-card-price-value">${v.starting_price.toLocaleString('tr-TR')} ₺</div>
                            </div>
                            <div class="flex gap-2">
                                <a href="${window.KZY.baseUrl}hizli-teklif.php?arac=${v.slug}" class="btn btn-primary btn-sm">Teklif Al</a>
                                <a href="${window.KZY.baseUrl}arac-detay.php?slug=${v.slug}" class="btn btn-secondary btn-sm">İncele</a>
                            </div>
                        </div>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        if (clearAllBtn) {
            clearAllBtn.addEventListener('click', function () {
                if (window.KZYFavorites) {
                    window.KZYFavorites.saveFavorites([]);
                    renderFavorites();
                    if (window.showToast) {
                        window.showToast('Tüm liste temizlendi.', 'primary');
                    }
                }
            });
        }

        if (shareListBtn) {
            shareListBtn.addEventListener('click', function () {
                const favs = window.KZYFavorites ? window.KZYFavorites.getFavorites() : [];
                const shareUrl = window.location.origin + window.location.pathname + '?ids=' + favs.join(',');
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(shareUrl).then(() => {
                        if (window.showToast) {
                            window.showToast('Liste bağlantısı panoya kopyalandı.', 'success');
                        }
                    });
                }
            });
        }

        window.addEventListener('kzy:favorites-updated', renderFavorites);
        renderFavorites();
    }

})();
