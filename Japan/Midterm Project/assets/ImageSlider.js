document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelector('.slides');
    const numImages = 10; // Total number of images
    let index = 0; // Start at the first image

    setInterval(function() {
        index = (index + 1) % numImages; // Move to the next image, loop back after the last image
        const xTransform = index * -100; // Calculate the x-offset for the transform
        slides.style.transform = `translate3d(${xTransform}%, 0, 0)`; // Apply the transformation
    }, 3000); // Change image every 3000 milliseconds (3 seconds)
});
