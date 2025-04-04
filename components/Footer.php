<?php
/**
 * Footer Component
 * 
 * A reusable footer component that includes social links, copyright information,
 * and required JavaScript dependencies.
 */
?>

<footer>
    <div class="container">
        <div class="footer-content">
            <div class="social-links">
                <a href="https://github.com/yourusername" target="_blank" rel="noopener noreferrer" aria-label="GitHub Profile">
                    <i class="fab fa-github"></i>
                </a>
                <a href="https://linkedin.com/in/yourusername" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Profile">
                    <i class="fab fa-linkedin"></i>
                </a>
                <!-- Add more social links as needed -->
            </div>
            
            <p class="copyright">&copy; <?php echo date('Y'); ?> Elliot Tindall. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- JavaScript Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rellax/1.12.1/rellax.min.js"></script>

<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Initialize Lightbox with improved settings
    document.addEventListener('DOMContentLoaded', function() {
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'fadeDuration': 300,
            'imageFadeDuration': 300,
            'positionFromTop': 50,
            'disableScrolling': true,
            'alwaysShowNavOnTouchDevices': true,
            'showImageNumberLabel': false
        });
        
        // Add keyboard escape handler
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                lightbox.end();
            }
        });
    });
</script>



<!-- Custom Scripts -->
<script src="js/custom-carousel.js"></script>

<!-- Initialize AOS and Rellax -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS (Animate on Scroll)
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Initialize Rellax for parallax elements
        if (typeof Rellax === 'function') {
            const rellax = new Rellax('.rellax');
        }
    });
</script>
</body>
</html> 