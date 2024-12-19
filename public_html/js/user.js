//****LATEST NEWS JS*****
document.addEventListener("DOMContentLoaded", function () {
  const reviews = document.querySelector(".news-container");
  const reviewCards = reviews.innerHTML;
  reviews.innerHTML += reviewCards;
  let position = 0;
  let isPaused = false;
  function moveMarquee() {
    if (!isPaused) {
      position -= 0.4;
    }

    if (Math.abs(position) >= reviews.scrollHeight / 2) {
      position = 0;
    }

    reviews.style.transform = `translateY(${position}px)`;

    requestAnimationFrame(moveMarquee);
  }

  reviews.addEventListener("mouseover", () => {
    isPaused = true;
  });

  reviews.addEventListener("mouseout", () => {
    isPaused = false;
  });

  moveMarquee();
});

//********Edit button js*******

// function editInfo(icon) {
//   const infoContent = icon.previousElementSibling;

//   if (infoContent.isContentEditable) {
//     infoContent.contentEditable = false;
//     icon.textContent = "edit";
//   } else {
//     infoContent.contentEditable = true;
//     infoContent.focus();
//     icon.textContent = "check";
//   }
// }

function editInfo(icon) {
  const inputField = icon.previousElementSibling; // Get the input field before the span element

  if (inputField.disabled) {
    inputField.disabled = false;
    inputField.focus();
    icon.textContent = "check";

  } else {

    inputField.disabled = true;
    inputField.focus();
    icon.textContent = "edit";
  // Trigger form submission when "check" is clicked
  inputField.form.submit();  // Submit the form
  }

}
