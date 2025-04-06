/**
 * Projects Redesign - JavaScript Functionality
 * Enhances the projects showcase with animations and interactive elements
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations for project cards
    initProjectCards();
    
    // Initialize filter system
    initFilterSystem();
    
    // Initialize masonry layout if the library is available
    initMasonryLayout();
    
    // Initialize category tabs if they exist
    initCategoryTabs();
});

/**
 * Initialize project card animations and interactions
 */
function initProjectCards() {
    const projectCards = document.querySelectorAll('.project-card');
    
    // Add mouse movement effect to cards for a subtle 3D effect
    projectCards.forEach(card => {
        card.addEventListener('mousemove', function(e) {
            // Skip the effect for mobile devices
            if (window.innerWidth < 992) return;
            
            const cardRect = card.getBoundingClientRect();
            const cardCenterX = cardRect.left + cardRect.width / 2;
            const cardCenterY = cardRect.top + cardRect.height / 2;
            
            // Calculate the mouse position relative to the card center
            const mouseX = e.clientX - cardCenterX;
            const mouseY = e.clientY - cardCenterY;
            
            // Calculate the rotation angle (max 5 degrees)
            const rotateX = mouseY * -0.01;
            const rotateY = mouseX * 0.01;
            
            // Apply the transformation
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });
        
        // Reset card position when mouse leaves
        card.addEventListener('mouseleave', function() {
            card.style.transform = '';
            
            // Add a slight transition for smoother reset
            card.style.transition = 'transform 0.5s ease';
            
            // Remove the transition after it's complete
            setTimeout(() => {
                card.style.transition = '';
            }, 500);
        });
    });
    
    // Check if Intersection Observer is supported for scroll animations
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Add a class to trigger animations when the card comes into view
                    entry.target.classList.add('in-view');
                    
                    // Stop observing once the animation has been triggered
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.2, // Trigger when at least 20% of the card is visible
            rootMargin: '0px 0px -100px 0px' // Offset from the bottom
        });
        
        // Observe all project cards
        projectCards.forEach(card => {
            observer.observe(card);
        });
    }
}

/**
 * Initialize the filtering system
 */
function initFilterSystem() {
    const filterButtons = document.querySelectorAll('.filter-button');
    const projectCards = document.querySelectorAll('.project-card');
    const loadingAnimation = document.querySelector('.loading-animation');
    
    // Set initial state: show all projects
    projectCards.forEach(card => {
        card.style.display = 'flex';
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
    });
    
    // Add click event to filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active button state
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Get the filter value
            const filterValue = this.getAttribute('data-filter');
            
            // Show loading animation
            if (loadingAnimation) {
                loadingAnimation.style.display = 'block';
            }
            
            // Hide all projects first with a fade-out effect
            projectCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
            });
            
            // Simulate loading delay for a smoother transition
            setTimeout(() => {
                projectCards.forEach(card => {
                    // Hide all cards first
                    card.style.display = 'none';
                    
                    // Get card category
                    const category = card.getAttribute('data-category');
                    
                    // Show cards matching the filter
                    if (filterValue === 'all' || filterValue === category) {
                        card.style.display = 'flex';
                        
                        // Add a staggered reveal animation
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 50 * Array.from(projectCards).indexOf(card));
                    }
                });
                
                // Hide loading animation
                if (loadingAnimation) {
                    loadingAnimation.style.display = 'none';
                }
            }, 300);
        });
    });
    
    // Initialize the default filter (typically "all")
    const defaultFilter = document.querySelector('.filter-button.active');
    if (defaultFilter) {
        defaultFilter.click();
    }
}

/**
 * Initialize the category tabs on the project search page
 */
