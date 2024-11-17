let currentPostId = null;

document.getElementById("addPostBtn").onclick = function () {
  document.getElementById("postModal").style.display = "block";
  document.getElementById("postContent").value = "";
  document.getElementById("postTags").value = "";
  document.getElementById("postFile").value = "";
  currentPostId = null;
};

document.getElementById("closeModal").onclick = function () {
  document.getElementById("postModal").style.display = "none";
};

function addComment(postId) {
  const postElement = document.getElementById(`post-${postId}`);
  const commentInput = postElement.querySelector(".commentInput");
  const commentText = commentInput.value;

  if (commentText) {
    const comment = document.createElement("div");
    comment.className = "comment";

    const userComment = document.createElement("span");
    userComment.className = "user-comment";
    userComment.innerText = `User: ${commentText} `;
    comment.appendChild(userComment);
    postElement.querySelector(".commentList").appendChild(comment);
    const hr = document.createElement("hr");
    postElement.querySelector(".commentList").appendChild(hr);
    commentInput.value = "";
  }
}

function toggleLike(element, postId) {
  element.classList.toggle("liked");
  let likesCountElement = element.nextElementSibling;
  let currentLikes = parseInt(likesCountElement.textContent);
  if (element.classList.contains("liked")) {
    likesCountElement.textContent = `${currentLikes + 1} Likes`;
  } else {
    likesCountElement.textContent = `${currentLikes - 1} Likes`;
  }
}

function toggleDropdown(event) {
  const dropdown = event.currentTarget.nextElementSibling;
  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
  event.stopPropagation();
}

document.addEventListener("click", function (event) {
  const isDropdown = event.target.matches(".dots");
  if (!isDropdown) {
    document.querySelectorAll(".dropdown").forEach((drop) => {
      drop.style.display = "none";
    });
  }
});

function editPost(id) {
  const postElement = document.getElementById(`post-${id}`);
  const content = postElement.querySelector("p").innerText;
  const tags = Array.from(postElement.querySelectorAll(".tag"))
    .map((tag) => tag.innerText)
    .join(", ");
  document.getElementById("postContent").value = content;
  document.getElementById("postTags").value = tags;
  document.getElementById("postModal").style.display = "block";
  currentPostId = id;
  toggleDropdown(event);
}

function deletePost(id) {
  const postElement = document.getElementById(`post-${id}`);
  if (postElement) {
    postElement.remove();
  }
  toggleDropdown(event);
}
document.getElementById("postContent").addEventListener("input", function () {
  const contentLength = this.value.length;
  document.getElementById("charCount").textContent = `${contentLength} / 300`;

  const charWarning = document.getElementById("charWarning");

  if (contentLength > 300) {
    charWarning.style.display = "block";
    document.getElementById("charCount").style.color = "red";
  } else {
    charWarning.style.display = "none";
    document.getElementById("charCount").style.color = "inherit";
  }
});

document.getElementById("savePostBtn").onclick = function () {
  const content = document.getElementById("postContent").value;
  if (content.length > 300) {
    return;
  } else {
    const content = document.getElementById("postContent").value;
    const fileInput = document.getElementById("postFile");
    const file = fileInput.files[0];
    const tagsInput = document
      .getElementById("postTags")
      .value.split(",")
      .map((tag) => tag.trim())
      .filter((tag) => tag);

    if (currentPostId) {
      const postElement = document.getElementById(`post-${currentPostId}`);
      postElement.querySelector("p").innerText = content;
      postElement.querySelector(".tags").innerHTML = tagsInput
        .map((tag) => `<span class="tag">${tag}</span>`)
        .join(" ");

      if (file) {
        const mediaElement = postElement.querySelector("img, video");
        if (mediaElement) {
          mediaElement.src = URL.createObjectURL(file);
        } else {
          postElement.querySelector(
            ".post-content"
          ).innerHTML += `<img src="${URL.createObjectURL(
            file
          )}" alt="Post Image" />`;
        }
      }
    } else {
      const newPost = document.createElement("div");
      newPost.className = "post";
      const postId = Date.now();
      newPost.id = `post-${postId}`;
      newPost.innerHTML = `
      <div class="post-card">
        <div class="post-header">
          <div style="display: flex; align-items: center;">
            <div class="post-userphoto"></div>
            <span class="post-username">Username</span>
          </div>
          <div class="dots" onclick="toggleDropdown(event)">
            &#x22EE;
          </div>
          <ul class="dropdown">
            <span class="dropdown-item" onclick="editPost(${postId})">Edit Post</span>
            <span class="dropdown-item" onclick="deletePost(${postId})">Delete Post</span>
          </ul>
        </div>
        <div class="post-content">
          <div class="post-text">
            <p>${content}</p>
          </div>
                  <div class="post-tags">
            ${
              tagsInput.length
                ? `<div class="tags">${tagsInput
                    .map((tag) => `<span class="tag">${tag}</span>`)
                    .join(" ")}</div>`
                : ""
            }
          </div>
          <div class="post-image">
            ${
              file
                ? `<img src="${URL.createObjectURL(file)}" alt="Post Image" />`
                : ""
            }
          </div>
  
        </div>
        <div class="post-footer">
          <span class="heart" onclick="toggleLike(this, ${postId})">&#9829;</span>
          <span class="likes-count">0 Likes</span>
        </div>
        <div class="comments">
          <textarea class="commentInput" placeholder="Add a comment..."></textarea>
          <button type="button" onclick="addComment(${postId})">&uarr;</button>
            </div>
             <h3>Comments section:</h3>
          <div class="commentList"></div>
        </div>
      </div>
    `;

      document.getElementById("postsContainer").appendChild(newPost);
    }
    document.getElementById("postModal").style.display = "none";
    currentPostId = null;
  }
};
