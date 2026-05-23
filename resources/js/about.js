document.addEventListener('DOMContentLoaded', () => {
    const captions = document.querySelectorAll('[data-about-hero-caption]');
    const heroRoot = document.querySelector('.about-hero');

    if (!captions.length || !heroRoot) {
        return;
    }

    const syncCaptions = () => {
        const slides = heroRoot.querySelectorAll('.hero-slide');
        let activeIndex = 0;

        slides.forEach((slide, index) => {
            if (slide.classList.contains('active')) {
                activeIndex = index;
            }
        });

        captions.forEach((caption, index) => {
            caption.classList.toggle('active', index === activeIndex);
        });
    };

    syncCaptions();
    setInterval(syncCaptions, 350);
});
