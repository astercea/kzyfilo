/**
 * kzyfilo — Araç Kataloğu Filtreleme ve Sıralama JavaScript Modülü
 * KZY Executive Motion — Premium Dinamik Filtreleme Mimarisi
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
        const applyBtn = document.getElementById('catalog-drawer-apply-btn');

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
        if (applyBtn) applyBtn.addEventListener('click', closeDrawer);
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
        const searchInput = document.getElementById('catalog-search-input');
        const sortSelect = document.getElementById('catalog-sort-select');
        const vehicleGrid = document.getElementById('catalog-vehicle-grid');
        const countLabel = document.getElementById('catalog-count-number');
        const emptyState = document.getElementById('catalog-empty-state');
        const emptyResetBtn = document.getElementById('empty-state-reset-btn');
        const activeFiltersContainer = document.getElementById('catalog-active-filters');
        const clearBtn = document.getElementById('catalog-filter-clear-btn');
        const mobileClearBtn = document.getElementById('catalog-mobile-clear-btn');
        const categoryPillsContainer = document.getElementById('catalog-category-pills');

        if (!vehicleGrid) return;

        const cards = Array.from(vehicleGrid.querySelectorAll('.vehicle-card'));

        function getActiveFilters() {
            const formData = form ? new FormData(form) : new FormData();
            const selectedBrands = formData.getAll('marka[]');
            const selectedBodies = formData.getAll('kasa[]');
            const selectedFuels = formData.getAll('yakit[]');
            const selectedTransmissions = formData.getAll('vites[]');
            const selectedCategory = formData.get('kategori') || '';
            const searchQuery = (searchInput ? searchInput.value.trim().toLowerCase() : '');
            const minPrice = parseFloat(formData.get('min_fiyat')) || 0;
            const maxPrice = parseFloat(formData.get('maks_fiyat')) || Infinity;
            const isCampaignOnly = formData.get('kampanya') === '1';
            const isPremiumOnly = formData.get('premium') === '1';
            const isFastDeliveryOnly = formData.get('hizli_teslim') === '1';

            return {
                brands: selectedBrands,
                bodies: selectedBodies,
                fuels: selectedFuels,
                transmissions: selectedTransmissions,
                category: selectedCategory,
                query: searchQuery,
                minPrice: minPrice,
                maxPrice: maxPrice,
                isCampaignOnly: isCampaignOnly,
                isPremiumOnly: isPremiumOnly,
                isFastDeliveryOnly: isFastDeliveryOnly
            };
        }

        function applyFilters() {
            const f = getActiveFilters();
            let visibleCount = 0;

            cards.forEach(function (card) {
                const brand = (card.getAttribute('data-brand') || '').toLowerCase();
                const model = (card.querySelector('.vehicle-card-model a')?.textContent || '').toLowerCase();
                const body = (card.getAttribute('data-body') || '').toLowerCase();
                const fuel = (card.getAttribute('data-fuel') || '').toLowerCase();
                const trans = (card.getAttribute('data-transmission') || '').toLowerCase();
                const cat = (card.getAttribute('data-category') || '').toLowerCase();
                const price = parseFloat(card.getAttribute('data-price')) || 0;
                const campaign = card.getAttribute('data-campaign') === '1';
                const premium = card.getAttribute('data-premium') === '1';
                const fastDelivery = card.getAttribute('data-fast-delivery') === '1';

                let match = true;

                // Text Search Query
                if (f.query) {
                    const fullText = brand + ' ' + model;
                    if (!fullText.includes(f.query)) match = false;
                }

                // Brand
                if (f.brands.length > 0 && !f.brands.some(b => b.toLowerCase() === brand)) match = false;

                // Body Type
                if (f.bodies.length > 0 && !f.bodies.some(b => b.toLowerCase() === body)) match = false;

                // Fuel
                if (f.fuels.length > 0 && !f.fuels.some(fl => fl.toLowerCase() === fuel)) match = false;

                // Transmission
                if (f.transmissions.length > 0 && !f.transmissions.some(t => t.toLowerCase() === trans)) match = false;

                // Category
                if (f.category && f.category !== 'all' && cat !== f.category.toLowerCase()) match = false;

                // Price Range
                if (price < f.minPrice || price > f.maxPrice) match = false;

                // Flags
                if (f.isCampaignOnly && !campaign) match = false;
                if (f.isPremiumOnly && !premium) match = false;
                if (f.isFastDeliveryOnly && !fastDelivery) match = false;

                if (match) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Update Counter
            if (countLabel) countLabel.textContent = visibleCount;

            // Empty State Handling
            if (emptyState) {
                if (visibleCount === 0) {
                    emptyState.classList.remove('hidden');
                    vehicleGrid.classList.add('hidden');
                } else {
                    emptyState.classList.add('hidden');
                    vehicleGrid.classList.remove('hidden');
                }
            }

            renderActiveFilterChips(f);
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
                return 0; // recommended
            });

            visibleCards.forEach(card => vehicleGrid.appendChild(card));
        }

        function renderActiveFilterChips(f) {
            if (!activeFiltersContainer) return;
            activeFiltersContainer.innerHTML = '';

            const chips = [];
            if (f.query) chips.push({ type: 'query', label: `"${f.query}"` });
            f.brands.forEach(b => chips.push({ type: 'marka', label: b, val: b }));
            f.bodies.forEach(b => chips.push({ type: 'kasa', label: b, val: b }));
            f.fuels.forEach(fl => chips.push({ type: 'yakit', label: fl, val: fl }));
            f.transmissions.forEach(t => chips.push({ type: 'vites', label: t, val: t }));
            if (f.category && f.category !== 'all') {
                chips.push({ type: 'kategori', label: f.category, val: f.category });
            }
            if (f.isCampaignOnly) chips.push({ type: 'kampanya', label: 'Kampanyalı' });
            if (f.isFastDeliveryOnly) chips.push({ type: 'hizli_teslim', label: 'Hızlı Teslim' });
            if (f.isPremiumOnly) chips.push({ type: 'premium', label: 'Premium' });

            chips.forEach(function (chip) {
                const chipEl = document.createElement('span');
                chipEl.className = 'active-filter-chip';
                chipEl.innerHTML = `
                    <span>${chip.label}</span>
                    <button type="button" class="chip-remove" aria-label="${chip.label} filtresini kaldır">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                `;

                chipEl.querySelector('.chip-remove').addEventListener('click', function () {
                    if (chip.type === 'query') {
                        if (searchInput) searchInput.value = '';
                    } else if (chip.type === 'kategori') {
                        const hiddenCat = document.getElementById('hidden-category-input');
                        if (hiddenCat) hiddenCat.value = '';
                        updateCategoryPills('all');
                    } else if (chip.type === 'kampanya' || chip.type === 'hizli_teslim' || chip.type === 'premium') {
                        const chk = form.querySelector(`input[name="${chip.type}"]`);
                        if (chk) chk.checked = false;
                    } else {
                        const chk = form.querySelector(`input[name="${chip.type}[]"][value="${chip.val}"]`);
                        if (chk) chk.checked = false;
                    }
                    syncForms(form, mobileForm);
                    applyFilters();
                });

                activeFiltersContainer.appendChild(chipEl);
            });
        }

        function resetAllFilters() {
            if (form) form.reset();
            if (mobileForm) mobileForm.reset();
            if (searchInput) searchInput.value = '';
            const hiddenCat = document.getElementById('hidden-category-input');
            if (hiddenCat) hiddenCat.value = '';
            updateCategoryPills('all');
            applyFilters();
        }

        function updateCategoryPills(activeCat, activeBody, isCamp) {
            if (!categoryPillsContainer) return;
            const pills = categoryPillsContainer.querySelectorAll('.cat-pill');
            pills.forEach(function (pill) {
                pill.classList.remove('is-active');
                if (activeCat && pill.getAttribute('data-category') === activeCat) {
                    pill.classList.add('is-active');
                } else if (activeBody && pill.getAttribute('data-body') === activeBody) {
                    pill.classList.add('is-active');
                } else if (isCamp && pill.getAttribute('data-filter-type') === 'kampanya') {
                    pill.classList.add('is-active');
                }
            });
        }

        // Fast Category Navigation Pills Click Handling
        if (categoryPillsContainer) {
            categoryPillsContainer.querySelectorAll('.cat-pill').forEach(function (pill) {
                pill.addEventListener('click', function () {
                    const cat = pill.getAttribute('data-category');
                    const body = pill.getAttribute('data-body');
                    const filterType = pill.getAttribute('data-filter-type');

                    if (cat) {
                        const hiddenCat = document.getElementById('hidden-category-input');
                        if (hiddenCat) hiddenCat.value = (cat === 'all') ? '' : cat;
                        // reset other single body/campaign
                        if (form) {
                            form.querySelectorAll('input[name="kasa[]"]').forEach(chk => chk.checked = false);
                            const campChk = form.querySelector('input[name="kampanya"]');
                            if (campChk) campChk.checked = false;
                        }
                        updateCategoryPills(cat);
                    } else if (body) {
                        if (form) {
                            form.querySelectorAll('input[name="kasa[]"]').forEach(function (chk) {
                                chk.checked = (chk.value.toLowerCase() === body.toLowerCase());
                            });
                        }
                        updateCategoryPills(null, body);
                    } else if (filterType === 'kampanya') {
                        if (form) {
                            const campChk = form.querySelector('input[name="kampanya"]');
                            if (campChk) campChk.checked = true;
                        }
                        updateCategoryPills(null, null, true);
                    }

                    syncForms(form, mobileForm);
                    applyFilters();
                });
            });
        }

        function syncForms(sourceForm, targetForm) {
            if (!sourceForm || !targetForm) return;
            const sourceInputs = sourceForm.querySelectorAll('input');
            sourceInputs.forEach(function (src) {
                const trg = targetForm.querySelector(`input[name="${src.name}"][value="${src.value}"]`) || targetForm.querySelector(`input[name="${src.name}"]`);
                if (trg) {
                    if (src.type === 'checkbox') trg.checked = src.checked;
                    else trg.value = src.value;
                }
            });
        }

        // Event Listeners
        if (form) {
            form.addEventListener('change', function () {
                syncForms(form, mobileForm);
                applyFilters();
            });
        }

        if (mobileForm) {
            mobileForm.addEventListener('change', function () {
                syncForms(mobileForm, form);
                applyFilters();
            });
        }

        if (searchInput) {
            searchInput.addEventListener('input', applyFilters);
        }

        if (sortSelect) {
            sortSelect.addEventListener('change', applySorting);
        }

        if (clearBtn) clearBtn.addEventListener('click', resetAllFilters);
        if (mobileClearBtn) mobileClearBtn.addEventListener('click', resetAllFilters);
        if (emptyResetBtn) emptyResetBtn.addEventListener('click', resetAllFilters);

        // Initial filtering execution
        applyFilters();
    }

})();
