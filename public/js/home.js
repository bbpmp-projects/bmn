document.addEventListener('DOMContentLoaded', () => {

    // ==========================
    // Banner Carousel
    // ==========================
    const slidesContainer = document.getElementById('slides-container');
    const dots = document.querySelectorAll('.dot');
    const nextBtn = document.getElementById('next-slide');
    const prevBtn = document.getElementById('prev-slide');

    if (slidesContainer && dots.length > 0) {
        let currentSlide = 0;
        const totalSlides = dots.length;

        function updateSlide(index) {
            currentSlide = index;
            slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;

            dots.forEach((dot, i) => {
                if (i === currentSlide) {
                    dot.classList.remove('bg-white/50');
                    dot.classList.add('bg-white/80');
                } else {
                    dot.classList.remove('bg-white/80');
                    dot.classList.add('bg-white/50');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateSlide(currentSlide);
        }

        // Auto slide
        let autoSlide = setInterval(nextSlide, 5000);

        // Navigation buttons (desktop only, tapi tetap ada di DOM)
        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                clearInterval(autoSlide);
                nextSlide();
                autoSlide = setInterval(nextSlide, 5000);
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                clearInterval(autoSlide);
                prevSlide();
                autoSlide = setInterval(nextSlide, 5000);
            });
        }

        // Dots navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', function () {
                clearInterval(autoSlide);
                updateSlide(index);
                autoSlide = setInterval(nextSlide, 5000);
            });
        });
    }

    // ==========================
    // Scroll halus ke fitur
    // ==========================
    const scrollToFeaturesBtn = document.getElementById('scroll-to-features');
    const featuresSection = document.getElementById('features-section');

    if (scrollToFeaturesBtn && featuresSection) {
        scrollToFeaturesBtn.addEventListener('click', function () {
            featuresSection.scrollIntoView({
                behavior: 'smooth'
            });
        });
    }
});
