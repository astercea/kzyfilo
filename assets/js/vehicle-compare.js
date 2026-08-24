/**
 * kzyfilo — Araç Karşılaştırma ve Listem Sayfası JavaScript Modülü
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
        const countBadge = document.getElementById('compare-count-badge');
        const highlightToggle = document.getElementById('toggle-compare-diff');
        const clearBtn = document.getElementById('btn-clear-compare');

        if (!tableWrapper || !window.allVehiclesData) return;

        const MAX_SLOTS = 4;

        function renderComparison() {
            const compareIds = window.KZYFavorites ? window.KZYFavorites.getCompareList() : [];
            const vehicles = window.allVehiclesData.filter(v => compareIds.includes(v.id));

            if (vehicles.length === 0) {
                tableWrapper.classList.add('hidden');
                if (toolbar) toolbar.classList.add('hidden');
                if (emptyState) emptyState.classList.remove('hidden');
                return;
            }

            tableWrapper.classList.remove('hidden');
            if (toolbar) toolbar.classList.remove('hidden');
            if (emptyState) emptyState.classList.add('hidden');

            if (countBadge) {
                countBadge.textContent = `${vehicles.length} / ${MAX_SLOTS} Araç`;
            }

            const theadRow = document.getElementById('compare-table-head-row');
            const tbody = document.getElementById('compare-table-body');
            if (!theadRow || !tbody) return;

            const hasEmptySlot = vehicles.length < MAX_SLOTS;
            const baseUrl = window.KZY?.baseUrl || '/';

            // ─── Thead (Vehicle Header Cards & Empty Add Slot) ─────────
            theadRow.innerHTML = '<th style="width: 200px; vertical-align: middle;">Özellikler & Fiyat</th>';

            vehicles.forEach(function (v) {
                const th = document.createElement('th');
                th.innerHTML = `
                    <div class="compare-vehicle-header">
                        <button type="button" class="compare-vehicle-remove btn-remove-compare" data-id="${v.id}" title="Karşılaştırmadan Çıkar" aria-label="${v.brand} ${v.model} aracını çıkar">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                        <img src="${v.image}" alt="${v.brand} ${v.model}" width="220" height="125">
                        <span class="badge badge-light mb-1" style="font-size: 11px;">${v.segment || ''}</span>
                        <h4>${v.brand} ${v.model}</h4>
                        <div class="text-xs text-muted mb-3" style="min-height: 18px;">${v.version || ''}</div>
                        <div class="text-xl fw-extrabold text-primary mb-4">
                            ${v.starting_price.toLocaleString('tr-TR')} ₺ 
                            <span class="text-xs text-muted fw-normal block">/ay + KDV (Demo)</span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <a href="${baseUrl}hizli-teklif.php?arac=${v.slug}" class="btn btn-primary btn-sm" style="width: 100%;">Teklif Al</a>
                            <a href="${baseUrl}arac-detay.php?slug=${v.slug}" class="btn btn-outline btn-sm" style="width: 100%;">Detayları İncele</a>
                        </div>
                    </div>
                `;
                theadRow.appendChild(th);
            });

            // If slots remain, show "+ Karşılaştırılacak Araç Ekle" Slot
            if (hasEmptySlot) {
                const addTh = document.createElement('th');
                addTh.innerHTML = `
                    <a href="${baseUrl}araclar.php" class="compare-empty-slot" title="Katalogdan Araç Seç">
                        <div class="compare-empty-slot-icon">+</div>
                        <div class="compare-empty-slot-title">+ ${vehicles.length + 1}. Aracı Ekle</div>
                        <div class="compare-empty-slot-desc">Katalogdan başka bir araç seçerek yan yana karşılaştırın.</div>
                        <span class="btn btn-outline btn-sm">Araç Kataloğu →</span>
                    </a>
                `;
                theadRow.appendChild(addTh);
            }

            // ─── Tbody Rows (Grouped Specs) ────────────────────────────
            const specGroups = [
                {
                    category: 'Fiyatlandırma',
                    rows: [
                        { label: 'Aylık Başlangıç Kirası', getValue: v => `${v.starting_price.toLocaleString('tr-TR')} ₺` },
                        { label: 'KDV Durumu', getValue: () => '+ %20 KDV Hariç' }
                    ]
                },
                {
                    category: 'Temel Bilgiler',
                    rows: [
                        { label: 'Kategori', getValue: v => (v.category ? v.category.toUpperCase() : 'BİNEK') },
                        { label: 'Segment', getValue: v => v.segment || '—' },
                        { label: 'Kasa Tipi', getValue: v => (v.body ? v.body.toUpperCase() : '—') },
                        { label: 'Koltuk Sayısı', getValue: v => `${v.seats || 5} Kişi` },
                        { label: 'Bagaj Hacmi', getValue: v => v.luggage || '—' }
                    ]
                },
                {
                    category: 'Motor & Performans',
                    rows: [
                        { label: 'Yakıt Türü', getValue: v => (v.fuel ? v.fuel.toUpperCase() : '—') },
                        { label: 'Vites Tipi', getValue: v => (v.transmission ? v.transmission.toUpperCase() : '—') },
                        { label: 'Motor Hacmi', getValue: v => v.specs?.engine?.['Motor Hacmi'] || '—' },
                        { label: 'Maksimum Güç', getValue: v => v.specs?.engine?.['Maksimum Güç'] || '—' },
                        { label: 'Maksimum Tork', getValue: v => v.specs?.engine?.['Maksimum Tork'] || '—' },
                        { label: 'Ortalama Tüketim', getValue: v => v.specs?.fuel_performance?.['Ortalama Tüketim'] || '—' }
                    ]
                },
                {
                    category: 'Güvenlik & Teslimat',
                    rows: [
                        { label: 'Hava Yastığı', getValue: v => v.specs?.safety?.['Hava Yastığı'] || '6 Adet' },
                        { label: 'Hızlı Teslimat', getValue: v => (v.is_fast_delivery ? '✓ Stokta Hazır' : 'Standart Sipariş') },
                        { label: 'Kampanya Durumu', getValue: v => (v.is_campaign ? '⭐ Kampanyalı Araç' : 'Standart Fiyat') }
                    ]
                }
            ];

            tbody.innerHTML = '';

            specGroups.forEach(function (group) {
                // Section Header Row
                const catTr = document.createElement('tr');
                catTr.className = 'compare-category-row';
                let catCols = `<th>${group.category}</th>`;
                for (let i = 0; i < vehicles.length; i++) {
                    catCols += '<td></td>';
                }
                if (hasEmptySlot) {
                    catCols += '<td></td>';
                }
                catTr.innerHTML = catCols;
                tbody.appendChild(catTr);

                // Group Rows
                group.rows.forEach(function (row) {
                    const tr = document.createElement('tr');
                    const values = vehicles.map(v => row.getValue(v));
                    const allSame = values.every(val => val === values[0]);

                    if (!allSame && vehicles.length > 1) {
                        tr.classList.add('has-diff');
                    }

                    let rowHtml = `<th>${row.label}</th>`;
                    values.forEach(val => {
                        rowHtml += `<td><strong>${val}</strong></td>`;
                    });

                    if (hasEmptySlot) {
                        rowHtml += '<td style="color: var(--color-muted); text-align: center;">—</td>';
                    }

                    tr.innerHTML = rowHtml;
                    tbody.appendChild(tr);
                });
            });

            // Event listener: Remove button ✕
            tableWrapper.querySelectorAll('.btn-remove-compare').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const id = parseInt(this.getAttribute('data-id'), 10);
                    let list = window.KZYFavorites.getCompareList();
                    list = list.filter(itemId => itemId !== id);
                    window.KZYFavorites.saveCompareList(list);
                    renderComparison();

                    if (window.showToast) {
                        window.showToast('Araç karşılaştırma listesinden çıkarıldı.', 'primary');
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

        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                if (window.KZYFavorites) {
                    window.KZYFavorites.saveCompareList([]);
                    renderComparison();
                    if (window.showToast) {
                        window.showToast('Karşılaştırma listesi temizlendi.', 'primary');
                    }
                }
            });
        }

        window.addEventListener('kzy:compare-updated', renderComparison);
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
