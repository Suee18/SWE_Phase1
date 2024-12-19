// let currentPostId = null;

// document.getElementById("addPostBtn").onclick = function () {
//     document.getElementById("postModal").style.display = "block";
//     document.getElementById("postContent").value = "";
//     document.getElementById("postFile").value = "";
//     currentPostId = null;
// };

// document.getElementById("closeModal").onclick = function () {
//     document.getElementById("postModal").style.display = "none";
// };
// function addComment(postId) {
//     const postElement = document.getElementById(`post-${postId}`);
//     const commentInput = postElement.querySelector(".commentInput");
//     const commentText = commentInput.value;

//     if (commentText) {
//         const comment = document.createElement("div");
//         comment.className = "comment";

//         const userComment = document.createElement("span");
//         userComment.className = "user-comment";
//         userComment.innerText = `@username : ${commentText} `;
//         comment.appendChild(userComment);
//         const commentList = postElement.querySelector(".commentList");
//         commentList.appendChild(comment);
//         const noCommentsMessage = commentList.querySelector(
//             ".no-comments-message"
//         );
//         if (noCommentsMessage) {
//             noCommentsMessage.style.display = "none";
//         }
//         const hr = document.createElement("hr");
//         commentList.appendChild(hr);
//         commentInput.value = "";
//     }
// }

// function checkComments(postId) {
//     const postElement = document.getElementById(`post-${postId}`);
//     const commentList = postElement.querySelector(".commentList");
//     const comments = commentList.querySelectorAll(".comment");

//     if (comments.length === 0) {
//         const noCommentsMessage = commentList.querySelector(
//             ".no-comments-message"
//         );
//         if (noCommentsMessage) {
//             noCommentsMessage.style.display = "block";
//         }
//     }
// }

// function toggleLike(element, postId) {
//     element.classList.toggle("liked");
//     let likesCountElement = element.nextElementSibling;
//     let currentLikes = parseInt(likesCountElement.textContent);
//     if (element.classList.contains("liked")) {
//         likesCountElement.textContent = `${currentLikes + 1} Likes`;
//     } else {
//         likesCountElement.textContent = `${currentLikes - 1} Likes`;
//     }
// }

// function toggleDropdown(event) {
//     const dropdown = event.currentTarget.nextElementSibling;
//     dropdown.style.display =
//         dropdown.style.display === "block" ? "none" : "block";
//     event.stopPropagation();
// }

// document.addEventListener("click", function (event) {
//     const isDropdown = event.target.matches(".dots");
//     if (!isDropdown) {
//         document.querySelectorAll(".dropdown").forEach((drop) => {
//             drop.style.display = "none";
//         });
//     }
// });

// document.getElementById("postFile").addEventListener("change", function () {
//     const fileInput = this;
//     const fileLabel = document.getElementById("fileLabel");

//     if (fileInput.files.length > 0) {
//         fileLabel.textContent = fileInput.files[0].name;
//         fileLabel.classList.add("file-selected");
//     } else {
//         fileLabel.textContent = "Choose File";
//         fileLabel.classList.remove("file-selected");
//     }
// });
// function editPost(id) {
//     const postElement = document.getElementById(`post-${id}`);
//     const content = postElement.querySelector("p").innerText;
//     document.getElementById("postContent").value = content;
//     document.getElementById("postModal").style.display = "block";
//     currentPostId = id;
//     toggleDropdown(event);
// }

// function deletePost(id) {
//     const postElement = document.getElementById(`post-${id}`);
//     if (postElement) {
//         postElement.remove();
//     }
//     toggleDropdown(event);
// }
// document.getElementById("postContent").addEventListener("input", function () {
//     const contentLength = this.value.length;
//     const charCount = document.getElementById("charCount");
//     const charWarning = document.getElementById("charWarning");
//     const savePostBtn = document.getElementById("savePostBtn");

//     charCount.textContent = `${contentLength} / 300`;

//     if (contentLength > 300) {
//         charCount.style.color = "red";
//         charWarning.style.display = "block";
//         savePostBtn.disabled = true; // Disable save button if exceeds 300 chars
//     } else {
//         charCount.style.color = "inherit";
//         charWarning.style.display = "none";
//         savePostBtn.disabled = contentLength === 0; // Disable if no content
//     }
// });
// document.getElementById("savePostBtn").onclick = function (event) {
//     event.preventDefault(); // Prevent the default form submission

