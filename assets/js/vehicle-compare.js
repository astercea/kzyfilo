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
        const activeView = document.getElementById('favorites-active-view');
        const emptyView = document.getElementById('favorites-empty-view');
        const heroMetrics = document.getElementById('favorites-hero-metrics');
        const grid = document.getElementById('favorites-vehicle-grid');

        // Header Metrics
        const metricTotalCount = document.getElementById('metric-total-count');
        const metricTotalPrice = document.getElementById('metric-total-price');

        // Summary Sidebar
        const summaryCount = document.getElementById('summary-vehicle-count');
        const summarySubtotal = document.getElementById('summary-subtotal');
        const summaryVat = document.getElementById('summary-vat');
        const summaryGrandTotal = document.getElementById('summary-grand-total');
        const summaryChips = document.getElementById('fav-summary-chips-container');

        // Toolbar Elements
        const filterTabs = document.querySelectorAll('.fav-filter-tab');
        const sortSelect = document.getElementById('fav-sort-select');
        const btnViewGrid = document.getElementById('btn-view-grid');
        const btnViewList = document.getElementById('btn-view-list');
        const clearAllBtn = document.getElementById('btn-clear-favorites');
        const shareListBtn = document.getElementById('btn-share-list');
        const printListBtn = document.getElementById('btn-print-list');
        const exportCompareBtn = document.getElementById('btn-export-compare');
        const bulkQuoteTriggers = document.querySelectorAll('.btn-bulk-quote-trigger');

        // Tab counts
        const countTabAll = document.getElementById('count-tab-all');
        const countTabBinek = document.getElementById('count-tab-binek');
        const countTabTicari = document.getElementById('count-tab-ticari');
        const countTabEv = document.getElementById('count-tab-ev');

        // Bulk Quote Modal
        const bulkModal = document.getElementById('modal-bulk-quote');
        const closeBulkModalBtn = document.getElementById('btn-close-bulk-modal');
        const bulkModalChips = document.getElementById('modal-vehicle-chips-list');
        const bulkModalForm = document.getElementById('bulk-quote-modal-form');

        // Quick add buttons in empty state
        const quickAddBtns = document.querySelectorAll('.btn-quick-add-favorite');

        if (!grid || !window.allVehiclesData) return;

        let currentCategory = 'all';
        let currentSort = 'default';
        let currentViewMode = localStorage.getItem('kzy_fav_view') || 'grid';

        // URL'den 'ids' parametresi varsa ve localStorage boşsa aktar
        (function checkUrlIds() {
            const urlParams = new URLSearchParams(window.location.search);
            const idsParam = urlParams.get('ids');
            if (idsParam && window.KZYFavorites) {
                const parsedIds = idsParam.split(',').map(id => parseInt(id.trim(), 10)).filter(id => !isNaN(id));
                if (parsedIds.length > 0) {
                    const currentFavs = window.KZYFavorites.getFavorites();
                    const merged = Array.from(new Set([...currentFavs, ...parsedIds]));
                    window.KZYFavorites.saveFavorites(merged);
                }
            }
        })();

        function applyViewMode(mode) {
            currentViewMode = mode;
            localStorage.setItem('kzy_fav_view', mode);

            if (mode === 'list') {
                grid.classList.add('is-list-view');
                if (btnViewList) btnViewList.classList.add('is-active');
                if (btnViewGrid) btnViewGrid.classList.remove('is-active');
            } else {
                grid.classList.remove('is-list-view');
                if (btnViewGrid) btnViewGrid.classList.add('is-active');
                if (btnViewList) btnViewList.classList.remove('is-active');
            }
        }

        function renderFavorites() {
            const favoriteIds = window.KZYFavorites ? window.KZYFavorites.getFavorites() : [];
            const allVehicles = window.allVehiclesData || [];
            const favoritedVehicles = allVehicles.filter(v => favoriteIds.includes(v.id));

            // Eğer liste boşsa
            if (favoritedVehicles.length === 0) {
                if (activeView) activeView.classList.add('hidden');
                if (heroMetrics) heroMetrics.classList.add('hidden');
                if (emptyView) emptyView.classList.remove('hidden');
                updateTabCounts([]);
                return;
            }

            // Liste doluysa
            if (emptyView) emptyView.classList.add('hidden');
            if (activeView) activeView.classList.remove('hidden');
            if (heroMetrics) heroMetrics.classList.remove('hidden');

            // Tab sayaçlarını güncelle
            updateTabCounts(favoritedVehicles);

            // Filtreleme (Kategoriye Göre)
            let filtered = favoritedVehicles.filter(v => {
                if (currentCategory === 'all') return true;
                if (currentCategory === 'binek') return v.category === 'binek';
                if (currentCategory === 'ticari') return v.category === 'ticari';
                if (currentCategory === 'ev') {
                    return v.fuel === 'elektrik' || v.fuel === 'hibrit' || (v.category === 'ev');
                }
                return true;
            });

            // Sıralama
            if (currentSort === 'price-asc') {
                filtered.sort((a, b) => (a.starting_price || 0) - (b.starting_price || 0));
            } else if (currentSort === 'price-desc') {
                filtered.sort((a, b) => (b.starting_price || 0) - (a.starting_price || 0));
            } else if (currentSort === 'brand-asc') {
                filtered.sort((a, b) => `${a.brand} ${a.model}`.localeCompare(`${b.brand} ${b.model}`, 'tr'));
            }

            // Maliyet & Sayı Hesaplamaları (Tüm favori araçlar üzerinden)
            let totalMonthly = favoritedVehicles.reduce((sum, v) => sum + (v.starting_price || 0), 0);
            let vatAmount = Math.round(totalMonthly * 0.20);
            let grandTotal = totalMonthly + vatAmount;

            // Header Metrikleri Güncelle
            if (metricTotalCount) metricTotalCount.textContent = favoritedVehicles.length;
            if (metricTotalPrice) metricTotalPrice.textContent = totalMonthly.toLocaleString('tr-TR');

            // Sidebar Özetini Güncelle
            if (summaryCount) summaryCount.textContent = `${favoritedVehicles.length} Adet`;
            if (summarySubtotal) summarySubtotal.textContent = `${totalMonthly.toLocaleString('tr-TR')} ₺ / ay`;
            if (summaryVat) summaryVat.textContent = `${vatAmount.toLocaleString('tr-TR')} ₺ / ay`;
            if (summaryGrandTotal) summaryGrandTotal.textContent = `${grandTotal.toLocaleString('tr-TR')} ₺ / ay`;

            // Sidebar Mini Araç Chip'leri
            if (summaryChips) {
                summaryChips.innerHTML = '';
                favoritedVehicles.forEach(v => {
                    const chip = document.createElement('div');
                    chip.className = 'fav-summary-chip';
                    chip.innerHTML = `
                        <img src="${v.image}" alt="${v.brand} ${v.model}" width="28" height="18">
                        <span>${v.brand} ${v.model}</span>
                        <button type="button" class="fav-chip-remove btn-remove-fav" data-id="${v.id}" title="Listeden Çıkar">
                            <svg viewBox="0 0 24 24" width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    `;
                    summaryChips.appendChild(chip);
                });
            }

            // Modal İçi Araç Chip'leri
            if (bulkModalChips) {
                bulkModalChips.innerHTML = '';
                favoritedVehicles.forEach(v => {
                    const chip = document.createElement('div');
                    chip.className = 'modal-vehicle-chip';
                    chip.innerHTML = `
                        <span class="chip-dot"></span>
                        <strong>${v.brand} ${v.model}</strong>
                        <span class="chip-price">(${v.starting_price.toLocaleString('tr-TR')} ₺/ay)</span>
                    `;
                    bulkModalChips.appendChild(chip);
                });
            }

            // Araç Kartlarını Render Et
            grid.innerHTML = '';

            if (filtered.length === 0) {
                grid.innerHTML = `
                    <div class="fav-no-cat-results">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <p>Bu kategoride favoriye eklenmiş araç bulunmuyor.</p>
                        <button type="button" class="btn btn-outline btn-sm" id="btn-reset-cat-filter">Tüm Araçları Göster</button>
                    </div>
                `;
                const resetCatBtn = document.getElementById('btn-reset-cat-filter');
                if (resetCatBtn) {
                    resetCatBtn.addEventListener('click', () => {
                        currentCategory = 'all';
                        filterTabs.forEach(t => t.classList.toggle('is-active', t.getAttribute('data-cat') === 'all'));
                        renderFavorites();
                    });
                }
                return;
            }

            const baseUrl = window.KZY?.baseUrl || '/';
            const compareList = window.KZYFavorites ? window.KZYFavorites.getCompareList() : [];

            filtered.forEach(v => {
                const isCompared = compareList.includes(v.id);
                const detailUrl = `${baseUrl}arac-detay.php?slug=${v.slug}`;
                const quoteUrl = `${baseUrl}hizli-teklif.php?arac=${v.slug}`;

                const card = document.createElement('div');
                card.className = 'fav-vehicle-card';
                card.setAttribute('data-id', v.id);

                card.innerHTML = `
                    <div class="fav-card-image-wrap">
                        <a href="${detailUrl}" class="fav-card-image-link" tabindex="-1">
                            <img src="${v.image}" alt="${v.brand} ${v.model}" width="340" height="200" loading="lazy">
                        </a>
                        <div class="fav-card-badges">
                            ${v.is_campaign ? '<span class="badge badge-primary">Kampanyalı</span>' : ''}
                            ${v.is_fast_delivery ? '<span class="badge badge-success">Hemen Teslim</span>' : ''}
                            ${v.is_premium ? '<span class="badge badge-info">Premium</span>' : ''}
                            <span class="badge badge-accent">${v.segment || 'Filo'}</span>
                        </div>
                        <button type="button" class="fav-card-remove-btn btn-remove-fav" data-id="${v.id}" title="Favorilerden Çıkar" aria-label="Favorilerden Çıkar">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>

                    <div class="fav-card-content">
                        <div class="fav-card-header">
                            <div class="fav-card-brand">${v.brand}</div>
                            <h3 class="fav-card-title">
                                <a href="${detailUrl}">${v.model}</a>
                            </h3>
                            <div class="fav-card-version">${v.version || ''}</div>
                        </div>

                        <div class="fav-card-specs">
                            <div class="fav-spec-item" title="Yakıt Türü">
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="22" x2="15" y2="22"></line><line x1="4" y1="9" x2="14" y2="9"></line><path d="M14 22V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v18"></path><path d="M14 13h2a2 2 0 0 1 2 2v2a2 2 0 0 0 2 2h0a2 2 0 0 0 2-2V9.83a2 2 0 0 0-.59-1.42L18 5"></path></svg>
                                <span>${v.fuel || 'Benzin'}</span>
                            </div>
                            <div class="fav-spec-item" title="Vites Türü">
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="6" cy="6" r="3"></circle><circle cx="6" cy="18" r="3"></circle><circle cx="18" cy="6" r="3"></circle><line x1="6" y1="9" x2="6" y2="15"></line><line x1="9" y1="6" x2="15" y2="6"></line></svg>
                                <span>${v.transmission || 'Otomatik'}</span>
                            </div>
                            <div class="fav-spec-item" title="Gövde Tipi">
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C2.1 11 2 11.5 2 12v4c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><circle cx="17" cy="17" r="2"></circle></svg>
                                <span>${v.body || 'Sedan'}</span>
                            </div>
                        </div>

                        <div class="fav-card-footer">
                            <div class="fav-card-price-block">
                                <span class="fav-price-label">Aylık Başlangıç Fiyatı</span>
                                <div class="fav-price-val">
                                    <strong>${v.starting_price.toLocaleString('tr-TR')} ₺</strong>
                                    <small>+ KDV / ay</small>
                                </div>
                            </div>

                            <div class="fav-card-actions">
                                <a href="${quoteUrl}" class="btn btn-primary btn-sm fav-action-quote">
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                    <span>Teklif Al</span>
                                </a>

                                <button type="button" class="btn ${isCompared ? 'btn-secondary' : 'btn-outline'} btn-sm btn-card-toggle-compare" data-id="${v.id}">
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v18"></path><path d="M6 7l6-3 6 3"></path><path d="M3 13l3-6 3 6a3 3 0 0 1-6 0z"></path><path d="M15 13l3-6 3 6a3 3 0 0 1-6 0z"></path><path d="M4 21h16"></path></svg>
                                    <span>${isCompared ? '✓ Karşılaştırılıyor' : 'Karşılaştır'}</span>
                                </button>

                                <a href="${detailUrl}" class="btn btn-ghost btn-sm" title="Detaylı İncele">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                `;

                grid.appendChild(card);
            });

            applyViewMode(currentViewMode);
        }

        function updateTabCounts(allFavs) {
            const total = allFavs.length;
            const binek = allFavs.filter(v => v.category === 'binek').length;
            const ticari = allFavs.filter(v => v.category === 'ticari').length;
            const ev = allFavs.filter(v => v.fuel === 'elektrik' || v.fuel === 'hibrit' || v.category === 'ev').length;

            if (countTabAll) countTabAll.textContent = total;
            if (countTabBinek) countTabBinek.textContent = binek;
            if (countTabTicari) countTabTicari.textContent = ticari;
            if (countTabEv) countTabEv.textContent = ev;
        }

        // ─── Event Listeners ────────────────────────────────────────

        // Filter Tabs
        filterTabs.forEach(tab => {
            tab.addEventListener('click', function () {
                filterTabs.forEach(t => t.classList.remove('is-active'));
                this.classList.add('is-active');
                currentCategory = this.getAttribute('data-cat') || 'all';
                renderFavorites();
            });
        });

        // Sort Select
        if (sortSelect) {
            sortSelect.addEventListener('change', function () {
                currentSort = this.value;
                renderFavorites();
            });
        }

        // View Mode Toggle
        if (btnViewGrid) {
            btnViewGrid.addEventListener('click', () => applyViewMode('grid'));
        }
        if (btnViewList) {
            btnViewList.addEventListener('click', () => applyViewMode('list'));
        }

        // Card Delegated Click Events (Remove & Compare)
        document.body.addEventListener('click', function (e) {
            // Remove Favorite button
            const removeBtn = e.target.closest('.btn-remove-fav');
            if (removeBtn) {
                e.preventDefault();
                e.stopPropagation();
                const id = parseInt(removeBtn.getAttribute('data-id'), 10);
                if (!id || !window.KZYFavorites) return;

                const cardEl = document.querySelector(`.fav-vehicle-card[data-id="${id}"]`);
                if (cardEl) {
                    cardEl.classList.add('is-removing');
                    setTimeout(() => {
                        let currentFavs = window.KZYFavorites.getFavorites().filter(item => item !== id);
                        window.KZYFavorites.saveFavorites(currentFavs);
                        if (window.showToast) {
                            window.showToast('Araç listenizden çıkarıldı.', 'primary');
                        }
                    }, 220);
                } else {
                    let currentFavs = window.KZYFavorites.getFavorites().filter(item => item !== id);
                    window.KZYFavorites.saveFavorites(currentFavs);
                }
                return;
            }

            // Card Compare Button
            const compareBtn = e.target.closest('.btn-card-toggle-compare');
            if (compareBtn) {
                e.preventDefault();
                e.stopPropagation();
                const id = parseInt(compareBtn.getAttribute('data-id'), 10);
                if (!id || !window.KZYFavorites) return;

                let compList = window.KZYFavorites.getCompareList();
                if (compList.includes(id)) {
                    compList = compList.filter(x => x !== id);
                    window.KZYFavorites.saveCompareList(compList);
                    if (window.showToast) window.showToast('Araç karşılaştırmadan çıkarıldı.', 'primary');
                } else {
                    if (compList.length >= 4) {
                        if (window.showToast) window.showToast('En fazla 4 araç karşılaştırabilirsiniz.', 'error');
                        return;
                    }
                    compList.push(id);
                    window.KZYFavorites.saveCompareList(compList);
                    if (window.showToast) window.showToast('Araç karşılaştırmaya eklendi.', 'success');
                }
                renderFavorites();
                return;
            }
        });

        // Quick add from suggestions (on empty state)
        quickAddBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const id = parseInt(this.getAttribute('data-id'), 10);
                if (!id || !window.KZYFavorites) return;

                let currentFavs = window.KZYFavorites.getFavorites();
                if (!currentFavs.includes(id)) {
                    currentFavs.push(id);
                    window.KZYFavorites.saveFavorites(currentFavs);
                    if (window.showToast) {
                        window.showToast('Araç listenize eklendi!', 'success');
                    }
                } else {
                    if (window.showToast) {
                        window.showToast('Araç zaten listenizde mevcut.', 'primary');
                    }
                }
            });
        });

        // Export All Favorites to Compare Page
        if (exportCompareBtn) {
            exportCompareBtn.addEventListener('click', function () {
                const favoriteIds = window.KZYFavorites ? window.KZYFavorites.getFavorites() : [];
                if (favoriteIds.length === 0) return;

                if (window.KZYFavorites) {
                    window.KZYFavorites.saveCompareList(favoriteIds.slice(0, 4));
                }
                const baseUrl = window.KZY?.baseUrl || '';
                window.location.href = `${baseUrl}arac-karsilastir.php?ids=${favoriteIds.slice(0, 4).join(',')}`;
            });
        }

        // Share List
        if (shareListBtn) {
            shareListBtn.addEventListener('click', function () {
                const favs = window.KZYFavorites ? window.KZYFavorites.getFavorites() : [];
                if (favs.length === 0) return;
                const shareUrl = window.location.origin + window.location.pathname + '?ids=' + favs.join(',');
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(shareUrl).then(() => {
                        if (window.showToast) {
                            window.showToast('Favori liste bağlantısı panoya kopyalandı.', 'success');
                        }
                    });
                }
            });
        }

        // Print List
        if (printListBtn) {
            printListBtn.addEventListener('click', function () {
                window.print();
            });
        }

        // Clear All
        if (clearAllBtn) {
            clearAllBtn.addEventListener('click', function () {
                if (confirm('Tüm favori araç listenizi temizlemek istediğinize emin misiniz?')) {
                    if (window.KZYFavorites) {
                        window.KZYFavorites.saveFavorites([]);
                        renderFavorites();
                        if (window.showToast) {
                            window.showToast('Tüm favori listeniz temizlendi.', 'primary');
                        }
                    }
                }
            });
        }

        // Bulk Quote Modal Open / Close
        function openBulkModal() {
            if (!bulkModal) return;
            bulkModal.classList.add('is-open');
        }

        function closeBulkModal() {
            if (!bulkModal) return;
            bulkModal.classList.remove('is-open');
        }

        bulkQuoteTriggers.forEach(btn => {
            btn.addEventListener('click', openBulkModal);
        });

        if (closeBulkModalBtn) {
            closeBulkModalBtn.addEventListener('click', closeBulkModal);
        }

        if (bulkModal) {
            bulkModal.addEventListener('click', function (e) {
                if (e.target === bulkModal) closeBulkModal();
            });
        }

        // Bulk Quote Form Submit
        if (bulkModalForm) {
            bulkModalForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const submitBtn = document.getElementById('btn-submit-bulk-quote');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span>Talebiniz Alınıyor...</span>';
                }

                setTimeout(() => {
                    closeBulkModal();
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<span>Teklif Talebini İlet</span><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>';
                    }
                    bulkModalForm.reset();
                    if (window.showToast) {
                        window.showToast('Toplu filo teklif talebiniz başarıyla iletildi! Kurumsal danışmanımız 15 dakika içinde sizinle iletişime geçecektir.', 'success', 6000);
                    }
                }, 800);
            });
        }

        window.addEventListener('kzy:favorites-updated', renderFavorites);
        renderFavorites();
    }

})();
