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

function editInfo(icon) {
  // Select the input field preceding the icon
  const inputField = icon.previousElementSibling;

  if (inputField.hasAttribute("readonly")) {
    // Make the input editable
    inputField.removeAttribute("readonly");
    inputField.focus(); // Focus on the input field
    icon.textContent = "check"; // Change the icon to indicate saving
  } else {
    // Lock the input again
    inputField.setAttribute("readonly", true);
    icon.textContent = "edit"; // Revert the icon back to edit
    inputField.form.submit();
  }
}



// function editInfo(icon) {
//   const inputField = icon.previousElementSibling; // Get the input field before the span element

//   if (inputField.hasAttribute('readonly')) {
//     inputField.removeAttribute('readonly'); // Enable editing
//     inputField.focus(); // Focus on the field
//     icon.textContent = "check";
//   } else {
//     inputField.setAttribute('readonly', true); // Disable editing
//     icon.textContent = "edit";
//     inputField.form.submit(); // Trigger form submission
//   }
// }

// function editInfo(editIcon) {
//   const inputField = editIcon.previousElementSibling;
//   if (inputField.hasAttribute('disabled')||inputField.hasAttribute('readonly')) {
//       inputField.removeAttribute('disabled');
//       inputField.removeAttribute('readonly');
//       icon.textContent = "check";
//       inputField.focus();
//   } else {
//       inputField.setAttribute('disabled', true);
//       inputField.setAttribute('readonly', true);
//       icon.textContent = "edit";
//   }
// }