//     const content = document.getElementById("postContent").value.trim();
//     const fileInput = document.getElementById("postFile");
//     const file = fileInput.files[0];
//     const errorMessage = document.getElementById("errorMessage");

//     if (content === "" && !file) {
//         errorMessage.textContent =
//             "Please add some content or choose a photo/video before posting.";
//         errorMessage.style.display = "block";
//         return;
//     }

//     const formData = new FormData();
//     formData.append("text", content);
//     if (file) formData.append("image", file);
//     formData.append("action", "addPost");

//     fetch("../../../controllers/PlatformController.php", {
//         method: "POST",
//         body: formData,
//     })
//         .then((response) => response.json())
//         .then((data) => {
//             if (data.success) {
//                 // Add the new post dynamically to the UI
//                 const newPost = document.createElement("div");
//                 newPost.className = "post";
//                 newPost.innerHTML = `
//           <div class="post-card">
//             <p>${content}</p>
//             ${
//                 file ? (
//                     <img src="${URL.createObjectURL(file)}" alt="Post Image" />
//                 ) : (
//                     ""
//                 )
//             }
//           </div>`;
//                 document.getElementById("postsContainer").prepend(newPost);

//                 // Close the modal
//                 document.getElementById("postModal").style.display = "none";
//             } else {
//                 errorMessage.textContent =
//                     data.error || "Failed to save the post.";
//                 errorMessage.style.display = "block";
//             }
//         })
//         .catch((error) => {
//             console.error("Error:", error);
//             errorMessage.textContent = "An error occurred. Please try again.";
//             errorMessage.style.display = "block";
//         });
// };

// DOM Elements
const addPostBtn = document.getElementById("addPostBtn");
const postModal = document.getElementById("postModal");
const closeModalBtn = document.getElementById("closeModal");
const postForm = document.getElementById("postForm");
const postContent = document.getElementById("postContent");
const postFile = document.getElementById("postFile");
const postsContainer = document.getElementById("postsContainer");
const charCount = document.getElementById("charCount");
const charWarning = document.getElementById("charWarning");
const savePostBtn = document.getElementById("savePostBtn");
const errorMessage = document.getElementById("errorMessage");

// Open Modal
addPostBtn.onclick = () => {
    postModal.style.display = "block";
    resetModal(); // Reset modal inputs
};

// Close Modal
closeModalBtn.onclick = () => {
    postModal.style.display = "none";
};

// Character Count Logic
postContent.addEventListener("input", () => {
    const contentLength = postContent.value.length;
    charCount.textContent = `${contentLength} / 300`;

    if (contentLength > 300) {
        charCount.style.color = "red";
        charWarning.style.display = "block";
        savePostBtn.disabled = true; // Disable button if content exceeds limit
    } else {
        charCount.style.color = "inherit";
        charWarning.style.display = "none";
        savePostBtn.disabled = contentLength === 0; // Disable if no content
    }
});

// File Input Label Update
postFile.addEventListener("change", () => {
    const fileLabel = document.getElementById("fileLabel");
    if (postFile.files.length > 0) {
        fileLabel.textContent = postFile.files[0].name;
        fileLabel.classList.add("file-selected");
    } else {
        fileLabel.textContent = "Choose File";
        fileLabel.classList.remove("file-selected");
    }
});

// Handle Form Submission
postForm.onsubmit = (event) => {
    event.preventDefault(); // Prevent actual form submission

    const content = postContent.value.trim();
    const file = postFile.files[0];

    // Validate input (at least content or file required)
    if (!content && !file) {
        errorMessage.textContent =
            "Please add some content or choose a file before posting.";
        errorMessage.style.display = "block";
        return;
    }

    // Simulate saving the post (add to the UI temporarily)
    const newPost = document.createElement("div");
    newPost.className = "post";
    newPost.innerHTML = `
    <div class="post-card">
        <p>${content}</p>
        ${
            file
                ? `<img src="${URL.createObjectURL(file)}" alt="Post Image" />`
                : ""
        }
    </div>`;

    postsContainer.prepend(newPost); // Add new post to top of container

    // Reset Modal and Close
    resetModal();
    postModal.style.display = "none";
};

// Reset Modal Inputs
function resetModal() {
    postContent.value = "";
    postFile.value = "";
    charCount.textContent = "0 / 300";
    charWarning.style.display = "none";
    savePostBtn.disabled = true;
    errorMessage.style.display = "none";
    document.getElementById("fileLabel").textContent = "Choose File";
    document.getElementById("fileLabel").classList.remove("file-selected");
}
