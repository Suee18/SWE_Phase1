let currentSlide = 1;
const slide1Duration = 97000;
const otherSlidesDuration = 8000; // 5 seconds for the other slides
let slideTimer; // Variable to store the setInterval for autoSlide

document.addEventListener("DOMContentLoaded", function () {
  showSlide(currentSlide); // Show the first slide when the page loads
  startAutoSlide(); // Start automatic slide switching with the appropriate duration
});

// Function to show the current slide
function showSlide(n) {
  let slides = document.querySelectorAll(".slide");
  let dots = document.querySelectorAll(".dot");

  if (n > slides.length) {
    currentSlide = 1;
  }
  if (n < 1) {
    currentSlide = slides.length;
  }

  // Hide all slides
  slides.forEach((slide) => {
    slide.style.display = "none";
  });

  // Remove "active" class from all dots
  dots.forEach((dot) => {
    dot.classList.remove("active");
  });

  // Show the selected slide and activate the corresponding dot
  slides[currentSlide - 1].style.display = "block";
  if (dots.length > 0) {
    dots[currentSlide - 1].classList.add("active");
  }
}

// Function to switch to the next slide
function nextSlide() {
  currentSlide++;
  showSlide(currentSlide);
  stopAutoSlide(); // Stop the current auto-slide timer
  startAutoSlide(); // Start a new timer with appropriate duration
}

// Function to start auto slide with custom duration based on the current slide
function startAutoSlide() {
  const currentDuration =
    currentSlide === 1 ? slide1Duration : otherSlidesDuration; // Use 25s for slide 1, 5s for others
  slideTimer = setInterval(function () {
    nextSlide();
  }, currentDuration);
}

// Function to stop auto slide
function stopAutoSlide() {
  clearInterval(slideTimer); // Clear the existing interval
}

// Optional: Manual navigation via dots
function showSlideOnClick(n) {
  currentSlide = n;
  showSlide(currentSlide);
  stopAutoSlide(); // Stop the current auto-slide timer
  startAutoSlide(); // Restart the auto-slide timer after manual navigation
}

// *******REVEIWS' JS*******

const swiper = new Swiper(".swiper-container", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  coverflowEffect: {
    rotate: 0,
    stretch: 10,
    depth: 200,
    modifier: 1,
    slideShadows: true,
  },
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
  loop: true,
});
// function validateReview(input) {
//   const validPattern = /^[a-zA-Z0-9\s!?.,]+$/; // Allow letters, numbers, spaces, and basic punctuation (!, ?, ., ,)
//   if (input.trim() === "") {
//     return "Please enter your review before submitting.";
//   } else if (!validPattern.test(input)) {
//     return "Please enter a valid input.";
//   }
//   return null;
// }
const openOverlayBtn = document.getElementById("openOverlay");
const overlay = document.getElementById("reviewOverlay");
const closeOverlayBtn = document.getElementById("closeOverlay");
const submitReviewBtn = document.getElementById("submitReview");
const reviewText = document.getElementById("reviewText");
const errorMessage = document.createElement("p");

openOverlayBtn.addEventListener("click", () => {
  overlay.style.display = "flex";
  errorMessage.textContent = "";
});

closeOverlayBtn.addEventListener("click", () => {
  overlay.style.display = "none";
  errorMessage.textContent = "";
});

window.addEventListener("click", (e) => {
  if (e.target === overlay) {
    overlay.style.display = "none";
    errorMessage.textContent = "";
  }
});

const reviewButtons = document.getElementById("reviewButtons");
const textarea = document.getElementById("reviewText");
const submitBtn = document.getElementById("submitReview");
const starRatingContainer = document.getElementById("starRatingContainer");

textarea.style.display = "none";
submitBtn.style.display = "none";

let selectedRating = 0;

reviewButtons.addEventListener("click", (e) => {
  const button = e.target.closest(".button");

  if (button) {
    const choice = button.getAttribute("data-choice");
    switch (choice) {
      case "Apex":
        textarea.placeholder = "Write your review about Apex...";
        break;
      case "Comparison":
        textarea.placeholder =
          "Share your thoughts about the comparison feature...";
        break;
      case "Search":
        textarea.placeholder =
          "Describe your experience with the search feature...";
        break;
      case "Persona Test":
        textarea.placeholder =
          "Let us know your thoughts on the Persona Test...";
        break;
      case "Turbo":
        textarea.placeholder = "Review the Turbo chatbot feature...";
        break;
      case "Apex Community":
        textarea.placeholder = "What do you think about the Apex Community?";
        break;
      default:
        textarea.placeholder = "Write your review here...";
    }

    textarea.style.display = "block";
    submitBtn.style.display = "block";

    starRatingContainer.style.display = "flex";
    addStarRating();

    const allButtons = document.querySelectorAll(".button");
    allButtons.forEach((btn) => btn.classList.remove("selected"));
    button.classList.add("selected");

    setTimeout(() => {
      textarea.classList.add("active");
      submitBtn.classList.add("active");
    }, 0);
  }
});

function addStarRating() {
  starRatingContainer.innerHTML = "";
  selectedRating = 0;

  for (let i = 1; i <= 5; i++) {
    const star = document.createElement("span");
    star.classList.add("star");
    star.setAttribute("data-value", i);
    star.textContent = "★";

    star.addEventListener("click", () => {
      selectedRating = i;
      fillStars(i);
      document.getElementById("starRating").value = selectedRating;
    });

    starRatingContainer.appendChild(star);
  }
}

function fillStars(rating) {
  const stars = document.querySelectorAll(".star");
  stars.forEach((star, index) => {
    if (index < rating) {
      star.classList.add("highlighted");
    } else {
      star.classList.remove("highlighted");
    }
  });
}

document.querySelectorAll(".review-buttons .button").forEach((button) => {
  button.addEventListener("click", function () {
    document.getElementById("reviewCategory").value =
      this.getAttribute("data-choice");
  });
});
