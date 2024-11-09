// Image Slider
const slides = document.querySelectorAll(".slides .slide");
let slideIndex = 0;

document.addEventListener("DOMContentLoaded", initializeSlider);

function initializeSlider() {
    if (slides.length > 0) {
        slides[slideIndex].classList.add("displaySlide");
    } else {
        console.error("No slides found.");
    }
}

function showSlide(index) {
    slideIndex = (index + slides.length) % slides.length;

    slides.forEach(slide => slide.classList.remove("displaySlide"));
    slides[slideIndex].classList.add("displaySlide");
}

function prevSlide() {
    slideIndex = (slideIndex - 1 + slides.length) % slides.length;
    showSlide(slideIndex);
}

function nextSlide() {
    slideIndex = (slideIndex + 1) % slides.length;
    showSlide(slideIndex);
}
