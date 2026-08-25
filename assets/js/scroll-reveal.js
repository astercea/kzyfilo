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
        const stats = document.querySelectorAll('.stat-number, .stat-value, .stat-val');
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
            threshold: 0.4
        });

        stats.forEach(function (stat) {
            observer.observe(stat);
        });

        function animateCounter(el) {
            const raw = el.textContent.trim();
            const match = raw.match(/([\d\.,]+)/);
            if (!match) return;

            const numStr = match[1].replace(/\./g, '').replace(',', '.');
            const target = parseFloat(numStr);
            if (isNaN(target)) return;

            const prefix = raw.substring(0, raw.indexOf(match[1]));
            const suffix = raw.substring(raw.indexOf(match[1]) + match[1].length);

            const duration = 1200;
            const startTime = performance.now();

            function tick(now) {
                const elapsed = now - startTime;
                const progress = Math.min(elapsed / duration, 1);
                // Ease out expo
                const ease = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                const current = Math.round(target * ease);

                const formatted = current.toLocaleString('tr-TR');
                el.textContent = `${prefix}${formatted}${suffix}`;

                if (progress < 1) {
                    requestAnimationFrame(tick);
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
