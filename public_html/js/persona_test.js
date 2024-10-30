const totalSlides = document.querySelectorAll(".swiper-slide").length;
const progressBar = document.querySelector(".progress-bar");
const nextButton = document.querySelector(".swiper-button-next");

const swiper = new Swiper(".swiper", {
    effect: "slide",
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    allowTouchMove: false, // Disable swiping, use buttons only
    on: {
        slideChange: updateProgressBar,
    },
});

// Update the progress bar
function updateProgressBar() {
    const currentSlideIndex = swiper.realIndex + 1; // 1-based index
    const progress = (currentSlideIndex / totalSlides) * 100;
    progressBar.style.width = `${progress}%`;
    validateAnswer(); // Check if the next button should be enabled or disabled
}

// Option selection logic
document.querySelectorAll(".options-container-five .option").forEach((option) => {
    option.addEventListener("click", function () {
        // Find the closest options container for the current question
        const parentContainer = option.closest(".options-container-five");
        // Deselect all options within this container
        parentContainer.querySelectorAll(".option").forEach((opt) => opt.classList.remove("selected"));
        // Select the clicked option
        this.classList.add("selected");
        
        validateAnswer(); // Enable the "Next" button after an option is selected
    });
});

// Check if an option is selected for the current question
function validateAnswer() {
    const currentSlide = swiper.slides[swiper.activeIndex];
    const isAnswered = currentSlide.querySelector(".option.selected") !== null;
    
    // Enable or disable the "Next" button based on the answer status
    nextButton.disabled = !isAnswered;
    nextButton.classList.toggle("disabled", !isAnswered);
}

// Initialize the progress bar on load and validate the first slide
updateProgressBar();
validateAnswer();

// Check the number of options and adjust the styling if necessary
const optionsContainer = document.querySelector(".options-container-five");
if (optionsContainer) {
    const optionCount = optionsContainer.querySelectorAll(".option").length;
    if (optionCount > 4) {
        optionsContainer.classList.add("three-rows");
    }
}
