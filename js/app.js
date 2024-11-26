
// Menu Toggle for Mobile View
const menuToggle = document.querySelector('.menu-toggle');
const menu = document.querySelector('.menu');

menuToggle.addEventListener('click', () => {
    menu.classList.toggle('show');
});

// Skill Bar Animation
document.addEventListener('DOMContentLoaded', function() {
    const skillBars = document.querySelectorAll('.skill-bar');
    skillBars.forEach(function(bar) {
        const skillLevel = bar.getAttribute('data-skill-level');
        bar.style.setProperty('--skill-level', skillLevel);
        
        // Add the 'animate' class after a short delay to trigger the transition
        setTimeout(() => {
            bar.classList.add('animate');
        }, 100); // 100ms delay
    });
});

// Optional: Smooth Scroll for Navigation Links
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

//JavaScript for Assigning Classes to Segments 

    document.addEventListener('DOMContentLoaded', function() {
        const skillBars = document.querySelectorAll('.skill-bar');

        skillBars.forEach(bar => {
            const level = parseFloat(bar.getAttribute('data-skill-level'));
            const segments = bar.querySelectorAll('.segment');

            // Determine number of segments to fill based on skill level
            const filledSegments = Math.floor(level);
            const hasHalf = level % 1 >= 0.5;

            // Determine proficiency class based on level
            let proficiencyClass = '';
            if (level >= 3) {
                proficiencyClass = 'high';
            } else if (level >= 2) {
                proficiencyClass = 'medium';
            } else {
                proficiencyClass = 'low';
            }

            // Fill the segments
            segments.forEach((segment, index) => {
                if (index < filledSegments) {
                    segment.classList.add('filled', proficiencyClass);
                } else if (index === filledSegments && hasHalf) {
                    // Optional: Implement half-filled segments if needed
                    // For simplicity, we'll treat half as full in this example
                    segment.classList.add('filled', proficiencyClass);
                }
            });
        });
    });