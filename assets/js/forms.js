/**
 * kzyfilo — Çok Adımlı Formlar ve Doğrulama JavaScript Modülü
 */

(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        initCustomDatePicker();
        initMultiStepQuoteForm();
        initFleetQuoteForm();
    });

    // ─── Özel Şık Tarih Seçici (Custom DatePicker) ────────────────────
    function initCustomDatePicker() {
        const datepickerWraps = document.querySelectorAll('.custom-datepicker');
        if (!datepickerWraps.length) return;

        const monthNamesTr = [
            'Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran',
            'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'
        ];

        datepickerWraps.forEach(function (wrap) {
            const displayInput = wrap.querySelector('.custom-datepicker-input');
            const hiddenInput = wrap.querySelector('input[type="hidden"]');
            const toggleBtn = wrap.querySelector('.custom-datepicker-toggle-btn');
            const dropdown = wrap.querySelector('.custom-datepicker-dropdown');
            const monthNameEl = wrap.querySelector('.datepicker-month-name');
            const yearNameEl = wrap.querySelector('.datepicker-year-name');
            const daysGrid = wrap.querySelector('.datepicker-days-grid');
            const prevBtn = wrap.querySelector('.datepicker-prev');
            const nextBtn = wrap.querySelector('.datepicker-next');
            const clearBtn = wrap.querySelector('.datepicker-clear-btn');
            const todayBtn = wrap.querySelector('.datepicker-today-btn');
            const shortcutBtns = wrap.querySelectorAll('.datepicker-shortcut-btn');

            if (!displayInput || !dropdown || !daysGrid) return;

            const today = new Date();
            today.setHours(0, 0, 0, 0);

            let viewYear = today.getFullYear();
            let viewMonth = today.getMonth(); // 0-11
            let selectedDate = null;

            function formatDateTr(d) {
                const day = String(d.getDate()).padStart(2, '0');
                const month = monthNamesTr[d.getMonth()];
                const year = d.getFullYear();
                return `${day} ${month} ${year}`;
            }

            function formatISODate(d) {
                const year = d.getFullYear();
                const month = String(d.getMonth() + 1).padStart(2, '0');
                const day = String(d.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            function renderCalendar() {
                if (monthNameEl) monthNameEl.textContent = monthNamesTr[viewMonth];
                if (yearNameEl) yearNameEl.textContent = viewYear;

                daysGrid.innerHTML = '';

                // First day of month (0 = Sunday, 1 = Monday, ...)
                const firstDay = new Date(viewYear, viewMonth, 1);
                let startDayIndex = firstDay.getDay() - 1; // Convert to Mon=0, Sun=6
                if (startDayIndex < 0) startDayIndex = 6;

                const totalDaysInMonth = new Date(viewYear, viewMonth + 1, 0).getDate();

                // Previous month blank cells
                for (let i = 0; i < startDayIndex; i++) {
                    const emptyCell = document.createElement('div');
                    emptyCell.className = 'datepicker-day is-empty';
                    daysGrid.appendChild(emptyCell);
                }

                // Month day buttons
                for (let day = 1; day <= totalDaysInMonth; day++) {
                    const cellDate = new Date(viewYear, viewMonth, day);
                    cellDate.setHours(0, 0, 0, 0);

                    const dayCell = document.createElement('button');
                    dayCell.type = 'button';
                    dayCell.className = 'datepicker-day';
                    dayCell.textContent = day;

                    // Check if past
                    if (cellDate < today) {
                        dayCell.classList.add('is-disabled');
                        dayCell.disabled = true;
                    } else {
                        // Check today
                        if (cellDate.getTime() === today.getTime()) {
                            dayCell.classList.add('is-today');
                        }

                        // Check selected
                        if (selectedDate && cellDate.getTime() === selectedDate.getTime()) {
                            dayCell.classList.add('is-selected');
                        }

                        dayCell.addEventListener('click', function (e) {
                            e.stopPropagation();
                            selectDate(cellDate);
                        });
                    }

                    daysGrid.appendChild(dayCell);
                }
            }

            function selectDate(d) {
                selectedDate = new Date(d);
                if (displayInput) displayInput.value = formatDateTr(selectedDate);
                if (hiddenInput) {
                    hiddenInput.value = formatISODate(selectedDate);
                    hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
                    hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
                }
                closeDropdown();
            }

            function openDropdown() {
                dropdown.hidden = false;
                document.querySelectorAll('.custom-datepicker-dropdown').forEach(d => {
                    if (d !== dropdown) d.hidden = true;
                });
                renderCalendar();

                // Viewport ve alan kontrolü: Altta yeterli yer yoksa yukarı açılır
                const wrapRect = wrap.getBoundingClientRect();
                const spaceBelow = window.innerHeight - wrapRect.bottom;
                if (spaceBelow < 320 && wrapRect.top > 320) {
                    dropdown.classList.add('opens-up');
                } else {
                    dropdown.classList.remove('opens-up');
                }
            }

            function closeDropdown() {
                dropdown.hidden = true;
                dropdown.classList.remove('opens-up');
            }

            function toggleDropdown(e) {
                e.stopPropagation();
                if (dropdown.hidden) {
                    openDropdown();
                } else {
                    closeDropdown();
                }
            }

            displayInput.addEventListener('click', toggleDropdown);
            if (toggleBtn) toggleBtn.addEventListener('click', toggleDropdown);

            if (prevBtn) {
                prevBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    viewMonth--;
                    if (viewMonth < 0) {
                        viewMonth = 11;
                        viewYear--;
                    }
                    renderCalendar();
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    viewMonth++;
                    if (viewMonth > 11) {
                        viewMonth = 0;
                        viewYear++;
                    }
                    renderCalendar();
                });
            }

            // Close when clicking outside
            document.addEventListener('click', function (e) {
                if (!wrap.contains(e.target)) {
                    closeDropdown();
                }
            });
        });
    }

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

        // Tarayıcı geçmişi başlangıç durumu (History API)
        try {
            history.replaceState({ quoteStep: 0 }, document.title, window.location.href);
        } catch (e) {}

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

        function goToStep(index, pushHistory = true) {
            if (index < 0) index = 0;
            if (index >= steps.length) index = steps.length - 1;
            currentStepIndex = index;
            showStep(currentStepIndex);

            if (pushHistory) {
                try {
                    history.pushState({ quoteStep: currentStepIndex }, document.title, window.location.href);
                } catch (e) {}
            }
        }

        // Tarayıcının geri / ileri tuşları ile adımlar arası geçiş
        window.addEventListener('popstate', function (e) {
            if (e.state && typeof e.state.quoteStep === 'number') {
                currentStepIndex = e.state.quoteStep;
                showStep(currentStepIndex);
            } else if (currentStepIndex > 0) {
                currentStepIndex = 0;
                showStep(0);
            }
        });

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

            // Contact & Company details
            const sumName = document.getElementById('summary-step-name');
            const sumPhone = document.getElementById('summary-step-phone');
            const sumEmail = document.getElementById('summary-step-email');
            const sumCompany = document.getElementById('summary-step-company');
            const sumCity = document.getElementById('summary-step-city');
            const sumStartDate = document.getElementById('summary-step-startdate');

            const firstName = (formData.get('name') || '').trim();
            const lastName = (formData.get('surname') || '').trim();
            const fullName = (firstName || lastName) ? `${firstName} ${lastName}`.trim() : '—';

            const phoneVal = (formData.get('phone') || '').trim();
            const emailVal = (formData.get('email') || '').trim();
            const companyVal = (formData.get('company') || '').trim();
            const citySelect = form.querySelector('select[name="city"]');
            const cityVal = citySelect ? (citySelect.value || 'İstanbul') : 'İstanbul';

            // Start date
            const datepickerDisplay = document.getElementById('step3-start-date-display');
            const rawDateVal = formData.get('start_date') || '';
            let displayStartDate = 'Hemen / İlk Müsaitlik';
            if (datepickerDisplay && datepickerDisplay.value.trim()) {
                displayStartDate = datepickerDisplay.value.trim();
            } else if (rawDateVal) {
                const parts = rawDateVal.split('-');
                if (parts.length === 3) {
                    displayStartDate = `${parts[2]}.${parts[1]}.${parts[0]}`;
                }
            }

            if (sumName) sumName.textContent = fullName;
            if (sumPhone) sumPhone.textContent = phoneVal || '—';
            if (sumEmail) sumEmail.textContent = emailVal || '—';
            if (sumCompany) sumCompany.textContent = companyVal || '—';
            if (sumCity) sumCity.textContent = cityVal || 'İstanbul';
            if (sumStartDate) sumStartDate.textContent = displayStartDate;
        }

        // Direct step navigation from summary edit buttons
        form.querySelectorAll('[data-goto-step]').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const targetStep = parseInt(this.getAttribute('data-goto-step'), 10);
                if (!isNaN(targetStep) && targetStep >= 0 && targetStep < steps.length) {
                    goToStep(targetStep, true);
                }
            });
        });

        nextBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                if (validateStep(currentStepIndex)) {
                    goToStep(currentStepIndex + 1, true);
                }
            });
        });

        form.querySelectorAll('input, select, textarea').forEach(function (field) {
            function clearError() {
                field.classList.remove('is-error');
                const errorEl = document.getElementById(field.id + '-error');
                if (errorEl) errorEl.textContent = '';
            }
            field.addEventListener('input', clearError);
            field.addEventListener('change', clearError);
        });

        prevBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                if (currentStepIndex > 0) {
                    history.back();
                }
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
