let currentSlide = 1;
const slide1Duration = 97000;
const otherSlidesDuration = 8000; // 5 seconds for the other slides
let slideTimer; // Variable to store the setInterval for autoSlide

document.addEventListener("DOMContentLoaded", function () {
    showSlide(currentSlide); // Show the first slide when the page loads
    startAutoSlide(); // Start automatic slide switching with the appropriate duration

    const openSearchModalBtn = document.getElementById("search-icon"); // This should be your search icon trigger
    const closeSearchModalBtn = document.getElementById("closeSearchModalBtn");
    const searchModal = document.getElementById("searchModal");
    const searchModalContent = document.querySelector(".search-modal-content");
    const searchInput = document.getElementById("searchInput");
    const searchResultsList = document.getElementById("searchResults");

    // Open Modal
    openSearchModalBtn.addEventListener("click", () => {
        searchModal.style.display = "flex";
        setTimeout(() => {
            searchModal.classList.add("show");
            searchModalContent.classList.add("show");
        }, 10); // Small timeout for the transition to work
    });

    // Close Modal
    closeSearchModalBtn.addEventListener("click", () => {
        closeSearch();
    });

    // Close Modal When Clicking Outside Content
    window.addEventListener("click", (event) => {
        if (event.target === searchModal) {
            closeSearch();
        }
    });

    // Handle typing event in search input
    searchInput.addEventListener("input", function () {
        const query = searchInput.value.trim();
        if (query.length > 0) {
            // Make an AJAX request to the backend to search makes and models
            $.ajax({
                url: "../controllers/SearchController.php", // Your controller URL
                type: "POST",
                data: {
                    action: "searchDropList", // Action type to search makes and models
                    searchTerm: query, // Send the search term
                },
                success: function (response) {
                    try {
                        console.log('Raw response: ', response);
                        const cars = JSON.parse(response); // Parse the JSON response
                        displayResults(cars); // Display the results
                    } catch (e) {
                        console.error("Error parsing the response:", e.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(
                        "AJAX error:",
                        status,
                        error,
                        xhr.responseText
                    );
                },
            });
        } else {
            searchResultsList.style.display = "none"; // Hide results when input is empty
        }
    });

    // Close Modal with ESC key
    window.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            closeSearch();
        }
    });

    function closeSearch() {
        searchModal.classList.remove("show");
        searchModalContent.classList.remove("show");
        setTimeout(() => {
            searchModal.style.display = "none";
        }, 300); // Wait for the transition to finish before hiding
    }

    function displayResults(cars) {
        searchResultsList.innerHTML = "";
        if (cars.length > 0) {
            searchResultsList.style.display = "block"; // Show the results
            cars.forEach((car) => {
                const div = document.createElement("div");
                div.classList.add("result-item");
                div.textContent = `${car.make} ${car.model} ${car.year}`;
                div.setAttribute("data-make", car.make);
                div.setAttribute("data-model", car.model);
                div.setAttribute("data-year", car.year);

                // Add click event to each result item
                div.addEventListener("click", function () {
                    window.location.href = `../app/views/user/search_results.php?make=${car.make}&model=${car.model}&year=${car.year}`;
                });

                searchResultsList.appendChild(div);
            });
            searchResultsList.classList.add("show"); // Fade in the results
        } else {
            searchResultsList.style.display = "none"; // No results
        }
    }
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

// *******REVIEWS' JS*******

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
textarea.style.display = "none";
submitBtn.style.display = "none";

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
                textarea.placeholder =
                    "What do you think about the Apex Community?";
                break;
            default:
                textarea.placeholder = "Write your review here...";
        }
        const allButtons = document.querySelectorAll(".button");
        allButtons.forEach((btn) => btn.classList.remove("selected"));
        button.classList.add("selected");
        textarea.style.display = "block";
        submitBtn.style.display = "block";

        setTimeout(() => {
            textarea.classList.add("active");
            submitBtn.classList.add("active");
        }, 0);
    }
});
