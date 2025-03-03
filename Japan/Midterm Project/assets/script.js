console.log("Script loaded");

// Existing code for modal image gallery
var modal = document.getElementById("modal");
var imgExpanded = document.getElementById("imgExpanded");
var captionText = document.getElementById("caption");
var galleryImgs = document.querySelectorAll(".gallery-img");


galleryImgs.forEach(function(img) {
    img.onclick = function() {
        modal.style.display = "block";
        imgExpanded.src = this.src;
        captionText.innerHTML = this.alt;
    }
});

var closeModal = document.getElementById("closeModal");
closeModal.onclick = function() { 
    modal.style.display = "none";
}
