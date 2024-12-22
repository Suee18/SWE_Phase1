document.addEventListener("DOMContentLoaded", function () {
  const addPostBtn = document.getElementById("addPostBtn");
  const postModal = document.getElementById("postModal");
  const closeModal = document.getElementById("closeModal");
  const postForm = document.getElementById("postForm");
  const postContent = document.getElementById("postContent");
  const charCount = document.getElementById("charCount");
  const savePostBtn = document.getElementById("savePostBtn");
  const fileLabel = document.getElementById("fileLabel");
  const postFile = document.getElementById("postFile");

  addPostBtn.addEventListener("click", function () {
    postModal.style.display = "block";
  });

  closeModal.addEventListener("click", function () {
    postModal.style.display = "none";
  });

  postContent.addEventListener("input", function () {
    const textLength = postContent.value.length;
    charCount.textContent = `${textLength} / 300`;
    if (textLength > 300) {
      charCount.style.color = "red";
      savePostBtn.disabled = true;
      document.getElementById("charWarning").style.display = "block";
    } else {
      charCount.style.color = "white";
      savePostBtn.disabled = false;
      document.getElementById("charWarning").style.display = "none";
    }
  });

  postFile.addEventListener("change", function () {
    const fileName = postFile.files[0] ? postFile.files[0].name : "";
    fileLabel.textContent = fileName ? fileName : "Choose File";
  });

  const dotsBtns = document.querySelectorAll(".dots");
  dotsBtns.forEach(function (btn) {
    btn.addEventListener("click", function (event) {
      const dropdown = event.target.nextElementSibling;
      const allDropdowns = document.querySelectorAll(".dropdown");

      allDropdowns.forEach(function (menu) {
        if (menu !== dropdown) {
          menu.style.display = "none";
        }
      });

      dropdown.style.display =
        dropdown.style.display === "block" ? "none" : "block";
    });
  });

  const editBtns = document.querySelectorAll(".editBtn");

  editBtns.forEach(function (btn) {
    btn.addEventListener("click", function () {
      const postID = btn.getAttribute("data-id");
      let postText = btn.getAttribute("data-text") || "";
      const postImage = btn.getAttribute("data-image") || "";

      const textArea = document.createElement("textarea");
      textArea.innerHTML = postText;
      postText = textArea.value;

      document.getElementById("postContent").value = postText;
      document.getElementById("postID").value = postID;
      document.getElementById("formAction").value = "editPost";
      if (postImage) {
        document.getElementById("fileLabel").textContent = postImage;
      }

      postModal.style.display = "block";
    });
  });

  document.querySelectorAll(".heart").forEach((heart) => {
    heart.addEventListener("click", function () {
      const postID = this.getAttribute("data-id");

      $.ajax({
        type: "POST",
        url: "../../views/user/platform.php",
        data: {
          action: "toggleLike",
          postID: postID,
        },
        success: function (response) {
          console.log("Response: ", response);
          const data = JSON.parse(response);

          if (data.error) {
            alert(data.error);
          } else {
            const likesCountElem = heart.nextElementSibling;
            heart.classList.toggle("liked", data.liked);
            likesCountElem.textContent = `${data.likesCount} Likes`;
          }
        },
        error: function () {
          alert("Failed to toggle like. Please try again.");
        },
      });
    });
  });
});

document.getElementById("addPostBtn").addEventListener("click", function () {
  const postForm = document.getElementById("postForm");
  const modalTitle = document.querySelector("#postModal h2");
  const savePostBtn = document.getElementById("savePostBtn");
  postForm.reset();
  modalTitle.textContent = "Create a Post";
  savePostBtn.textContent = "Save Post";
  document.getElementById("formAction").value = "addPost";
  document.getElementById("postID").value = "";
  document.getElementById("postContent").value = "";
  document.getElementById("charCount").textContent = "0 / 300";
  document.getElementById("savePostBtn").disabled = true;

  document.getElementById("postModal").style.display = "flex";
});

