document.addEventListener('DOMContentLoaded', function() {
    // Force dark mode by default
    document.body.classList.add('dark-mode');

    // Add staggered animation to tech cards
    const techCards = document.querySelectorAll('.tech-card');
    if (techCards.length > 0) {
        techCards.forEach((card, index) => {
            // Add a slight delay based on the card's index for a staggered effect
            card.style.animationDelay = `${index * 0.1}s`;
            
            // Add hover tracking for smooth icon color transitions
            card.addEventListener('mouseenter', function() {
                this.classList.add('tech-card-hover');
            });
            
            card.addEventListener('mouseleave', function() {
                this.classList.remove('tech-card-hover');
            });
        });
    }
});
// Menu Toggle for Mobile View
const menuToggle = document.querySelector('.menu-toggle');
const menu = document.querySelector('.menu');

menuToggle.addEventListener('click', () => {
    menu.classList.toggle('show');
});

//Smooth Scroll for Navigation Links
const navLinks = document.querySelectorAll('nav a[href^="#"], nav a[href^="about.php#"]');

navLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        let targetId = this.getAttribute('href').substring(1);
        if (targetId.includes('about.php#')) {
            targetId = targetId.split('#')[1];
        }
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 70, // Adjust based on nav height
                behavior: 'smooth'
            });
        }
    });
});