function initCategoryTabs() {
    const categoryTabs = document.querySelectorAll('.category-tab');
    const projectCards = document.querySelectorAll('.project-card');
    const loadingAnimation = document.querySelector('.loading-animation');
    const searchContainer = document.querySelector('.search-container');
    
    if (!categoryTabs.length) return;
    
    // Count projects by category for debugging
    const categoryCounts = {};
    projectCards.forEach(card => {
        const cat = card.getAttribute('data-category');
        categoryCounts[cat] = (categoryCounts[cat] || 0) + 1;
    });
    console.log('Projects by category:', categoryCounts);
    
    // Make sure all projects are visible by default
    projectCards.forEach(card => {
        card.style.display = 'flex';
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
    });
    
    categoryTabs.forEach(tab => {
        const category = tab.getAttribute('data-category');
        console.log(`Initializing category tab for: ${category}`);
        
        tab.addEventListener('click', function(e) {
            // Prevent default button action to ensure consistent behavior
            e.preventDefault();
            
            // Debug which category was clicked
            const clickedCategory = this.getAttribute('data-category');
            console.log(`Tab clicked: ${clickedCategory}`);
            
            // Update active tab
            categoryTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Show loading animation
            if (loadingAnimation) {
                loadingAnimation.style.display = 'block';
            }
            
            // Hide all projects with a fade effect
            projectCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
            });
            
            // Wait for fade effect
            setTimeout(() => {
                // Count filtered cards for debugging
                let visibleCount = 0;
                
                // Special debug for "art" category
                if (clickedCategory === 'art') {
                    console.log('ART CATEGORY SELECTED - checking cards:');
                }
                
                projectCards.forEach(card => {
                    // First hide all cards
                    card.style.display = 'none';
                    
                    // Get this card's category
                    const cardCategory = card.getAttribute('data-category') || '';
                    
                    // Special debug for art category
                    if (clickedCategory === 'art') {
                        const title = card.querySelector('.card-title')?.textContent.trim() || 'Unknown';
                        console.log(`Card: "${title}" has category "${cardCategory}"`);
                    }
                    
                    // Show based on filter (making sure both values are strings & trimmed)
                    const normalizedClickedCategory = String(clickedCategory).trim().toLowerCase();
                    const normalizedCardCategory = String(cardCategory).trim().toLowerCase();
                    
                    // Add special console.log for art category debugging
                    if (normalizedClickedCategory === 'art' && normalizedCardCategory === 'art') {
                        const title = card.querySelector('.card-title')?.textContent.trim() || 'Unknown';
                        console.log(`✓ MATCH FOUND: "${title}" should be shown!`);
                    }
                    
                    // Show card if it matches the selected category or if "all" is selected
                    if (normalizedClickedCategory === 'all' || normalizedClickedCategory === normalizedCardCategory) {
                        card.style.display = 'flex';
                        visibleCount++;
                        
                        // Log when an art project is shown
                        if (normalizedClickedCategory === 'art') {
                            const title = card.querySelector('.card-title')?.textContent.trim() || 'Unknown';
                            console.log(`SHOWING art project: "${title}"`);
                        }
                        
                        // Add staggered reveal animation
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 50 * Array.from(projectCards).indexOf(card));
                    }
                });
                
                console.log(`Showing ${visibleCount} cards for category ${clickedCategory}`);
                
                // Hide loading
                if (loadingAnimation) {
                    loadingAnimation.style.display = 'none';
                }
                
                // Only scroll if there are projects to show
                if (visibleCount > 0 && searchContainer) {
                    console.log(`Preparing to scroll for category: ${clickedCategory}`);
                    
                    // Use setTimeout to ensure scroll happens after the UI updates
                    setTimeout(() => {
                        // Get the position of the search container relative to the document
                        const searchContainerRect = searchContainer.getBoundingClientRect();
                        // Increase offset to scroll higher
                        const scrollPosition = window.pageYOffset + searchContainerRect.top - 100; 
                        
                        console.log(`Scrolling to position ${scrollPosition}px for category ${clickedCategory}`);
                        
                        // Scroll smoothly to position the search container at the top
                        window.scrollTo({
                            top: scrollPosition,
                            behavior: 'smooth'
                        });
                    }, 400); // Give time for the cards to display
                } else {
                    console.error(`No projects found or search container missing for category: ${clickedCategory}`);
                }
            }, 300);
        });
    });
}

/**
 * Initialize masonry layout if the library is available
 */
function initMasonryLayout() {
    // Check if Masonry library is available
    if (typeof Masonry !== 'undefined') {
        const grid = document.querySelector('.projects-grid');
        
        if (grid) {
            // Initialize Masonry
            const masonry = new Masonry(grid, {
                itemSelector: '.project-card',
                columnWidth: '.project-card',
                percentPosition: true,
                transitionDuration: '0.6s'
            });
            
            // Update layout when images are loaded
            if (typeof imagesLoaded !== 'undefined') {
                imagesLoaded(grid).on('progress', () => {
                    masonry.layout();
                });
            }
        }
    }
} 