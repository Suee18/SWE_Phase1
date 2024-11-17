document.addEventListener("DOMContentLoaded", () => {
    // Get the modal element
    const modal = document.getElementById("comparison-modal");

    // Get the button that opens the modal
    const openModalButton = document.querySelector(".open-modal-button");

    // Get the <span> element that closes the modal
    const closeButton = document.querySelector(".close-button");

    // When the user clicks the button, open the modal
    openModalButton.addEventListener("click", () => {
        modal.style.display = "flex";
    });

    // When the user clicks on <span> (x), close the modal
    closeButton.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // When the user clicks anywhere outside the modal content, close the modal
    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});

function toggleModal() {
    const modal = document.getElementById("comparisonModal");
    modal.style.display = modal.style.display === "flex" ? "none" : "flex";
}
