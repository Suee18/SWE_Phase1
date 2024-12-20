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
            echo 'Post deleted successfully';
        } else {
            echo 'Post ID is missing.';
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
                // Fetch comments for the post
                $comments = $platformController->fetchComments($post->postID);

                     echo "
            <div class='post' id='post-{$post->postID}'>
                        <div class='post-card'>
                <div class='post-header'>
                    <div style='display: flex; align-items: center;'>
                        <div class='post-userphoto'></div>
                        <span class='post-username'>Username</span>
                    </div>
                    <div class='dots' onclick='toggleDropdown(event)'>
                        &#x22EE;
                    </div>
                    <ul class='dropdown' style='display: none;'>
                        <li class='dropdown-item editBtn' data-id='{$post->postID}' data-text='{$post->postText}' data-image='{$post->postImage}'>Edit Post</li>
                        <li class='dropdown-item' data-id='{$post->postID}'>Delete Post</li>
                    </ul>
                </div>

                <div class='post-content'>
                    <div class='post-text'>
                        <p>{$post->postText}</p>
                    </div>
                    " . (!empty($post->postImage) ? "
                    <div class='post-image'>
                        <img src='../../../public_html/media/uploads/{$post->postImage}' alt='Post Image' />
                    </div>
                    " : '') . "
                    <div class='post-footer'>
                        <span class='heart' onclick='toggleLike(this, {$post->postID})'>&#9829;</span>
                        <span class='likes-count'>{$post->postLikes} Likes</span>
                    </div>
                    <div class='comments'>
                        <textarea class='commentInput' placeholder='Add a comment...'></textarea>
                         <button type='button' onclick='addComment(<?php echo $post->postID; ?>)'>&uarr;</button>

                    </div>
                    <h3>Comments section:</h3>";

                if (empty($comments)) {
                    echo "<p>No comments yet. Be the first to comment!</p>";
                } else {
                    echo "<div class='commentList'>";
                    foreach ($comments as $comment) {
                        echo "<div class='comment'>@user{$comment['userID']}: {$comment['commentText']}</div><hr>";
                    }
                    echo "</div>";
                }

                echo "</div>
            </div>
        </div>";
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

    <script>
        const userID = <?php echo json_encode(SessionManager::getUser() ? SessionManager::getUser()->id : 0); ?>;
    </script>

</body>

</html>