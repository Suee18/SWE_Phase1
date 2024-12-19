<?php

include_once __DIR__ . '\..\..\config\db_config.php';
include_once __DIR__ . '\..\..\..\controllers\PlatformController.php';
include __DIR__ . '\..\..\..\models\UsersClass.php';
include_once __DIR__ . '\..\..\..\controllers\SessionManager.php';
SessionManager::startSession();

$postsArray = PostController::getAllPosts();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public_html/css/platform.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../../../public_html/js/platform.js" defer></script>
    <title>ApexConnect</title>
</head>

<body>
    <?php include "../../../public_html/components/userNavbar.php"; ?>
    <div class="container">
        <h1>ApexConnect 🏎💨</h1>
        <button id="addPostBtn"><i class="fas fa-plus"></i></button>

        <div id="postsContainer">
            <?php foreach ($postsArray as $post): ?>
                <div class="post">
                    <p class="post-text"><?= htmlspecialchars($post->postText) ?></p>
                    <?php if (!empty($post->postImage)): ?>
                        <div class="post-image">
                            <img src="../../../public_html/uploads/<?= htmlspecialchars($post->postImage) ?>" alt="Post Image">
                        </div>
                    <?php endif; ?>
                    <div class="post-meta">
                        <span class="post-likes">❤ <?= htmlspecialchars($post->postLikes) ?> Likes</span>
                        <span class="post-user">Posted by User ID: <?= htmlspecialchars($post->userID) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="postModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <form id="postForm" action="../../../controllers/PlatformController.php" method="POST" enctype="multipart/form-data">
                    <h2>Create a Post</h2>
                    <div id="errorMessage" style="color: red; display: none;">Please fix the errors before submitting.</div>
                    <div id="charWarning" style="color: red; display: none;">
                        Please don't exceed 300 characters.
                    </div>
                    <textarea
                        id="postContent"
                        name="text"
                        placeholder="What's on your mind?"
                        maxlength="300"
                        required></textarea>
                    <input
                        type="file"
                        id="postFile"
                        name="image"
                        accept="image/,video/"
                        style="display: none;" />
                    <label for="postFile" id="fileLabel" class="custom-file-label">Choose File</label>
                    <input type="hidden" name="action" value="addPost" />
                    <button type="submit" id="savePostBtn" disabled>Save Post</button>
                    <div id="charCount">0 / 300</div>
                </form>
            </div>
        </div>

    </div>
    </div>
</body>

</html>