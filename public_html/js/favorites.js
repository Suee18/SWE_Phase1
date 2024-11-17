function removeCard(button) {
    const carCard = button.closest('.car-card');
    carCard.classList.add('fade-out');
    setTimeout(() => carCard.remove(), 200);
}
