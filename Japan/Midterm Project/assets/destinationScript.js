/*
.addEventListener("DOMContentLoaded", function() {
    var listItems = document.querySelectorAll('li');
    listItems.forEach(function(item) {
        item.addEventListener('mouseenter', function() {
            this.querySelector('.popup').style.display = 'block';
        });
        item.addEventListener('mouseleave', function() {
            this.querySelector('.popup').style.display = 'none';
        });
    });
});
*/

document.addEventListener("DOMContentLoaded", function() {
    const destinationList = document.querySelector('main ul'); // Assuming all destinations are within this <ul> under <main>

    // Handle mouse enter and leave events using event delegation
    destinationList.addEventListener('mouseover', function(e) {
        if (e.target.closest('.destinations')) {
            e.target.closest('.destinations').querySelector('.popup').style.display = 'block';
        }
    });

    destinationList.addEventListener('mouseout', function(e) {
        if (e.target.closest('.destinations')) {
            e.target.closest('.destinations').querySelector('.popup').style.display = 'none';
        }
    });

    // Handle focus and blur for keyboard accessibility
    destinationList.addEventListener('focusin', function(e) {
        if (e.target.closest('.destinations')) {
            e.target.closest('.destinations').querySelector('.popup').style.display = 'block';
        }
    });

    destinationList.addEventListener('focusout', function(e) {
        if (e.target.closest('.destinations')) {
            e.target.closest('.destinations').querySelector('.popup').style.display = 'none';
        }
    });

    // Handle clicking outside of destination items to close popups
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.destinations')) {
            document.querySelectorAll('.popup').forEach(function(popup) {
                popup.style.display = 'none';
            });
        }
    });

    // Optionally, handle toggling on click for touch devices
    destinationList.addEventListener('click', function(e) {
        const wasOpen = e.target.closest('.destinations') && e.target.closest('.destinations').querySelector('.popup').style.display === 'block';
        // Close all open popups
        document.querySelectorAll('.popup').forEach(function(popup) {
            popup.style.display = 'none';
        });
        // Toggle the clicked one
        if (e.target.closest('.destinations') && !wasOpen) {
            e.target.closest('.destinations').querySelector('.popup').style.display = 'block';
        }
    });
});
