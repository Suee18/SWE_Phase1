document.addEventListener("DOMContentLoaded", function () {
    const pageContainer = document.querySelector(".fav_cars");

    if (pageContainer) {
        document.querySelectorAll(".con-like .like").forEach((likeButton) => {
            likeButton.addEventListener("click", function () {
                const carCard = this.closest(".car-card");

                if (carCard) {
                    carCard.style.transition =
                        "opacity 0.3s ease, transform 0.3s ease";
                    carCard.style.opacity = "0";
                    carCard.style.transform = "translateY(-10px)";
                    setTimeout(() => {
                        carCard.remove();
                    }, 300);
                }
            });
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const notificationContainer = document.getElementById(
        "notification-container"
    );
    function showNotification(message) {
        const notification = document.createElement("div");
        notification.classList.add("notification");
        notification.textContent = message;
        notificationContainer.appendChild(notification);
        setTimeout(() => {
            notification.remove();
        }, 2000);
    }
    document
        .querySelectorAll(".landingPage_part2 .con-like .like")
        .forEach((likeButton) => {
            likeButton.addEventListener("change", function () {
                if (this.checked) {
                    showNotification("Added to favorites");
                }
            });
        });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".con-like .like").forEach((likeButton) => {
        likeButton.addEventListener("click", function () {
            const carCard = this.closest(".car-card");
            const carId = String(carCard.dataset.carId); // Ensure the card has a `data-car-id` attribute
            const userId = String(carCard.dataset.userId); // Ensure the card has a `data-user-id` attribute

            console.log("Car ID:", carId);
            console.log("User ID:", userId);

            if (carId && userId) {
                const xhr = new XMLHttpRequest();
                xhr.open(
                    "POST",
                    "../../../controllers/favoritesController.php",
                    true
                );

                // Set the Content-Type header to URL encoded
                xhr.setRequestHeader(
                    "Content-Type",
                    "application/x-www-form-urlencoded"
                );

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText); // Parse the JSON response from the server

                        if (response.success) {
                            // Apply the transition effects
                            carCard.style.transition =
                                "opacity 0.3s ease, transform 0.3s ease";
                            carCard.style.opacity = "0";
                            carCard.style.transform = "translateY(-10px)";
                            setTimeout(() => {
                                carCard.remove(); // Remove the card after transition
                            }, 300);
                        } else {
                            console.error(
                                "Error Message from API:",
                                response.message
                            );
                        }
                    }
                };

                // Send the POST request with the carId, userId, and action (remove)
                xhr.send(
                    "carId=" + carId + "&userId=" + userId + "&action=remove"
                );
            }
        });
    });
});
