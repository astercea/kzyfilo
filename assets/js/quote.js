/**
 * kzyfilo — Teklif Hesaplama ve Seçim Yönetimi (sessionStorage)
 */

(function () {
    'use strict';

    const QUOTE_STATE_KEY = 'kzy_quote_state';

    // ─── State Management ───────────────────────────────────────────
    function getQuoteState() {
        try {
            return JSON.parse(sessionStorage.getItem(QUOTE_STATE_KEY)) || {};
        } catch (e) {
            return {};
        }
    }

    function saveQuoteState(state) {
        sessionStorage.setItem(QUOTE_STATE_KEY, JSON.stringify(state));
        window.dispatchEvent(new CustomEvent('kzy:quote-state-updated', { detail: state }));
    }

    // ─── Vehicle Detail Calculator ──────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        initVehicleDetailCalculator();
        initShareButton();
    });

    function initVehicleDetailCalculator() {
        const form = document.getElementById('vehicle-quote-calculator-form');
        const priceDisplay = document.getElementById('calc-monthly-price');
        const customOfferNotice = document.getElementById('calc-custom-offer-notice');
        const priceContainer = document.getElementById('calc-price-container');

        if (!form || !window.vehiclePriceMatrix) return;

        const matrix = window.vehiclePriceMatrix;

        function calculatePrice() {
            const formData = new FormData(form);
            const duration = formData.get('duration') || '36';
            const km = formData.get('annual_km') || '15';
            const packageId = formData.get('package') || 'advantage';
            const deposit = parseFloat(formData.get('deposit')) || 0;
            const count = parseInt(formData.get('vehicle_count'), 10) || 1;

            let basePrice = 0;

            // Matrix look-up
            if (matrix[duration] && matrix[duration][km] && matrix[duration][km][packageId]) {
                basePrice = matrix[duration][km][packageId];
            } else if (matrix[duration] && matrix[duration][km] && matrix[duration][km]['basic']) {
                basePrice = matrix[duration][km]['basic'];
            }

            if (basePrice > 0) {
                // Peşinat indirimi etkisi (yaklaşık demo formülü: peşinat / süre * 1.15)
                const depositDeduction = (deposit > 0) ? (deposit / parseInt(duration, 10)) * 1.15 : 0;
                let finalMonthlyPerCar = Math.max(1000, basePrice - depositDeduction);

                if (priceDisplay) {
                    priceDisplay.textContent = Math.round(finalMonthlyPerCar).toLocaleString('tr-TR');
                }

                if (priceContainer) priceContainer.classList.remove('hidden');
                if (customOfferNotice) customOfferNotice.classList.add('hidden');

                // State kaydet
                const state = {
                    vehicleId: window.currentVehicle?.id,
                    vehicleSlug: window.currentVehicle?.slug,
                    vehicleTitle: window.currentVehicle?.brand + ' ' + window.currentVehicle?.model,
                    duration: duration,
                    annualKm: km,
                    package: packageId,
                    deposit: deposit,
                    count: count,
                    monthlyPrice: Math.round(finalMonthlyPerCar),
                    totalMonthly: Math.round(finalMonthlyPerCar * count),
                    timestamp: Date.now()
                };

                saveQuoteState(state);
            } else {
                if (priceContainer) priceContainer.classList.add('hidden');
                if (customOfferNotice) customOfferNotice.classList.remove('hidden');
            }
        }

        form.addEventListener('change', calculatePrice);
        form.addEventListener('input', calculatePrice);

        // İlk hesaplama
        calculatePrice();
    }

    // ─── Web Share / Copy Link ──────────────────────────────────────
    function initShareButton() {
        const shareBtn = document.getElementById('btn-share-vehicle');
        if (!shareBtn) return;

        shareBtn.addEventListener('click', function () {
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    text: 'kzyfilo kurumsal araç kiralama teklifi',
                    url: window.location.href
                }).catch(() => {});
            } else {
                navigator.clipboard.writeText(window.location.href).then(() => {
                    if (window.showToast) {
                        window.showToast('Bağlantı panoya kopyalandı.', 'success');
                    }
                });
            }
        });
    }

    // Public API
    window.KZYQuote = {
        getState: getQuoteState,
        saveState: saveQuoteState
    };

})();
