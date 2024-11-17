<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public_html/css/platform.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../../../public_html/js/platform.js" defer></script>
    <title>Car Community</title>
</head>

<body>
    <?php include "../../../public_html/components/userNavbar.php" ?>
    <div class="container">
        <h1>Apex Community   🏎️💨 </h1>
        <button id="addPostBtn"><i class="fas fa-plus"></i></button>

        <div id="postsContainer">
            <div class="post" id="post-1">
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
                            <li class="dropdown-item" onclick="editPost(1)">Edit Post</li>
                            <li class="dropdown-item" onclick="deletePost(1)">Delete Post</li>
                        </ul>
                    </div>
                    <div class="post-content">
                        <div class="post-text">
                            <p>This is a sample post content that provides an idea of how a post will appear in the community.</p>
                        </div>
                        <div class="post-tags">
                            <div class="tags">
                                <span class="tag">sample</span>
                                <span class="tag">post</span>
                                <span class="tag">community</span>
                            </div>
                        </div>
                        <div class="post-image">
                            <img src="../../../../  SWE_Phase1/public_html/media/ccAMG.png" alt="Sample Post Image" />
                        </div>
                        <div class="post-footer">
                            <span class="heart" onclick="toggleLike(this, 1)">&#9829;</span>
                            <span class="likes-count">0 Likes</span>
                        </div>
                        <div class="comments">
                            <textarea class="commentInput" placeholder="Add a comment..."></textarea>
                            <button type="button" onclick="addComment(1)">&uarr;</button>
                        </div>
                        <h3>Comments section:</h3>
                        <div class="commentList">
                            <div class="comment">User: Great Car!</div>
                            <hr>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="postModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <form id="postForm" enctype="multipart/form-data">
                    <h2>Create a Post</h2>
                    <div id="charWarning" style="display: none; color: red; font-size: 0.9rem;">
                        Please don't exceed 300 characters.
                    </div>
                    <textarea id="postContent" placeholder="What's on your mind?" required></textarea>
                    <input type="file" id="postFile" accept="image/*,video/*" style="display: none;" />
                    <label for="postFile" class="custom-file-label">Choose File</label>
                    <input type="text" id="postTags" placeholder="Add tags (comma separated)" />
                    <button type="button" id="savePostBtn">Save Post</button>
                    <div id="charCount">0 / 300</div>
                </form>
            </div>
        </div>
</body>

</html>