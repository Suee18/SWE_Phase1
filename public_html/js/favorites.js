document.addEventListener("DOMContentLoaded", function () {
    const pageContainer = document.querySelector(".fav_cars");

    if (pageContainer) {
        document.querySelectorAll(".con-like .like").forEach(likeButton => {
            likeButton.addEventListener("click", function () {
                const carCard = this.closest(".car-card");

                if (carCard) {
                    carCard.style.transition = "opacity 0.3s ease, transform 0.3s ease";
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

