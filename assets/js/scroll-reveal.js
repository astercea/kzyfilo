/**
 * kzyfilo — Motion & Scroll Engine
 * KZY Executive Motion — Premium Editorial Fleet Experience
 * 
 * Features:
 * - IntersectionObserver-based reveal animations
 * - Counter animation for corporate statistics
 * - Subtle hero parallax effect on non-touch devices
 * - Scroll progress indicator
 * - Safe fallback for prefers-reduced-motion
 */

(function () {
    'use strict';

    const isTouch = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || window.matchMedia('(max-width: 1023px)').matches;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    document.addEventListener('DOMContentLoaded', function () {
        initScrollProgress();
        initRevealAnimations();
        initCounterAnimations();
        initEditorialInlineReveal();
        initScrollWordReveal();
    });

    // ─── Top Scroll Progress Bar ────────────────────────────────────
    function initScrollProgress() {
        const bar = document.getElementById('scroll-progress');
        if (!bar) return;

        function updateProgress() {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            bar.style.width = progress + '%';
        }

        window.addEventListener('scroll', updateProgress, { passive: true });
        updateProgress();
    }

    // ─── Reveal Animations (IntersectionObserver) ───────────────────
    function initRevealAnimations() {
        const revealEls = document.querySelectorAll('[data-reveal]');
        if (!revealEls.length) return;

        if (prefersReducedMotion) {
            revealEls.forEach(function (el) {
                el.classList.add('is-visible');
            });
            return;
        }

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const delay = parseInt(el.getAttribute('data-reveal-delay') || '0', 10);

                    if (delay > 0) {
                        setTimeout(function () {
                            el.classList.add('is-visible');
                        }, delay);
                    } else {
                        el.classList.add('is-visible');
                    }

                    observer.unobserve(el);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -30px 0px'
        });

        revealEls.forEach(function (el) {
            observer.observe(el);
        });
    }

    // ─── Editorial Inline Photos Reveal ─────────────────────────────
    function initEditorialInlineReveal() {
        const inlineWraps = document.querySelectorAll('.editorial-inline-wrap');
        if (!inlineWraps.length || prefersReducedMotion) return;

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-expanded');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.2
        });

        inlineWraps.forEach(function (wrap) {
            observer.observe(wrap);
        });
    }

    // ─── Counter Animation ──────────────────────────────────────────
    function initCounterAnimations() {
        const stats = document.querySelectorAll('.stat-number, .stat-value, .stat-val, .solution-metric-val, [data-counter]');
        if (!stats.length) return;

        if (prefersReducedMotion) return;

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    animateCounter(el);
                    observer.unobserve(el);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -30px 0px'
        });

        stats.forEach(function (stat) {
            observer.observe(stat);
        });

        function animateCounter(el) {
            const raw = el.textContent.trim();
            if (raw.includes('/')) return; // Ignore static fractions like 7/24

            const match = raw.match(/([\d\.,]+)/);
            if (!match) return;

            const numText = match[1];
            const prefix = raw.substring(0, raw.indexOf(numText));
            const suffix = raw.substring(raw.indexOf(numText) + numText.length);

            let isDecimal = false;
            let decimalPlaces = 0;
            let target = 0;

            if (numText.includes('.')) {
                const parts = numText.split('.');
                // If 3 digits after single dot (e.g. 2.500), it's thousands separator
                if (parts.length === 2 && parts[1].length === 3 && parseInt(parts[0], 10) < 1000) {
                    target = parseFloat(numText.replace(/\./g, ''));
                } else if (parts[parts.length - 1].length <= 2) {
                    // e.g. 99.8 or 98.4
                    isDecimal = true;
                    decimalPlaces = parts[parts.length - 1].length;
                    target = parseFloat(numText);
                } else {
                    target = parseFloat(numText.replace(/\./g, ''));
                }
            } else if (numText.includes(',')) {
                const parts = numText.split(',');
                if (parts[parts.length - 1].length <= 2) {
                    isDecimal = true;
                    decimalPlaces = parts[parts.length - 1].length;
                    target = parseFloat(numText.replace(',', '.'));
                } else {
                    target = parseFloat(numText.replace(/,/g, ''));
                }
            } else {
                target = parseFloat(numText);
            }

            if (isNaN(target)) return;

            const duration = 1400;
            const startTime = performance.now();

            function tick(now) {
                const elapsed = now - startTime;
                const progress = Math.min(elapsed / duration, 1);
                // Ease out expo for sleek luxury motion
                const ease = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                const currentVal = target * ease;

                let formatted = '';
                if (isDecimal) {
                    formatted = currentVal.toFixed(decimalPlaces);
                } else if (target >= 1000) {
                    formatted = Math.round(currentVal).toLocaleString('tr-TR');
                } else {
                    formatted = Math.round(currentVal).toString();
                }

                el.textContent = `${prefix}${formatted}${suffix}`;

                if (progress < 1) {
                    requestAnimationFrame(tick);
                } else {
                    const finalFormatted = isDecimal 
                        ? target.toFixed(decimalPlaces) 
                        : (target >= 1000 ? target.toLocaleString('tr-TR') : target.toString());
                    el.textContent = `${prefix}${finalFormatted}${suffix}`;
                }
            }

            requestAnimationFrame(tick);
        }
    }

    // ─── Scroll Word-by-Word Text Reveal ─────────────────────────────
    function initScrollWordReveal() {
        const textRevealEls = document.querySelectorAll('.editorial-headline-scroll');
        if (!textRevealEls.length) return;

        textRevealEls.forEach(function (el) {
            const text = el.textContent.trim();
            const words = text.split(/\s+/);
            el.innerHTML = words.map(function (word) {
                return '<span class="scroll-word">' + word + '</span>';
            }).join(' ');
        });

        function updateWordProgress() {
            const viewportHeight = window.innerHeight;

            textRevealEls.forEach(function (el) {
                const rect = el.getBoundingClientRect();
                const words = el.querySelectorAll('.scroll-word');
                if (!words.length) return;

                // Start when element enters from bottom (90% of viewport)
                // Fully completed when element reaches 20% of viewport (slower, wider pace)
                const startY = viewportHeight * 0.90;
                const endY = viewportHeight * 0.20;
                const progress = Math.max(0, Math.min(1, (startY - rect.top) / (startY - endY)));

                const activeWordCount = Math.floor(progress * (words.length + 1));

                words.forEach(function (word, index) {
                    if (index < activeWordCount) {
                        word.classList.add('is-active');
                    } else {
                        word.classList.remove('is-active');
                    }
                });
            });
        }

        window.addEventListener('scroll', updateWordProgress, { passive: true });
        window.addEventListener('resize', updateWordProgress, { passive: true });
        updateWordProgress();
    }
})();
