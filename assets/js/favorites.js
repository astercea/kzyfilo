/**
 * kzyfilo — Favoriler ve Karşılaştırma Listesi Yönetimi (localStorage)
 * KZY Executive Motion — Compare Tray & Favorites Integration
 */

(function () {
    'use strict';

    const FAVORITES_KEY = 'kzy_favorites';
    const COMPARE_KEY = 'kzy_compare';
    const MAX_COMPARE = 4;

    // ─── Helpers ────────────────────────────────────────────────────
    function getFavorites() {
        try {
            return JSON.parse(localStorage.getItem(FAVORITES_KEY)) || [];
        } catch (e) {
            return [];
        }
    }

    function saveFavorites(items) {
        localStorage.setItem(FAVORITES_KEY, JSON.stringify(items));
        updateListBadge();
        updateFavoriteButtons();
        window.dispatchEvent(new CustomEvent('kzy:favorites-updated', { detail: items }));
    }

    function getCompareList() {
        try {
            return JSON.parse(localStorage.getItem(COMPARE_KEY)) || [];
        } catch (e) {
            return [];
        }
    }

    function saveCompareList(items) {
        localStorage.setItem(COMPARE_KEY, JSON.stringify(items));
        updateCompareTray();
        window.dispatchEvent(new CustomEvent('kzy:compare-updated', { detail: items }));
    }

    // ─── Header Badge Güncelleme ────────────────────────────────────
    function updateListBadge() {
        const badge = document.getElementById('header-list-count');
        if (!badge) return;

        const count = getFavorites().length;
        badge.textContent = count;
        badge.setAttribute('data-count', count);
    }

    // ─── Favori Butonlarını Güncelleme ──────────────────────────────
    function updateFavoriteButtons() {
        const favorites = getFavorites();
        const buttons = document.querySelectorAll('.btn-favorite-toggle');

        buttons.forEach(function (btn) {
            const id = parseInt(btn.getAttribute('data-id'), 10);
            if (favorites.includes(id)) {
                btn.classList.add('is-active');
            } else {
                btn.classList.remove('is-active');
            }
        });
    }

    // ─── Bottom Compare Tray Güncelleme ─────────────────────────────
    function updateCompareTray() {
        const tray = document.getElementById('compare-tray');
        const itemsContainer = document.getElementById('compare-tray-items');
        const countBadge = document.getElementById('compare-tray-count');
        if (!tray || !itemsContainer) return;

        // Karşılaştırma sayfasındayken alt çekmeceyi gizle
        if (window.location.pathname.includes('arac-karsilastir.php')) {
            tray.classList.remove('is-active');
            return;
        }

        const compareIds = getCompareList();

        if (compareIds.length === 0) {
            tray.classList.remove('is-active');
            itemsContainer.innerHTML = '';
            return;
        }

        tray.classList.add('is-active');
        if (countBadge) {
            countBadge.textContent = `${compareIds.length}/${MAX_COMPARE}`;
        }

        // Araç kartlarından veya global veriden model bilgisini çek
        itemsContainer.innerHTML = '';
        compareIds.forEach(function (id) {
            let brand = '';
            let model = '';
            let img = '';

            const vehicleCard = document.querySelector(`.vehicle-card[data-id="${id}"]`);
            if (vehicleCard) {
                brand = vehicleCard.getAttribute('data-brand') || '';
                model = vehicleCard.querySelector('.vehicle-card-model')?.textContent.trim() || '';
                img = vehicleCard.querySelector('.vehicle-card-image img')?.src || '';
            } else if (window.allVehiclesData) {
                const found = window.allVehiclesData.find(v => v.id === id);
                if (found) {
                    brand = found.brand;
                    model = found.model;
                    img = found.image;
                }
            }

            const itemEl = document.createElement('div');
            itemEl.className = 'compare-tray-item';
            itemEl.innerHTML = `
                ${img ? `<img src="${img}" alt="${brand} ${model}" width="38" height="22">` : ''}
                <span class="compare-tray-item-name" title="${brand} ${model}">${brand} ${model || 'Araç #' + id}</span>
                <button type="button" class="compare-tray-remove" data-remove-compare="${id}" title="Kaldır" aria-label="Kaldır">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            `;
            itemsContainer.appendChild(itemEl);
        });
    }

    // ─── Event Delegations ──────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        updateListBadge();
        updateFavoriteButtons();
        updateCompareTray();

        // Favori Butonu Tıklamaları
        document.body.addEventListener('click', function (e) {
            const btn = e.target.closest('.btn-favorite-toggle');
            if (!btn) return;

            e.preventDefault();
            e.stopPropagation();

            const id = parseInt(btn.getAttribute('data-id'), 10);
            if (!id) return;

            let favorites = getFavorites();
            const index = favorites.indexOf(id);

            if (index > -1) {
                favorites.splice(index, 1);
                saveFavorites(favorites);
                if (window.showToast) {
                    window.showToast(window.KZY?.i18n?.removedFromList || 'Araç listenizden çıkarıldı.', 'primary');
                }
            } else {
                favorites.push(id);
                saveFavorites(favorites);
                if (window.showToast) {
                    window.showToast(window.KZY?.i18n?.addedToList || 'Araç listenize eklendi.', 'success');
                }
            }
        });

        // Karşılaştır Butonu Tıklaması (Araç Kartlarında)
        document.body.addEventListener('click', function (e) {
            const btn = e.target.closest('.btn-compare-action');
            if (!btn) return;

            e.preventDefault();
            e.stopPropagation();

            const id = parseInt(btn.getAttribute('data-id'), 10);
            if (!id) return;

            let compareList = getCompareList();

            if (!compareList.includes(id)) {
                if (compareList.length >= MAX_COMPARE) {
                    if (window.showToast) {
                        window.showToast(window.KZY?.i18n?.maxCompareWarning || `En fazla ${MAX_COMPARE} araç karşılaştırabilirsiniz.`, 'error');
                    }
                    return;
                } else {
                    compareList.push(id);
                    saveCompareList(compareList);
                    if (window.showToast) {
                        window.showToast(window.KZY?.i18n?.addedToCompare || 'Araç karşılaştırma listesine eklendi.', 'success');
                    }
                }
            } else {
                // Listeden çıkar
                compareList = compareList.filter(item => item !== id);
                saveCompareList(compareList);
                if (window.showToast) {
                    window.showToast(window.KZY?.i18n?.removedFromCompare || 'Araç karşılaştırmadan çıkarıldı.', 'primary');
                }
            }
        });

        // Çekmeceden Araç Kaldırma Tıklaması
        document.body.addEventListener('click', function (e) {
            const removeBtn = e.target.closest('[data-remove-compare]');
            if (!removeBtn) return;

            const id = parseInt(removeBtn.getAttribute('data-remove-compare'), 10);
            if (!id) return;

            let compareList = getCompareList().filter(item => item !== id);
            saveCompareList(compareList);
            if (window.showToast) {
                window.showToast(window.KZY?.i18n?.removedFromCompare || 'Araç karşılaştırmadan çıkarıldı.', 'primary');
            }
        });

        // Çekmeceyi Temizle Butonu
        const clearTrayBtn = document.getElementById('compare-tray-clear');
        if (clearTrayBtn) {
            clearTrayBtn.addEventListener('click', function () {
                saveCompareList([]);
                if (window.showToast) {
                    window.showToast('Karşılaştırma listesi temizlendi.', 'primary');
                }
            });
        }

        // Karşılaştır Butonuna Tıklanınca: Sayfaya Yönlendir, Çekmeceyi Temizle ve Kapat
        const compareTrayBtn = document.getElementById('compare-tray-btn');
        if (compareTrayBtn) {
            compareTrayBtn.addEventListener('click', function (e) {
                const compareIds = getCompareList();
                if (compareIds.length > 0) {
                    e.preventDefault();
                    const baseUrl = window.KZY?.baseUrl || '';
                    const targetUrl = `${baseUrl}arac-karsilastir.php?ids=${compareIds.join(',')}`;
                    saveCompareList([]);
                    window.location.href = targetUrl;
                }
            });
        }
    });

    // ─── Public API ─────────────────────────────────────────────────
    window.KZYFavorites = {
        getFavorites: getFavorites,
        saveFavorites: saveFavorites,
        getCompareList: getCompareList,
        saveCompareList: saveCompareList,
        updateBadge: updateListBadge,
        updateButtons: updateFavoriteButtons,
        updateCompareTray: updateCompareTray
    };

})();