document.querySelectorAll(".editBtn").forEach(function (btn) {
  btn.addEventListener("click", function () {
    const modalTitle = document.querySelector("#postModal h2");
    const savePostBtn = document.getElementById("savePostBtn");
    const postID = btn.getAttribute("data-id");
    const postText = btn.getAttribute("data-text");
    const postImage = btn.getAttribute("data-image");
    modalTitle.textContent = "Edit Post";
    savePostBtn.textContent = "Update Post";
    document.getElementById("formAction").value = "editPost";
    document.getElementById("postID").value = postID;
    document.getElementById("postContent").value = postText || "";
    document.getElementById(
      "charCount"
    ).textContent = `${postText.length} / 300`;
    document.getElementById("savePostBtn").disabled = false;

    const fileLabel = document.getElementById("fileLabel");
    fileLabel.textContent = postImage
      ? `Selected: ${postImage}`
      : "Choose File";

    document.getElementById("postModal").style.display = "flex";
  });
});

document.getElementById("closeModal").addEventListener("click", function () {
  const postForm = document.getElementById("postForm");
  postForm.reset();

  document.getElementById("postModal").style.display = "none";
});
document.getElementById("postContent").addEventListener("input", function () {
  const charCount = document.getElementById("charCount");
  const savePostBtn = document.getElementById("savePostBtn");
  const textLength = this.value.length;

  charCount.textContent = `${textLength} / 300`;

  if (textLength > 0 && textLength <= 300) {
    savePostBtn.disabled = false;
  } else {
    savePostBtn.disabled = true;
  }
});

let currentPostID = null;

const showDeleteModal = function (postID) {
  currentPostID = postID;
  const modal = document.getElementById("confirmModal");
  modal.style.display = "flex";
};

const hideDeleteModal = function () {
  const modal = document.getElementById("confirmModal");
  modal.style.display = "none";
};

const deletePost = function () {
  if (!currentPostID) return;

  const formData = new FormData();
  formData.append("action", "deletePost");
  formData.append("postID", currentPostID);

  fetch("platform.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((response) => {
      console.log("Response from server: " + response);

      if (response.trim() === "Post and associated data deleted successfully") {
        const postElement = document.getElementById("post-" + currentPostID);
        if (postElement) {
          postElement.remove();
        }
      } else {
        console.error("There was an issue deleting the post: " + response);
      }

      hideDeleteModal();
    })
    .catch((error) => {
      console.error("Error:", error);
      hideDeleteModal();
    });
};

document
  .getElementById("confirmDeleteBtn")
  .addEventListener("click", deletePost);
document
  .getElementById("cancelDeleteBtn")
  .addEventListener("click", hideDeleteModal);

const deleteBtns = document.querySelectorAll(".dropdown-item");
deleteBtns.forEach(function (btn) {
  if (btn.textContent.trim() === "Delete Post") {
    btn.addEventListener("click", function () {
      const postID = btn.getAttribute("data-id");
      showDeleteModal(postID);
    });
  }
});

function addComment(postID) {
  console.log("Entering add comment function");
  var commentText = $("#post-" + postID + " .commentInput")
    .val()
    .trim();
  if (commentText == "") {
    alert("Please enter a comment!");
    return;
  }

  // Send the comment to the server via AJAX
  $.ajax({
    type: "POST",
    url: "../../views/user/platform.php",
    data: {
      action: "addComment",
      postID: postID,
      commentText: commentText,
      userID: `<?php echo $_SESSION['userID']; ?>`, // Assuming userID is stored in session
    },
    success: function (response) {
      console.log(response);
      var data = JSON.parse(response);

      if (data.error) {
        alert(data.error); // Handle the error (e.g., duplicate comment)
      } else {
        // Check if the post has any comments
        var commentList = $("#post-" + postID + " .commentList");

        // If there are no comments (message p is present), remove it
        if (commentList.length === 0 || commentList.find("p").length > 0) {
          $("#post-" + postID + " .commentList p").remove(); // Remove the "No comments yet" message
        }

        // Add the new comment to the comment list
        commentList.append(
          '<div class="comment">@' +
            data.username +
            ": " +
            data.commentText +
            "</div><hr>"
        );

        // Clear the input field after adding the comment
        $("#post-" + postID + " .commentInput").val("");
      }
    },
    error: function () {
      alert("Failed to add comment.");
    },
  });
}
