/**
 * kzyfilo — Paket Karşılaştırma ve Fiyat Kırılımı JavaScript Modülü
 */

(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        initPackageComparisonPage();
    });

    function initPackageComparisonPage() {
        const packageCards = document.querySelectorAll('.package-card');
        const addonCards = document.querySelectorAll('.addon-card');
        const quoteState = window.KZYQuote ? window.KZYQuote.getState() : {};

        let currentPackage = quoteState.package || 'advantage';
        let selectedAddons = quoteState.addons || []; // array of addon ids
        const baseMonthly = quoteState.monthlyPrice || 16900;
        const deposit = quoteState.deposit || 0;
        const duration = quoteState.duration || 36;
        const vehicleCount = quoteState.count || 1;

        // Fiyat Elemanları
        const elVehicleBase = document.getElementById('summary-vehicle-base');
        const elPackageDiff = document.getElementById('summary-package-diff');
        const elMonthlyAddons = document.getElementById('summary-monthly-addons');
        const elOneTimeAddons = document.getElementById('summary-onetime-addons');
        const elOneTimeRow = document.getElementById('summary-onetime-row');
        const elSubtotal = document.getElementById('summary-subtotal');
        const elVat = document.getElementById('summary-vat');
        const elTotal = document.getElementById('summary-total');

        function updateCalculations() {
            let pkgDiff = 0;
            if (currentPackage === 'advantage') pkgDiff = 1350;
            else if (currentPackage === 'full') pkgDiff = 2950;
            else pkgDiff = 0;

            let monthlyAddonsTotal = 0;
            let oneTimeAddonsTotal = 0;

            if (window.addonsData) {
                window.addonsData.forEach(function (addon) {
                    if (selectedAddons.includes(addon.id)) {
                        if (addon.type === 'monthly') {
                            monthlyAddonsTotal += addon.price;
                        } else if (addon.type === 'one_time') {
                            oneTimeAddonsTotal += addon.price;
                        }
                    }
                });
            }

            const monthlySubtotal = (baseMonthly + pkgDiff + monthlyAddonsTotal) * vehicleCount;
            const vatAmount = monthlySubtotal * 0.20;
            const monthlyTotal = monthlySubtotal + vatAmount;

            // DOM Güncelle
            if (elVehicleBase) elVehicleBase.textContent = (baseMonthly * vehicleCount).toLocaleString('tr-TR') + ' ₺';
            if (elPackageDiff) elPackageDiff.textContent = (pkgDiff * vehicleCount).toLocaleString('tr-TR') + ' ₺';
            if (elMonthlyAddons) elMonthlyAddons.textContent = (monthlyAddonsTotal * vehicleCount).toLocaleString('tr-TR') + ' ₺';
            
            if (elOneTimeRow && elOneTimeAddons) {
                if (oneTimeAddonsTotal > 0) {
                    elOneTimeRow.classList.remove('hidden');
                    elOneTimeAddons.textContent = (oneTimeAddonsTotal * vehicleCount).toLocaleString('tr-TR') + ' ₺';
                } else {
                    elOneTimeRow.classList.add('hidden');
                }
            }

            if (elSubtotal) elSubtotal.textContent = monthlySubtotal.toLocaleString('tr-TR') + ' ₺';
            if (elVat) elVat.textContent = vatAmount.toLocaleString('tr-TR') + ' ₺';
            if (elTotal) elTotal.textContent = monthlyTotal.toLocaleString('tr-TR') + ' ₺';

            // State Güncelle
            const updatedState = Object.assign({}, quoteState, {
                package: currentPackage,
                addons: selectedAddons,
                packageDiff: pkgDiff,
                monthlyAddonsTotal: monthlyAddonsTotal,
                oneTimeAddonsTotal: oneTimeAddonsTotal,
                monthlySubtotal: monthlySubtotal,
                vatAmount: vatAmount,
                finalTotalMonthly: monthlyTotal
            });

            if (window.KZYQuote) {
                window.KZYQuote.saveState(updatedState);
            }
        }

        // Paket Seçim Kartları
        packageCards.forEach(function (card) {
            const btn = card.querySelector('.btn-select-package');
            const pkgId = card.getAttribute('data-package');

            function selectCard() {
                packageCards.forEach(c => {
                    c.classList.remove('is-selected');
                    const b = c.querySelector('.btn-select-package');
                    if (b) {
                        b.textContent = 'Paketi Seç';
                        b.className = 'btn btn-outline btn-sm btn-select-package';
                    }
                });

                card.classList.add('is-selected');
                if (btn) {
                    btn.textContent = 'Seçildi ✓';
                    btn.className = 'btn btn-primary btn-sm btn-select-package';
                }

                currentPackage = pkgId;
                updateCalculations();
            }

            if (pkgId === currentPackage) {
                selectCard();
            }

            if (btn) {
                btn.addEventListener('click', selectCard);
            }
        });

        // Ek Hizmet Kartları Toggle
        addonCards.forEach(function (card) {
            const btn = card.querySelector('.btn-toggle-addon');
            const addonId = card.getAttribute('data-addon');

            function toggleAddon() {
                const idx = selectedAddons.indexOf(addonId);
                if (idx > -1) {
                    selectedAddons.splice(idx, 1);
                    card.classList.remove('is-selected');
                    if (btn) btn.textContent = '+ Ekle';
                } else {
                    selectedAddons.push(addonId);
                    card.classList.add('is-selected');
                    if (btn) btn.textContent = 'Çıkar ✓';
                }
                updateCalculations();
            }

            if (selectedAddons.includes(addonId)) {
                card.classList.add('is-selected');
                if (btn) btn.textContent = 'Çıkar ✓';
            }

            if (btn) {
                btn.addEventListener('click', toggleAddon);
            }
        });

        updateCalculations();
    }

})();
