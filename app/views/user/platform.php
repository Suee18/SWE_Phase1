<?php
include_once __DIR__ . '\..\..\config\db_config.php';
include_once __DIR__ . '\..\..\..\controllers\PlatformController.php';
include __DIR__ . '\..\..\..\models\UsersClass.php';
include_once __DIR__ . '\..\..\..\controllers\SessionManager.php';
SessionManager::startSession();

if (!SessionManager::getUser()) {
    echo ('User is not logged in.');
    exit();
}

$platformController = new PlatformController($conn);

$action = $_POST['action'] ?? $_GET['action'] ?? null;

switch ($action) {
    case 'addPost':
        if (!empty($_POST['text'])) {
            $userID = SessionManager::getUser() ? SessionManager::getUser()->id : 0;
            $postText = $_POST['text'];
            $postImage = null;

            if (!empty($_FILES['image']['name'])) {
                $postImage = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], "../../../public_html/media/uploads/$postImage");
            }

            $platformController->createPost($userID, $postText, $postImage);
        }
        break;

    case 'deletePost':
        if (!empty($_POST['postID'])) {
            $platformController->removePost($_POST['postID']);
        }
        break;

    case 'editPost':
        if (!empty($_POST['postID']) && !empty($_POST['text'])) {
            $postID = $_POST['postID'];
            $postText = $_POST['text'];
            $postImage = null;

            if (!empty($_FILES['image']['name'])) {
                $postImage = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], "../../../public_html/media/uploads/$postImage");
            }

            $platformController->updatePost($postID, $postText, $postImage);
        }
        break;

    default:
        break;
}
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
            <?php
            $posts = $platformController->fetchPosts();
            foreach ($posts as $post) {
                echo "
                <div class='post' id='post-{$post->postID}'>
                    <h4>Username</h4>
                    <p>{$post->postText}</p>
                    " . (!empty($post->postImage) ? "<img src='../../../public_html/media/uploads/{$post->postImage}' alt='Post Image'>" : '') . "
                    <p>Likes: {$post->postLikes}</p>
                    <form action='platform.php' method='POST' class='inline-form'>
                        <input type='hidden' name='action' value='deletePost'>
                        <input type='hidden' name='postID' value='{$post->postID}'>
                        <button type='submit' class='deleteBtn'><i class='fas fa-trash'></i></button>
                    </form>
                    <button class='editBtn' data-id='{$post->postID}' data-text='{$post->postText}' data-image='{$post->postImage}'>
                        <i class='fas fa-edit'></i>
                    </button>
                </div>
                ";
            }
            ?>
        </div>

        <div id="postModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <form id="postForm" action="platform.php" method="POST" enctype="multipart/form-data">
                    <h2>Create/Edit a Post</h2>
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
                    <input type="hidden" name="action" value="addPost" id="formAction">
                    <input type="hidden" name="postID" id="postID">
                    <button type="submit" id="savePostBtn" disabled>Save Post</button>
                    <div id="charCount">0 / 300</div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>