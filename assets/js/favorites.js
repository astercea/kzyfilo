/**
 * kzyfilo — Favoriler ve Karşılaştırma Listesi Yönetimi (localStorage)
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

    // ─── Event Delegations ──────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        updateListBadge();
        updateFavoriteButtons();

        // Favori Butonu Tıklamaları (Event delegation)
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

        // Karşılaştır Butonu Tıklaması -> Listeye ekle ve Karşılaştırma Sayfasına yönlendir
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
                    // Maksimuma ulaşıldıysa son aracı yenisiyle değiştir
                    compareList[compareList.length - 1] = id;
                } else {
                    compareList.push(id);
                }
                saveCompareList(compareList);
            }

            // Doğrudan Araç Karşılaştırma Sayfasına Git
            const baseUrl = window.KZY?.baseUrl || '/';
            window.location.href = baseUrl + 'arac-karsilastir.php';
        });
    });

    // ─── Public API ─────────────────────────────────────────────────
    window.KZYFavorites = {
        getFavorites: getFavorites,
        saveFavorites: saveFavorites,
        getCompareList: getCompareList,
        saveCompareList: saveCompareList,
        updateBadge: updateListBadge,
        updateButtons: updateFavoriteButtons
    };

})();
