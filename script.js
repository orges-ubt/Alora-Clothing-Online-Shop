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

// Register Form Validation 
function validateRegisterForm() {
    const name = document.getElementById("registerName").value;
    const surname = document.getElementById("registerSurname").value;
    const phoneNumber = document.getElementById("registerPhoneNumber").value;
    const email = document.getElementById("registerEmail").value;
    const password = document.getElementById("registerPassword").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const errorMessage = document.getElementById("errorMessage");

    errorMessage.textContent = "";

if (!name ||  !surname || !phoneNumber ||  !email ||  !password || !confirmPassword) {
        alert("Please fill in all fields.");
        return false;
}

    const passwordPattern = /^(?=.[0-9])(?=.[A-Z])[A-Za-z\d]{8,}$/;

if (!passwordPattern.test(password)) {
        errorMessage.textContent="Password must be at least 8 characters, start with an uppercase letter, and contain at least one number.";
        return false;
}
if (password !== confirmPassword) {
        errorMessage.textContent="Passwords do not match.";
        return false;
}
    return true;
}
