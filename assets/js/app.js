/**
 * kzyfilo — Ana JavaScript Modülü (Vanilla JS)
 */

(function () {
    'use strict';

    // ─── DOM Ready ──────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        initStickyHeader();
        initMegaMenus();
        initMobileMenu();
        initFloatingContact();
        initCallbackModal();
        initCookieBanner();
        initAccordions();
        initTabs();
    });

    // ─── Toast Notification System ──────────────────────────────────
    window.showToast = function (message, type = 'primary', duration = 1000) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        // Bildirimler 1 saniye (1000ms) sonra otomatik kaybolur
        const displayDuration = 1000;

        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.setAttribute('role', 'status');

        let iconSvg = '';
        if (type === 'success') {
            iconSvg = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>`;
        } else if (type === 'error') {
            iconSvg = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>`;
        } else {
            iconSvg = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>`;
        }

        toast.innerHTML = `
            <span class="toast-icon" aria-hidden="true">${iconSvg}</span>
            <span class="toast-msg">${message}</span>
            <button type="button" class="toast-close-btn" aria-label="Kapat" title="Kapat">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        `;

        container.appendChild(toast);

        let timeoutId = null;

        function closeToast() {
            if (timeoutId) clearTimeout(timeoutId);
            toast.classList.add('toast-out');
            setTimeout(function () {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 250);
        }

        const closeBtn = toast.querySelector('.toast-close-btn');
        if (closeBtn) {
            closeBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                closeToast();
            });
        }

        timeoutId = setTimeout(closeToast, displayDuration);
    };

    // ─── Sticky Header ──────────────────────────────────────────────
    function initStickyHeader() {
        const header = document.getElementById('site-header');
        if (!header) return;

        const SCROLL_THRESHOLD = 80;
        let isScrolled = false;

        function updateHeader() {
            const scrollY = window.scrollY;

            if (scrollY > SCROLL_THRESHOLD && !isScrolled) {
                isScrolled = true;
                header.classList.add('is-scrolled');
            } else if (scrollY <= SCROLL_THRESHOLD && isScrolled) {
                isScrolled = false;
                header.classList.remove('is-scrolled');
            }
        }

        window.addEventListener('scroll', updateHeader, { passive: true });
        updateHeader();
    }

    // ─── Desktop Mega Menus & Dropdowns ─────────────────────────────
    function initMegaMenus() {
        const dropdownWrappers = document.querySelectorAll('.nav-dropdown-wrapper');

        dropdownWrappers.forEach(function (wrapper) {
            const btn = wrapper.querySelector('.nav-dropdown-btn');
            const menu = wrapper.querySelector('.mega-menu');
            if (!btn || !menu) return;

            function openMenu() {
                // Diğer açık menüleri kapat
                dropdownWrappers.forEach(function (other) {
                    if (other !== wrapper) {
                        const otherBtn = other.querySelector('.nav-dropdown-btn');
                        const otherMenu = other.querySelector('.mega-menu');
                        if (otherBtn && otherMenu) {
                            otherBtn.setAttribute('aria-expanded', 'false');
                            otherMenu.classList.remove('is-open');
                        }
                    }
                });

                btn.setAttribute('aria-expanded', 'true');
                menu.classList.add('is-open');
            }

            function closeMenu() {
                btn.setAttribute('aria-expanded', 'false');
                menu.classList.remove('is-open');
            }

            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                const isOpen = menu.classList.contains('is-open');
                if (isOpen) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });

            // Hover desteği (büyük ekranlarda akıcı kullanım için)
            wrapper.addEventListener('mouseenter', function () {
                if (window.innerWidth >= 1024) {
                    openMenu();
                }
            });

            wrapper.addEventListener('mouseleave', function () {
                if (window.innerWidth >= 1024) {
                    closeMenu();
                }
            });
        });

        // Dışarı tıklandığında menüleri kapat
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.nav-dropdown-wrapper')) {
                dropdownWrappers.forEach(function (wrapper) {
                    const btn = wrapper.querySelector('.nav-dropdown-btn');
                    const menu = wrapper.querySelector('.mega-menu');
                    if (btn && menu) {
                        btn.setAttribute('aria-expanded', 'false');
                        menu.classList.remove('is-open');
                    }
                });
            }
        });

        // ESC tuşuyla kapat
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                dropdownWrappers.forEach(function (wrapper) {
                    const btn = wrapper.querySelector('.nav-dropdown-btn');
                    const menu = wrapper.querySelector('.mega-menu');
                    if (btn && menu && menu.classList.contains('is-open')) {
                        btn.setAttribute('aria-expanded', 'false');
                        menu.classList.remove('is-open');
                        btn.focus();
                    }
                });
            }
        });
    }

    // ─── Mobile Menu Drawer ─────────────────────────────────────────
    function initMobileMenu() {
        const hamburger = document.getElementById('hamburger-btn');
        const drawer = document.getElementById('mobile-menu');
        const backdrop = document.getElementById('mobile-menu-backdrop');
        const closeBtn = document.getElementById('mobile-menu-close');

        if (!hamburger || !drawer || !backdrop) return;

        function openDrawer() {
            hamburger.setAttribute('aria-expanded', 'true');
            drawer.setAttribute('aria-hidden', 'false');
            backdrop.setAttribute('aria-hidden', 'false');
            drawer.classList.add('is-open');
            backdrop.classList.add('is-open');
            document.body.classList.add('no-scroll');
            if (closeBtn) closeBtn.focus();
        }

        function closeDrawer() {
            hamburger.setAttribute('aria-expanded', 'false');
            drawer.setAttribute('aria-hidden', 'true');
            backdrop.setAttribute('aria-hidden', 'true');
            drawer.classList.remove('is-open');
            backdrop.classList.remove('is-open');
            document.body.classList.remove('no-scroll');
            hamburger.focus();
        }

        hamburger.addEventListener('click', function () {
            const isOpen = drawer.classList.contains('is-open');
            if (isOpen) {
                closeDrawer();
            } else {
                openDrawer();
            }
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', closeDrawer);
        }

        backdrop.addEventListener('click', closeDrawer);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && drawer.classList.contains('is-open')) {
                closeDrawer();
            }
        });

        // Mobil menü içindeki akordeonlar
        const mobileAccordions = drawer.querySelectorAll('.mobile-nav-accordion-btn');
        mobileAccordions.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const content = this.nextElementSibling;
                const isExpanded = this.getAttribute('aria-expanded') === 'true';

                if (isExpanded) {
                    this.setAttribute('aria-expanded', 'false');
                    if (content) content.hidden = true;
                } else {
                    this.setAttribute('aria-expanded', 'true');
                    if (content) content.hidden = false;
                }
            });
        });
    }

    // ─── Floating Contact Menu ──────────────────────────────────────
    function initFloatingContact() {
        const btn = document.getElementById('floating-contact-btn');
        const menu = document.getElementById('floating-contact-menu');
        if (!btn || !menu) return;

        function toggle() {
            const isOpen = menu.classList.contains('is-open');
            if (isOpen) {
                menu.classList.remove('is-open');
                menu.setAttribute('aria-hidden', 'true');
                btn.setAttribute('aria-expanded', 'false');
            } else {
                menu.classList.add('is-open');
                menu.setAttribute('aria-hidden', 'false');
                btn.setAttribute('aria-expanded', 'true');
            }
        }

        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            toggle();
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('#floating-contact')) {
                menu.classList.remove('is-open');
                menu.setAttribute('aria-hidden', 'true');
                btn.setAttribute('aria-expanded', 'false');
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && menu.classList.contains('is-open')) {
                menu.classList.remove('is-open');
                menu.setAttribute('aria-hidden', 'true');
                btn.setAttribute('aria-expanded', 'false');
                btn.focus();
            }
        });
    }

    // ─── Callback Modal ("Sizi Arayalım") ───────────────────────────
    function initCallbackModal() {
        const triggers = document.querySelectorAll('#trigger-callback-modal, [data-open-modal="callback"]');
        const modal = document.getElementById('callback-modal');
        const backdrop = document.getElementById('callback-modal-backdrop');
        const closeBtn = document.getElementById('callback-modal-close');
        const cancelBtn = document.getElementById('callback-modal-cancel');
        const form = document.getElementById('callback-form');

        if (!modal || !backdrop || !form) return;

        let previousActiveElement = null;

        function openModal() {
            previousActiveElement = document.activeElement;
            modal.setAttribute('aria-hidden', 'false');
            backdrop.setAttribute('aria-hidden', 'false');
            modal.classList.add('is-open');
            backdrop.classList.add('is-open');
            document.body.classList.add('no-scroll');

            const firstInput = modal.querySelector('input, select, textarea');
            if (firstInput) firstInput.focus();
        }

        function closeModal() {
            modal.setAttribute('aria-hidden', 'true');
            backdrop.setAttribute('aria-hidden', 'true');
            modal.classList.remove('is-open');
            backdrop.classList.remove('is-open');
            document.body.classList.remove('no-scroll');

            if (previousActiveElement) {
                previousActiveElement.focus();
            }
        }

        triggers.forEach(function (trigger) {
            trigger.addEventListener('click', function (e) {
                e.preventDefault();
                openModal();
            });
        });

        if (closeBtn) closeBtn.addEventListener('click', closeModal);
        if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
        backdrop.addEventListener('click', closeModal);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.classList.contains('is-open')) {
                closeModal();
            }
        });

        // Form Submit Validation (Frontend Prototype)
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const fullname = document.getElementById('callback-fullname');
            const phone = document.getElementById('callback-phone');
            const kvkk = document.getElementById('callback-kvkk');

            let isValid = true;

            // Reset errors
            modal.querySelectorAll('.form-input, .form-check input').forEach(function (el) {
                el.classList.remove('is-error');
            });
            modal.querySelectorAll('.form-error').forEach(function (el) {
                el.textContent = '';
            });

            if (!fullname.value.trim()) {
                fullname.classList.add('is-error');
                document.getElementById('callback-fullname-error').textContent = 'Lütfen adınızı ve soyadınızı giriniz.';
                isValid = false;
            }

            if (!phone.value.trim() || phone.value.trim().length < 10) {
                phone.classList.add('is-error');
                document.getElementById('callback-phone-error').textContent = 'Lütfen geçerli bir telefon numarası giriniz.';
                isValid = false;
            }

            if (!kvkk.checked) {
                document.getElementById('callback-kvkk-error').textContent = 'KVKK metnini onaylamanız gerekmektedir.';
                isValid = false;
            }

            if (isValid) {
                // TODO: Backend API entegrasyonu (aranma talebini veritabanına kaydet ve CRM'e ilet)
                closeModal();
                form.reset();
                window.showToast('Aranma talebiniz başarıyla alındı. (Frontend Prototip)', 'success', 4500);
            }
        });
    }

    // ─── Cookie Consent Banner ──────────────────────────────────────
    function initCookieBanner() {
        const banner = document.getElementById('cookie-banner');
        const acceptAllBtn = document.getElementById('cookie-accept-all-btn');
        const acceptReqBtn = document.getElementById('cookie-accept-required-btn');
        const manageBtn = document.getElementById('cookie-manage-btn');
        const saveBtn = document.getElementById('cookie-save-btn');
        const prefsPanel = document.getElementById('cookie-preferences');

        if (!banner) return;

        const consent = localStorage.getItem('kzy_cookie_consent');
        if (!consent) {
            setTimeout(function () {
                banner.classList.add('is-visible');
                banner.setAttribute('aria-hidden', 'false');
            }, 1000);
        }

        function saveConsent(data) {
            localStorage.setItem('kzy_cookie_consent', JSON.stringify(data));
            banner.classList.remove('is-visible');
            banner.setAttribute('aria-hidden', 'true');
        }

        if (acceptAllBtn) {
            acceptAllBtn.addEventListener('click', function () {
                saveConsent({ required: true, analytics: true, marketing: true, date: new Date().toISOString() });
            });
        }

        if (acceptReqBtn) {
            acceptReqBtn.addEventListener('click', function () {
                saveConsent({ required: true, analytics: false, marketing: false, date: new Date().toISOString() });
            });
        }

        if (manageBtn && prefsPanel && saveBtn) {
            manageBtn.addEventListener('click', function () {
                prefsPanel.classList.toggle('is-open');
                manageBtn.classList.add('hidden');
                acceptReqBtn.classList.add('hidden');
                acceptAllBtn.classList.add('hidden');
                saveBtn.classList.remove('hidden');
            });

            saveBtn.addEventListener('click', function () {
                const analytics = document.getElementById('cookie-analytics').checked;
                const marketing = document.getElementById('cookie-marketing').checked;
                saveConsent({ required: true, analytics: analytics, marketing: marketing, date: new Date().toISOString() });
            });
        }
    }

    // ─── Accordions Global ──────────────────────────────────────────
    function initAccordions() {
        const accordions = document.querySelectorAll('.accordion');

        accordions.forEach(function (acc) {
            const triggers = acc.querySelectorAll('.accordion-trigger');

            triggers.forEach(function (trigger) {
                trigger.addEventListener('click', function () {
                    const item = this.closest('.accordion-item');
                    const panel = item.querySelector('.accordion-panel');
                    const isOpen = item.classList.contains('is-open');

                    // Tek açık mod (siblings kapatılır)
                    const siblings = acc.querySelectorAll('.accordion-item');
                    siblings.forEach(function (sib) {
                        if (sib !== item) {
                            sib.classList.remove('is-open');
                            const sibTrigger = sib.querySelector('.accordion-trigger');
                            const sibPanel = sib.querySelector('.accordion-panel');
                            if (sibTrigger) sibTrigger.setAttribute('aria-expanded', 'false');
                            if (sibPanel) sibPanel.style.maxHeight = null;
                        }
                    });

                    if (isOpen) {
                        item.classList.remove('is-open');
                        this.setAttribute('aria-expanded', 'false');
                        if (panel) panel.style.maxHeight = null;
                    } else {
                        item.classList.add('is-open');
                        this.setAttribute('aria-expanded', 'true');
                        if (panel) panel.style.maxHeight = panel.scrollHeight + 'px';
                    }
                });
            });
        });
    }

    // ─── Tabs Global ────────────────────────────────────────────────
    function initTabs() {
        const tabContainers = document.querySelectorAll('.tabs, .tabs-container');

        tabContainers.forEach(function (container) {
            const tabs = container.querySelectorAll('.tab-btn');
            const panels = container.querySelectorAll('.tab-panel');

            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    const dataTab = this.getAttribute('data-tab');
                    const targetId = this.getAttribute('aria-controls') || (dataTab ? 'tab-' + dataTab : null);

                    tabs.forEach(function (t) {
                        t.classList.remove('is-active');
                        t.setAttribute('aria-selected', 'false');
                        t.tabIndex = -1;
                    });
                    this.classList.add('is-active');
                    this.setAttribute('aria-selected', 'true');
                    this.tabIndex = 0;

                    panels.forEach(function (p) {
                        if (p.id === targetId || (dataTab && p.id === 'tab-' + dataTab)) {
                            p.classList.remove('hidden');
                            p.classList.add('is-active');
                            p.hidden = false;
                        } else {
                            p.classList.add('hidden');
                            p.classList.remove('is-active');
                            p.hidden = true;
                        }
                    });
                });

                // Klavye ok tuşları ile tab geçişi
                tab.addEventListener('keydown', function (e) {
                    const tabList = Array.from(tabs);
                    const index = tabList.indexOf(this);

                    let nextIndex = null;
                    if (e.key === 'ArrowRight') {
                        nextIndex = (index + 1) % tabList.length;
                    } else if (e.key === 'ArrowLeft') {
                        nextIndex = (index - 1 + tabList.length) % tabList.length;
                    }

                    if (nextIndex !== null) {
                        tabList[nextIndex].focus();
                        tabList[nextIndex].click();
                    }
                });
            });
        });
    }

})();
