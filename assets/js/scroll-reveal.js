/**
 * kzyfilo — Motion & Scroll Engine
 * KZY Night Drive — Premium Fleet Experience
 * 
 * Features:
 * - IntersectionObserver-based reveal animations
 * - Dynamic vertical-to-horizontal card track engine with progress line
 * - Mouse pointer spotlight and border glow engine (--pointer-x, --pointer-y)
 * - Hero mouse parallax with return transition
 * - Ambient cursor glow follower
 * - Counter animation for statistics
 * - Scroll progress bar
 * - prefers-reduced-motion and touch device protection
 */

(function () {
    'use strict';

    const isTouch = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || window.matchMedia('(max-width: 1023px)').matches;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    document.addEventListener('DOMContentLoaded', function () {
        initScrollProgress();
        initRevealAnimations();
        initCounterAnimations();
        initHorizontalScroll();

        if (!isTouch && !prefersReducedMotion) {
            initSpotlightEffect();
            initAmbientFollower();
        }
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
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        revealEls.forEach(function (el) {
            observer.observe(el);
        });
    }

    // ─── Horizontal Card Track Scroll Engine ────────────────────────
    function initHorizontalScroll() {
        const wrapper = document.querySelector('.horizontal-scroll-wrapper');
        const container = document.querySelector('.horizontal-scroll-container');
        const track = document.querySelector('.horizontal-scroll-track');
        const cards = track ? track.querySelectorAll('.night-card') : [];
        const aura = document.getElementById('horizontal-center-aura');
        const progressFill = document.getElementById('horizontal-progress-fill');
        const progressDot = document.getElementById('horizontal-progress-dot');

        if (!wrapper || !container || !track || !cards.length) return;

        // Mobile / Tablet touch mode
        if (isTouch || prefersReducedMotion || window.innerWidth < 1024) {
            function updateMobileCards() {
                const containerRect = container.getBoundingClientRect();
                const containerCenterX = containerRect.left + (containerRect.width / 2);
                const radius = Math.min(containerRect.width * 0.45, 240);

                cards.forEach(function (card) {
                    const rect = card.getBoundingClientRect();
                    const cardCenterX = rect.left + (rect.width / 2);
                    const dist = Math.abs(cardCenterX - containerCenterX);
                    let proximity = Math.max(0, 1 - (dist / radius));
                    const eased = Math.sin((proximity * Math.PI) / 2);

                    const scale = (0.92 + (0.16 * eased)).toFixed(3);
                    card.style.setProperty('--card-scale', scale);

                    if (eased > 0.6) {
                        card.classList.add('is-center-spotlight');
                    } else {
                        card.classList.remove('is-center-spotlight');
                    }
                });
            }

            container.addEventListener('scroll', updateMobileCards, { passive: true });
            setTimeout(updateMobileCards, 100);
            return;
        }

        let isTicking = false;

        function updateHorizontalTrack() {
            const wrapperRect = wrapper.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            const totalScrollDistance = wrapper.offsetHeight - windowHeight;

            if (totalScrollDistance <= 0) return;

            const topbarEl = document.querySelector('.topbar');
            const headerEl = document.querySelector('.site-header');
            const topbarH = (topbarEl && window.getComputedStyle(topbarEl).display !== 'none') ? topbarEl.offsetHeight : 0;
            const headerH = headerEl ? headerEl.offsetHeight : 72;
            const headerOffset = topbarH + headerH;

            // 1. First card does NOT start transitioning until the sticky section reaches top / header lock
            // When wrapperRect.top > headerOffset, section hasn't locked into place -> progress is strictly 0
            // When wrapperRect.top < headerOffset - totalScrollDistance -> progress is strictly 1
            let progress = (headerOffset - wrapperRect.top) / totalScrollDistance;
            progress = Math.max(0, Math.min(1, progress));

            const totalCards = cards.length;
            const cardWidthWithGap = (cards.length > 1 && cards[1].offsetLeft > cards[0].offsetLeft) 
                ? (cards[1].offsetLeft - cards[0].offsetLeft) 
                : 372;
            const maxTranslateX = (totalCards - 1) * cardWidthWithGap;
            const stepY = 80;
            const maxTranslateY = (totalCards - 1) * stepY;

            // 2D Staircase Translation: Moves horizontally and climbs vertically per scroll step
            const translateX = progress * maxTranslateX;
            const translateY = progress * maxTranslateY;

            track.style.transform = 'translate3d(-' + translateX.toFixed(1) + 'px, -' + translateY.toFixed(1) + 'px, 0)';

            // Active card calculation across the 5 cards (0.0 to 4.0)
            const activeIndex = progress * (totalCards - 1);
            let maxCenterProximity = 0;

            cards.forEach(function (card, index) {
                const dist = Math.abs(index - activeIndex);
                let proximity = Math.max(0, 1 - dist);

                // Smooth sine curve easing for progressive growth
                const eased = Math.sin((proximity * Math.PI) / 2);
                if (eased > maxCenterProximity) {
                    maxCenterProximity = eased;
                }

                // Card grows comfortably from 0.90 to 1.06 when active without colliding with header
                const scale = (0.90 + (0.16 * eased)).toFixed(3);
                const zIndex = Math.round(eased * 20) + 1;

                card.style.setProperty('--card-scale', scale);
                card.style.zIndex = zIndex;

                if (eased > 0.6) {
                    card.classList.add('is-center-spotlight');
                } else {
                    card.classList.remove('is-center-spotlight');
                }
            });

            // Update center luminous background aura
            if (aura) {
                aura.style.opacity = (0.35 + 0.65 * maxCenterProximity).toFixed(3);
                aura.style.transform = 'translate(-50%, -50%) scale(' + (0.9 + 0.35 * maxCenterProximity).toFixed(3) + ')';
            }

            // Update custom progress bar
            if (progressFill) {
                const percent = (progress * 100).toFixed(2);
                progressFill.style.width = percent + '%';
                if (progressDot) {
                    progressDot.style.left = percent + '%';
                }
            }

            isTicking = false;
        }

        function onScroll() {
            if (!isTicking) {
                requestAnimationFrame(updateHorizontalTrack);
                isTicking = true;
            }
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024 && !prefersReducedMotion) {
                updateHorizontalTrack();
            }
        }, { passive: true });

        updateHorizontalTrack();
    }

    // ─── Mouse Pointer Spotlight & Glowing Border ───────────────────
    function initSpotlightEffect() {
        const spotlightEls = document.querySelectorAll('[data-spotlight]');
        if (!spotlightEls.length) return;

        spotlightEls.forEach(function (el) {
            let rafId = null;

            el.addEventListener('mousemove', function (e) {
                if (rafId) return;

                rafId = requestAnimationFrame(function () {
                    const rect = el.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const xPercent = ((x / rect.width) * 100).toFixed(2);
                    const yPercent = ((y / rect.height) * 100).toFixed(2);

                    el.style.setProperty('--pointer-x', xPercent + '%');
                    el.style.setProperty('--pointer-y', yPercent + '%');
                    el.style.setProperty('--mouse-x', x + 'px');
                    el.style.setProperty('--mouse-y', y + 'px');
                    el.classList.add('has-spotlight');

                    rafId = null;
                });
            });

            el.addEventListener('mouseleave', function () {
                el.classList.remove('has-spotlight');
            });
        });
    }

    // ─── Hero Mouse Parallax ────────────────────────────────────────
    function initHeroParallax() {
        const heroSection = document.querySelector('.hero');
        if (!heroSection) return;

        const parallaxEls = heroSection.querySelectorAll('[data-parallax]');
        if (!parallaxEls.length) return;

        let rafId = null;

        heroSection.addEventListener('mousemove', function (e) {
            if (rafId) return;

            rafId = requestAnimationFrame(function () {
                const rect = heroSection.getBoundingClientRect();
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const mouseX = e.clientX - rect.left;
                const mouseY = e.clientY - rect.top;

                const offsetX = ((mouseX - centerX) / centerX);
                const offsetY = ((mouseY - centerY) / centerY);

                parallaxEls.forEach(function (el) {
                    const intensity = parseFloat(el.getAttribute('data-parallax') || '12');
                    const tx = offsetX * intensity;
                    const ty = offsetY * intensity;
                    el.style.transform = 'translate(' + tx.toFixed(2) + 'px, ' + ty.toFixed(2) + 'px)';
                });

                rafId = null;
            });
        });

        heroSection.addEventListener('mouseleave', function () {
            parallaxEls.forEach(function (el) {
                el.style.transition = 'transform 0.6s var(--ease-out-expo)';
                el.style.transform = 'translate(0, 0)';
                setTimeout(function () {
                    el.style.transition = '';
                }, 600);
            });
        });
    }

    // ─── Ambient Cursor Glow Follower ───────────────────────────────
    function initAmbientFollower() {
        let follower = document.getElementById('ambient-glow-follower');
        if (!follower) {
            follower = document.createElement('div');
            follower.id = 'ambient-glow-follower';
            document.body.appendChild(follower);
        }

        let rafId = null;

        window.addEventListener('mousemove', function (e) {
            if (rafId) return;

            rafId = requestAnimationFrame(function () {
                follower.style.opacity = '1';
                follower.style.transform = 'translate3d(' + e.clientX + 'px, ' + e.clientY + 'px, 0)';
                rafId = null;
            });
        }, { passive: true });

        document.addEventListener('mouseleave', function () {
            follower.style.opacity = '0';
        });
    }

    // ─── Counter Animations ─────────────────────────────────────────
    function initCounterAnimations() {
        const counters = document.querySelectorAll('[data-counter]');
        if (!counters.length) return;

        if (prefersReducedMotion) return;

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.3
        });

        counters.forEach(function (el) {
            observer.observe(el);
        });
    }

    function animateCounter(el) {
        const target = parseInt(el.getAttribute('data-counter'), 10);
        const duration = parseInt(el.getAttribute('data-counter-duration') || '2000', 10);
        const prefix = el.getAttribute('data-counter-prefix') || '';
        const suffix = el.getAttribute('data-counter-suffix') || '';
        const separator = el.getAttribute('data-counter-separator') !== 'false';

        const startTime = performance.now();

        function easeOutExpo(t) {
            return t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
        }

        function formatNumber(num) {
            if (!separator) return num.toString();
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easeOutExpo(progress);
            const current = Math.round(easedProgress * target);

            el.textContent = prefix + formatNumber(current) + suffix;

            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }

        requestAnimationFrame(update);
    }

})();
