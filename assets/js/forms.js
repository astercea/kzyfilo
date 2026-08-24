/**
 * kzyfilo — Çok Adımlı Formlar ve Doğrulama JavaScript Modülü
 */

(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        initMultiStepQuoteForm();
        initFleetQuoteForm();
    });

    // ─── Hızlı Teklif Çok Adımlı Formu ──────────────────────────────
    function initMultiStepQuoteForm() {
        const form = document.getElementById('multi-step-quote-form');
        if (!form) return;

        const steps = form.querySelectorAll('.form-step');
        const progressSteps = document.querySelectorAll('.progress-step');
        const nextBtns = form.querySelectorAll('.btn-step-next');
        const prevBtns = form.querySelectorAll('.btn-step-prev');
        const successView = document.getElementById('quote-success-view');

        let currentStepIndex = 0;

        // Session storage'dan önceki seçimleri yükle ve 1. adıma doldur
        const state = window.KZYQuote ? window.KZYQuote.getState() : {};
        if (state.vehicleSlug) {
            const vehicleSelect = form.querySelector('select[name="selected_vehicle"]');
            if (vehicleSelect) vehicleSelect.value = state.vehicleSlug;
        }
        if (state.duration) {
            const durRadio = form.querySelector(`input[name="duration"][value="${state.duration}"]`);
            if (durRadio) durRadio.checked = true;
        }
        if (state.annualKm) {
            const kmSelect = form.querySelector('select[name="annual_km"]');
            if (kmSelect) kmSelect.value = state.annualKm;
        }
        if (state.count) {
            const countSelect = form.querySelector('select[name="vehicle_count"]');
            if (countSelect) countSelect.value = state.count;
        }

        function showStep(index) {
            steps.forEach((step, i) => {
                if (i === index) {
                    step.classList.add('is-active');
                    step.hidden = false;
                } else {
                    step.classList.remove('is-active');
                    step.hidden = true;
                }
            });

            // Progress bar güncelle
            progressSteps.forEach((ps, i) => {
                ps.classList.remove('is-active', 'is-completed');
                if (i < index) {
                    ps.classList.add('is-completed');
                } else if (i === index) {
                    ps.classList.add('is-active');
                }
            });

            // Adım 4'te özet güncelle
            if (index === 3) {
                updateStep4Summary();
            }

            window.scrollTo({ top: form.offsetTop - 100, behavior: 'smooth' });
        }

        function validateStep(index) {
            const currentStepEl = steps[index];
            const requiredInputs = currentStepEl.querySelectorAll('[required]');
            let isValid = true;

            requiredInputs.forEach(function (input) {
                input.classList.remove('is-error');
                const errorEl = currentStepEl.querySelector(`#${input.id}-error`);
                if (errorEl) errorEl.textContent = '';

                if (input.type === 'checkbox') {
                    if (!input.checked) {
                        isValid = false;
                        input.classList.add('is-error');
                        if (errorEl) errorEl.textContent = 'Bu onayı vermeniz gerekmektedir.';
                    }
                } else if (input.type === 'email') {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!input.value.trim() || !emailRegex.test(input.value.trim())) {
                        isValid = false;
                        input.classList.add('is-error');
                        if (errorEl) errorEl.textContent = 'Geçerli bir e-posta adresi giriniz.';
                    }
                } else if (input.type === 'tel') {
                    if (!input.value.trim() || input.value.trim().length < 10) {
                        isValid = false;
                        input.classList.add('is-error');
                        if (errorEl) errorEl.textContent = 'Geçerli bir telefon numarası giriniz.';
                    }
                } else {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.classList.add('is-error');
                        if (errorEl) errorEl.textContent = 'Bu alan zorunludur.';
                    }
                }
            });

            return isValid;
        }

        function updateStep4Summary() {
            const formData = new FormData(form);
            const sumVehicle = document.getElementById('summary-step-vehicle');
            const sumDuration = document.getElementById('summary-step-duration');
            const sumName = document.getElementById('summary-step-name');
            const sumPhone = document.getElementById('summary-step-phone');
            const sumCompany = document.getElementById('summary-step-company');

            if (sumVehicle) sumVehicle.textContent = formData.get('selected_vehicle') || '—';
            if (sumDuration) sumDuration.textContent = (formData.get('duration') || '36') + ' Ay / ' + (formData.get('annual_km') || '15') + '.000 km';
            if (sumName) sumName.textContent = (formData.get('name') || '') + ' ' + (formData.get('surname') || '');
            if (sumPhone) sumPhone.textContent = formData.get('phone') || '—';
            if (sumCompany) sumCompany.textContent = formData.get('company') || '—';
        }

        nextBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                if (validateStep(currentStepIndex)) {
                    currentStepIndex++;
                    if (currentStepIndex >= steps.length) currentStepIndex = steps.length - 1;
                    showStep(currentStepIndex);
                }
            });
        });

        prevBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                currentStepIndex--;
                if (currentStepIndex < 0) currentStepIndex = 0;
                showStep(currentStepIndex);
            });
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (validateStep(currentStepIndex)) {
                // TODO: Backend Entegrasyonu (Teklif formunu CRM ve e-posta servisine post et)
                form.classList.add('hidden');
                if (successView) {
                    successView.classList.remove('hidden');
                    window.scrollTo({ top: successView.offsetTop - 100, behavior: 'smooth' });
                }
                if (window.showToast) {
                    window.showToast('Teklif talebiniz başarıyla iletildi. (Frontend Prototip)', 'success', 5000);
                }
            }
        });

        showStep(0);
    }

    // ─── Filo Yönetimi Teklif Formu ─────────────────────────────────
    function initFleetQuoteForm() {
        const form = document.getElementById('fleet-management-quote-form');
        const successView = document.getElementById('fleet-success-view');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            let isValid = true;
            const requiredInputs = form.querySelectorAll('[required]');

            requiredInputs.forEach(function (input) {
                input.classList.remove('is-error');
                if (input.type === 'checkbox' && !input.checked) isValid = false;
                if (!input.value.trim()) isValid = false;
            });

            if (isValid) {
                // TODO: Backend API entegrasyonu
                form.classList.add('hidden');
                if (successView) {
                    successView.classList.remove('hidden');
                }
                if (window.showToast) {
                    window.showToast('Filo yönetim talebiniz alındı. (Frontend Prototip)', 'success', 5000);
                }
            }
        });
    }

})();
