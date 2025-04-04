<?php
/**
 * Navigation Component
 * 
 * A reusable navigation component for the site header
 * Handles responsive menu and active state
 */

// Determine current page for active state
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- Fixed Navigation Menu -->
<nav aria-label="Main Navigation">
    <div class="menu-toggle" aria-label="Toggle Menu">
        <i class="fa-solid fa-bars"></i>
    </div>
    <ul class="menu">
        <li><a href="#" style="pointer-events: none;"></a></li>
        <li><a href="index.php" <?php echo ($currentPage == 'index.php') ? 'class="active"' : ''; ?>>Home</a></li>
        <li><a href="#" style="pointer-events: none;"></a></li>
        <li><a href="about.php" <?php echo ($currentPage == 'about.php') ? 'class="active"' : ''; ?>>Projects</a></li>
        <li><a href="#" style="pointer-events: none;"></a></li>
        <li><a href="contact.php" <?php echo ($currentPage == 'contact.php') ? 'class="active"' : ''; ?>>Contact</a></li>
        <li><a href="#" style="pointer-events: none;"></a></li>
    </ul>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.menu');
    
    if (menuToggle && menu) {
        menuToggle.addEventListener('click', function() {
            menu.classList.toggle('show');
            menuToggle.classList.toggle('active');
        });
    }
    
    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!menu.contains(event.target) && !menuToggle.contains(event.target) && menu.classList.contains('show')) {
            menu.classList.remove('show');
            menuToggle.classList.remove('active');
        }
    });
});
</script> 