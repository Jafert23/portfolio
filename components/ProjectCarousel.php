<?php
/**
 * Project Carousel Component
 * 
 * A more robust and reusable carousel component for project screenshots
 * 
 * @param array $screenshots Array of screenshot image paths
 * @param string $altText Alt text for the images (usually project title)
 */

// Validate inputs
if (empty($screenshots) || !is_array($screenshots)) {
    return; // Exit if no screenshots or invalid format
}
?>

<div class="project-carousel">
    <!-- Carousel Controls -->
    <div class="carousel-controls">
        <div class="carousel-arrow prev-slide" aria-label="Previous slide">
            <i class="fas fa-chevron-left"></i>
        </div>
        <div class="carousel-arrow next-slide" aria-label="Next slide">
            <i class="fas fa-chevron-right"></i>
        </div>
    </div>
    
    <!-- Carousel Slides -->
    <div class="carousel-container">
        <?php foreach ($screenshots as $index => $screenshot): ?>
            <div class="carousel-slide <?php echo $index === 0 ? 'active' : ''; ?>" 
                 data-index="<?php echo $index; ?>"
                 aria-hidden="<?php echo $index === 0 ? 'false' : 'true'; ?>">
                <img src="<?php echo htmlspecialchars($screenshot, ENT_QUOTES, 'UTF-8'); ?>"
                     alt="<?php echo htmlspecialchars($altText, ENT_QUOTES, 'UTF-8'); ?> - Screenshot <?php echo $index + 1; ?>"
                     loading="<?php echo $index < 2 ? 'eager' : 'lazy'; ?>">
                <div class="carousel-caption">
                    <?php echo htmlspecialchars($altText, ENT_QUOTES, 'UTF-8'); ?> - Screenshot <?php echo $index + 1; ?> of <?php echo count($screenshots); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Carousel Navigation Dots -->
    <div class="carousel-nav">
        <?php foreach ($screenshots as $index => $screenshot): ?>
            <div class="carousel-dot <?php echo $index === 0 ? 'active' : ''; ?>" 
                 data-index="<?php echo $index; ?>"
                 aria-label="Go to slide <?php echo $index + 1; ?>"></div>
        <?php endforeach; ?>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carouselId = Math.random().toString(36).substring(2, 8); // Generate unique ID
    const carousel = document.querySelector('.project-carousel');
    
    // Exit if no carousel
    if (!carousel) return;
    
    // Add unique ID to carousel
    carousel.setAttribute('id', `carousel-${carouselId}`);
    
    // Select elements
    const slides = carousel.querySelectorAll('.carousel-slide');
    const dots = carousel.querySelectorAll('.carousel-dot');
    const nextBtn = carousel.querySelector('.next-slide');
    const prevBtn = carousel.querySelector('.prev-slide');
    const fullscreenBtn = carousel.querySelector('.carousel-fullscreen');
    
    let currentSlide = 0;
    let slideInterval;
    let touchStartX = 0;
    let touchEndX = 0;
    let isFullscreen = false;
    
    // Function to show a specific slide
    function showSlide(index) {
        // Handle index boundaries
        if (index >= slides.length) {
            index = 0;
        } else if (index < 0) {
            index = slides.length - 1;
        }
        
        // Update ARIA attributes for accessibility
        slides.forEach(slide => {
            slide.setAttribute('aria-hidden', 'true');
        });
        slides[index].setAttribute('aria-hidden', 'false');
        
        // Fade out current slide
        slides[currentSlide].style.opacity = 0;
        setTimeout(() => {
            slides[currentSlide].classList.remove('active');
            
            // Add active class to new slide and fade in
            slides[index].classList.add('active');
            setTimeout(() => {
                slides[index].style.opacity = 1;
            }, 50);
            
        }, 400); // Match with CSS transition timing
        
        // Update dots
        dots.forEach(dot => dot.classList.remove('active'));
        dots[index].classList.add('active');
        
        // Update current slide index
        currentSlide = index;
    }
    
    // Navigation functions
    function nextSlide() {
        showSlide(currentSlide + 1);
    }
    
    function prevSlide() {
        showSlide(currentSlide - 1);
    }
    
    // Start automatic rotation
    function startSlideShow() {
        slideInterval = setInterval(nextSlide, 5000);
    }
    
    // Toggle fullscreen
    function toggleFullscreen() {
        if (!isFullscreen) {
            if (carousel.requestFullscreen) {
                carousel.requestFullscreen();
            } else if (carousel.mozRequestFullScreen) {
                carousel.mozRequestFullScreen();
            } else if (carousel.webkitRequestFullscreen) {
                carousel.webkitRequestFullscreen();
            } else if (carousel.msRequestFullscreen) {
                carousel.msRequestFullscreen();
            }
            fullscreenBtn.innerHTML = '<i class="fas fa-compress"></i>';
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
            fullscreenBtn.innerHTML = '<i class="fas fa-expand"></i>';
        }
        isFullscreen = !isFullscreen;
    }
    
    // Event listeners
    if (fullscreenBtn) {
        fullscreenBtn.addEventListener('click', toggleFullscreen);
    }
    
    // Mouse/touch events
    carousel.addEventListener('mouseenter', () => clearInterval(slideInterval));
    carousel.addEventListener('mouseleave', startSlideShow);
    
    // Touch swipe support
    carousel.addEventListener('touchstart', e => {
        touchStartX = e.changedTouches[0].screenX;
    });
    
    carousel.addEventListener('touchend', e => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        if (touchEndX < touchStartX - swipeThreshold) {
            // Swipe left - next slide
            clearInterval(slideInterval);
            nextSlide();
            startSlideShow();
        } else if (touchEndX > touchStartX + swipeThreshold) {
            // Swipe right - previous slide
            clearInterval(slideInterval);
            prevSlide();
            startSlideShow();
        }
    }
    
    // Arrow navigation
    if (nextBtn) nextBtn.addEventListener('click', () => {
        clearInterval(slideInterval);
        nextSlide();
        startSlideShow();
    });
    
    if (prevBtn) prevBtn.addEventListener('click', () => {
        clearInterval(slideInterval);
        prevSlide();
        startSlideShow();
    });
    
    // Dot navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            clearInterval(slideInterval);
            showSlide(index);
            startSlideShow();
        });
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        // Only proceed if the carousel is in focus (has an active slide)
        const hasActiveSlide = carousel.querySelector('.carousel-slide.active');
        if (!hasActiveSlide) return;
        
        if (e.key === 'ArrowLeft') {
            clearInterval(slideInterval);
            prevSlide();
            startSlideShow();
        } else if (e.key === 'ArrowRight') {
            clearInterval(slideInterval);
            nextSlide();
            startSlideShow();
        }
    });
    
    // Start the slideshow if we have slides
    if (slides.length > 0) {
        showSlide(0); // Explicitly show first slide
        startSlideShow();
    }
});
</script> 