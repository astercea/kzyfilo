/**
 * kzyfilo — Hero Slider & Carousel JavaScript Modülü
 */

(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        initHeroSlider();
        initCarousels();
        initStatsCounter();
    });

    // ─── Hero Slider ────────────────────────────────────────────────
    function initHeroSlider() {
        const slider = document.getElementById('hero-slider');
        if (!slider) return;

        const track = slider.querySelector('.slider-track');
        const slides = slider.querySelectorAll('.slider-slide');
        const prevBtn = slider.querySelector('.slider-prev');
        const nextBtn = slider.querySelector('.slider-next');
        const dots = slider.querySelectorAll('.slider-dot');

        if (!track || slides.length === 0) return;

        let currentIndex = 0;
        const totalSlides = slides.length;
        let autoPlayTimer = null;
        const autoPlayInterval = 6000;
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        function updateSlide(index, animate = true) {
            if (index < 0) index = totalSlides - 1;
            if (index >= totalSlides) index = 0;
            currentIndex = index;

            if (prefersReducedMotion) {
                track.style.transition = 'none';
            } else {
                track.style.transition = animate ? 'transform 0.5s ease' : 'none';
            }

            track.style.transform = `translateX(-${currentIndex * 100}%)`;

            // Update dots
            dots.forEach(function (dot, i) {
                if (i === currentIndex) {
                    dot.classList.add('is-active');
                    dot.setAttribute('aria-selected', 'true');
                } else {
                    dot.classList.remove('is-active');
                    dot.setAttribute('aria-selected', 'false');
                }
            });

            // Update ARIA on slides
            slides.forEach(function (slide, i) {
                if (i === currentIndex) {
                    slide.setAttribute('aria-hidden', 'false');
                } else {
                    slide.setAttribute('aria-hidden', 'true');
                }
            });
        }

        function startAutoPlay() {
            if (prefersReducedMotion) return;
            stopAutoPlay();
            autoPlayTimer = setInterval(function () {
                updateSlide(currentIndex + 1);
            }, autoPlayInterval);
        }

        function stopAutoPlay() {
            if (autoPlayTimer) {
                clearInterval(autoPlayTimer);
                autoPlayTimer = null;
            }
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                updateSlide(currentIndex - 1);
                startAutoPlay();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                updateSlide(currentIndex + 1);
                startAutoPlay();
            });
        }

        dots.forEach(function (dot) {
            dot.addEventListener('click', function () {
                const targetIndex = parseInt(this.getAttribute('data-index'), 10);
                updateSlide(targetIndex);
                startAutoPlay();
            });
        });

        // Hover pause
        slider.addEventListener('mouseenter', stopAutoPlay);
        slider.addEventListener('mouseleave', startAutoPlay);

        // Keyboard navigation
        slider.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft') {
                updateSlide(currentIndex - 1);
                startAutoPlay();
            } else if (e.key === 'ArrowRight') {
                updateSlide(currentIndex + 1);
                startAutoPlay();
            }
        });

        // Touch Swipe
        let touchStartX = 0;
        let touchEndX = 0;

        slider.addEventListener('touchstart', function (e) {
            touchStartX = e.changedTouches[0].screenX;
            stopAutoPlay();
        }, { passive: true });

        slider.addEventListener('touchend', function (e) {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    updateSlide(currentIndex + 1);
                } else {
                    updateSlide(currentIndex - 1);
                }
            }
            startAutoPlay();
        }, { passive: true });

        // Initialize
        updateSlide(0, false);
        startAutoPlay();
    }

    // ─── Generic Carousels (Featured Vehicles, etc.) ────────────────
    function initCarousels() {
        const carousels = document.querySelectorAll('.carousel');

        carousels.forEach(function (carousel) {
            const track = carousel.querySelector('.carousel-track');
            const prevBtn = carousel.querySelector('.carousel-prev');
            const nextBtn = carousel.querySelector('.carousel-next');

            if (!track) return;

            if (prevBtn) {
                prevBtn.addEventListener('click', function () {
                    const cardWidth = track.firstElementChild ? track.firstElementChild.offsetWidth + 24 : 300;
                    track.scrollBy({ left: -cardWidth, behavior: 'smooth' });
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function () {
                    const cardWidth = track.firstElementChild ? track.firstElementChild.offsetWidth + 24 : 300;
                    track.scrollBy({ left: cardWidth, behavior: 'smooth' });
                });
            }
        });
    }

    // ─── Stats Counter Animation ────────────────────────────────────
    function initStatsCounter() {
        const statElements = document.querySelectorAll('.stat-number[data-target]');
        if (statElements.length === 0) return;

        let hasAnimated = false;

        function checkStatsVisibility() {
            if (hasAnimated) return;

            const firstStat = statElements[0];
            const rect = firstStat.getBoundingClientRect();
            if (rect.top <= window.innerHeight * 0.9 && rect.bottom >= 0) {
                hasAnimated = true;
                statElements.forEach(function (el) {
                    const target = parseInt(el.getAttribute('data-target'), 10);
                    const prefix = el.getAttribute('data-prefix') || '';
                    const suffix = el.getAttribute('data-suffix') || '';
                    const duration = 1500;
                    const stepTime = 30;
                    const steps = duration / stepTime;
                    const increment = target / steps;
                    let current = 0;

                    const timer = setInterval(function () {
                        current += increment;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        el.textContent = prefix + Math.floor(current).toLocaleString('tr-TR') + suffix;
                    }, stepTime);
                });
            }
        }

        window.addEventListener('scroll', checkStatsVisibility, { passive: true });
        checkStatsVisibility();
    }

})();
