/**
 * kzyfilo — Araç Kataloğu Filtreleme ve Sıralama JavaScript Modülü
 */

(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        initCatalogFilterDrawer();
        initCatalogFiltering();
    });

    // ─── Mobile Filter Drawer ───────────────────────────────────────
    function initCatalogFilterDrawer() {
        const trigger = document.getElementById('catalog-drawer-trigger');
        const drawer = document.getElementById('catalog-filter-drawer');
        const backdrop = document.getElementById('catalog-drawer-backdrop');
        const closeBtn = document.getElementById('catalog-drawer-close');

        if (!drawer || !backdrop) return;

        function openDrawer() {
            drawer.classList.add('is-open');
            backdrop.classList.add('is-open');
            drawer.setAttribute('aria-hidden', 'false');
            backdrop.setAttribute('aria-hidden', 'false');
            document.body.classList.add('no-scroll');
        }

        function closeDrawer() {
            drawer.classList.remove('is-open');
            backdrop.classList.remove('is-open');
            drawer.setAttribute('aria-hidden', 'true');
            backdrop.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('no-scroll');
        }

        if (trigger) trigger.addEventListener('click', openDrawer);
        if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
        backdrop.addEventListener('click', closeDrawer);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && drawer.classList.contains('is-open')) {
                closeDrawer();
            }
        });
    }

    // ─── Dynamic Client-Side Filtering & Sorting ────────────────────
    function initCatalogFiltering() {
        const form = document.getElementById('catalog-filter-form');
        const mobileForm = document.getElementById('catalog-mobile-filter-form');
        const sortSelect = document.getElementById('catalog-sort-select');
        const vehicleGrid = document.getElementById('catalog-vehicle-grid');
        const countLabel = document.getElementById('catalog-count-number');
        const emptyState = document.getElementById('catalog-empty-state');
        const activeFiltersContainer = document.getElementById('catalog-active-filters');

        if (!vehicleGrid) return;

        const cards = Array.from(vehicleGrid.querySelectorAll('.vehicle-card'));

        function applyFilters() {
            const activeForm = (window.innerWidth < 1024 && mobileForm) ? mobileForm : form;
            if (!activeForm) return;

            const formData = new FormData(activeForm);
            const selectedBrands = formData.getAll('marka[]');
            const selectedBodies = formData.getAll('kasa[]');
            const selectedFuels = formData.getAll('yakit[]');
            const selectedTransmissions = formData.getAll('vites[]');
            const selectedCategory = formData.get('kategori') || '';
            const minPrice = parseFloat(formData.get('min_fiyat')) || 0;
            const maxPrice = parseFloat(formData.get('maks_fiyat')) || Infinity;
            const isCampaignOnly = formData.get('kampanya') === '1';
            const isPremiumOnly = formData.get('premium') === '1';
            const isFastDeliveryOnly = formData.get('hizli_teslim') === '1';

            let visibleCount = 0;

            cards.forEach(function (card) {
                const brand = card.getAttribute('data-brand') || '';
                const body = card.getAttribute('data-body') || '';
                const fuel = card.getAttribute('data-fuel') || '';
                const trans = card.getAttribute('data-transmission') || '';
                const cat = card.getAttribute('data-category') || '';
                const price = parseFloat(card.getAttribute('data-price')) || 0;
                const campaign = card.getAttribute('data-campaign') === '1';
                const premium = card.getAttribute('data-premium') === '1';
                const fastDelivery = card.getAttribute('data-fast-delivery') === '1';

                let match = true;

                if (selectedBrands.length > 0 && !selectedBrands.some(b => b.toLowerCase() === brand.toLowerCase())) match = false;
                if (selectedBodies.length > 0 && !selectedBodies.some(b => b.toLowerCase() === body.toLowerCase())) match = false;
                if (selectedFuels.length > 0 && !selectedFuels.some(f => f.toLowerCase() === fuel.toLowerCase())) match = false;
                if (selectedTransmissions.length > 0 && !selectedTransmissions.some(t => t.toLowerCase() === trans.toLowerCase())) match = false;
                if (selectedCategory && selectedCategory !== 'all' && cat.toLowerCase() !== selectedCategory.toLowerCase()) match = false;
                if (price < minPrice || price > maxPrice) match = false;
                if (isCampaignOnly && !campaign) match = false;
                if (isPremiumOnly && !premium) match = false;
                if (isFastDeliveryOnly && !fastDelivery) match = false;

                if (match) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Update counter
            if (countLabel) countLabel.textContent = visibleCount;

            // Empty state toggle
            if (emptyState) {
                if (visibleCount === 0) {
                    emptyState.classList.remove('hidden');
                    vehicleGrid.classList.add('hidden');
                } else {
                    emptyState.classList.add('hidden');
                    vehicleGrid.classList.remove('hidden');
                }
            }

            renderActiveFilterTags(selectedBrands, selectedBodies, selectedFuels, selectedTransmissions, selectedCategory);
            applySorting();
        }

        function applySorting() {
            if (!sortSelect) return;
            const sortVal = sortSelect.value;
            const visibleCards = cards.filter(c => c.style.display !== 'none');

            visibleCards.sort(function (a, b) {
                const priceA = parseFloat(a.getAttribute('data-price')) || 0;
                const priceB = parseFloat(b.getAttribute('data-price')) || 0;
                const brandA = a.getAttribute('data-brand') || '';
                const brandB = b.getAttribute('data-brand') || '';
                const idA = parseInt(a.getAttribute('data-id'), 10) || 0;
                const idB = parseInt(b.getAttribute('data-id'), 10) || 0;

                if (sortVal === 'price_asc') return priceA - priceB;
                if (sortVal === 'price_desc') return priceB - priceA;
                if (sortVal === 'brand_az') return brandA.localeCompare(brandB);
                if (sortVal === 'newest') return idB - idA;
                return 0; // recommended / default
            });

            visibleCards.forEach(card => vehicleGrid.appendChild(card));
        }

        function renderActiveFilterTags(brands, bodies, fuels, transmissions, category) {
            if (!activeFiltersContainer) return;
            activeFiltersContainer.innerHTML = '';

            const allTags = [];
            brands.forEach(b => allTags.push({ type: 'marka', label: b, val: b }));
            bodies.forEach(b => allTags.push({ type: 'kasa', label: b, val: b }));
            fuels.forEach(f => allTags.push({ type: 'yakit', label: f, val: f }));
            transmissions.forEach(t => allTags.push({ type: 'vites', label: t, val: t }));
            if (category && category !== 'all') {
                allTags.push({ type: 'kategori', label: category, val: category });
            }

            allTags.forEach(function (tag) {
                const tagEl = document.createElement('span');
                tagEl.className = 'tag';
                tagEl.innerHTML = `
                    <span>${tag.label}</span>
                    <button type="button" class="tag-remove" aria-label="${tag.label} filtresini kaldır">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                `;

                tagEl.querySelector('.tag-remove').addEventListener('click', function () {
                    const input = form.querySelector(`input[name="${tag.type}[]"][value="${tag.val}"], select[name="${tag.type}"]`);
                    if (input) {
                        if (input.type === 'checkbox') input.checked = false;
                        else input.value = 'all';
                    }
                    applyFilters();
                });

                activeFiltersContainer.appendChild(tagEl);
            });
        }

        if (form) {
            form.addEventListener('change', applyFilters);
            form.addEventListener('reset', function () {
                setTimeout(applyFilters, 50);
            });
        }

        if (mobileForm) {
            mobileForm.addEventListener('change', applyFilters);
            mobileForm.addEventListener('reset', function () {
                setTimeout(applyFilters, 50);
            });
        }

        if (sortSelect) {
            sortSelect.addEventListener('change', applySorting);
        }

        // Apply initial filtering
        applyFilters();
    }

})();
