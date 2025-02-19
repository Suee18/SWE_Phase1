<?php
include_once __DIR__ . '\..\..\config\db_config.php';
include_once __DIR__ . '\..\..\..\controllers\PlatformController.php';
include_once __DIR__ . '\..\..\..\controllers\UserControllers.php';
include_once __DIR__ . '\..\..\..\controllers\SessionManager.php';
require_once __DIR__ . '\..\..\..\middleware\user_auth.php';
user_auth("Platform");

SessionManager::startSession();

$platformController = new PlatformController($conn);

$action = $_POST['action'] ?? $_GET['action'] ?? null;

switch ($action) {
    case 'addPost':
        if (!empty(trim($_POST['text']))) {
            $userID = (SessionManager::getUser()) ? SessionManager::getUser()->id : 0;
            $postText = htmlspecialchars(trim($_POST['text']), ENT_QUOTES, 'UTF-8');
            $postImage = null;

            if (!empty($_FILES['image']['name'])) {
                $postImage = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], "../../../public_html/media/uploads/$postImage");
            }

            $platformController->createPost($userID, $postText, $postImage);
            header("Location: platform.php");
            exit();
        }
        break;

    case 'deletePost':
        if (!empty($_POST['postID'])) {
            $postID = $_POST['postID'];
            $post = $platformController->fetchPostByID($postID);

            if (SessionManager::getUser() && SessionManager::getUser()->id == $post->userID) {
                $platformController->removePost($postID);
                header("Location: platform.php");
                exit();
            } else {
                echo 'You cannot delete a post you do not own.';
                exit();
            }
        } else {
            echo 'Post ID is missing.';
            exit();
        }
        case 'editPost':
            if (!empty($_POST['postID']) && !empty(trim($_POST['text']))) {
                $postID = $_POST['postID'];
                $postText = htmlspecialchars(trim($_POST['text']), ENT_QUOTES, 'UTF-8');
                $postImage = null;
                $post = $platformController->fetchPostByID($postID);
        
                if (SessionManager::getUser() && SessionManager::getUser()->id == $post->userID) {
                    if (!empty($_FILES['image']['name'])) {
                        $postImage = $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'], "../../../public_html/media/uploads/$postImage");
                    } else {
                        $postImage = $post->postImage; 
                    }
        
                    $platformController->updatePost($postID, $postText, $postImage);
                    header("Location: platform.php");
                    exit();
                } else {
                    echo 'You cannot edit a post that is not yours.';
                    exit();
                }
            } else {
                echo 'Invalid data provided.';
                exit();
        }
        

    case 'addComment':
        if (!empty($_POST['postID']) && !empty($_POST['commentText'])) {
            $userID = SessionManager::getUser() ? SessionManager::getUser()->id : 0;
            $postID = $_POST['postID'];
            $commentText = $_POST['commentText'];

            $stmt = $conn->prepare("SELECT * FROM comments WHERE postID = ? AND userID = ? AND commentText = ?");
            $stmt->execute([$postID, $userID, $commentText]);
            $existingComment = $stmt->fetch();

            if (!$existingComment) {
                $platformController->addComment($postID, $userID, $commentText);
                $newComment = [
                    'username' => SessionManager::getUser()->username,
                    'commentText' => $commentText
                ];
                echo json_encode($newComment);
                exit();
            } else {
                echo json_encode(['error' => 'Duplicate comment detected']);
                exit();
            }
        }
        break;
    case 'toggleLike':
        if (!empty($_POST['postID'])) {
            $postID = $_POST['postID'];
            $userID = SessionManager::getUser() ? SessionManager::getUser()->id : null;

            if (!$userID) {
                echo json_encode(['error' => 'User not logged in']);
                exit();
            }

            $isLiked = $platformController->checkIfLiked($postID, $userID);

            try {
                if ($isLiked) {
                    $platformController->removeLike($postID, $userID);
                } else {
                    $platformController->likePost($postID, $userID);
                }

                $likesCount = $platformController->getLikesCount($postID);
                echo json_encode(['liked' => !$isLiked, 'likesCount' => $likesCount]);
            } catch (Exception $e) {
                echo json_encode(['error' => 'An error occurred. Please try again.']);
            }
            exit();
        } else {
            echo json_encode(['error' => 'Post ID missing']);
            exit();
        }

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../../../public_html/js/platform.js" defer></script>
    <title>ApexConnect</title>
</head>

<body>
    <?php include "../../../public_html/components/userNavbar.php"; ?>
    <div class="container">
        <h1>ApexConnect 🏎️💨</h1>
        <button id="addPostBtn"><i class="fas fa-plus"></i></button>

        <div id="postsContainer">
            <?php
            $posts = $platformController->fetchPosts();
            foreach ($posts as $post) {
                $comments = $platformController->fetchComments($post->postID);

                echo "
        <div class='post' id='post-{$post->postID}'>
            <div class='post-card'>
                <div class='post-header'>
                    <div style='display: flex; align-items: center;'>
                        <div class='post-userphoto'></div>
                        <span class='post-username'>{$post->username}</span>
                    </div>";

                $currentUser = SessionManager::getUser();
                if ($post->userID == $currentUser->id) {
                    echo "
                <div class='dots' onclick='toggleDropdown(event)'>
                    &#x22EE;
                </div>
                <ul class='dropdown' style='display: none;'>
                    <li class='dropdown-item editBtn' data-id='{$post->postID}' data-text='{$post->postText}' data-image='{$post->postImage}'>Edit Post</li>
                    <li class='dropdown-item deletePostBtn' data-id='{$post->postID}'>Delete Post</li>
                </ul>";
                }

                echo "
                </div>
                <div class='post-content'>
                    <div class='post-text'>
                        <p>{$post->postText}</p>
                    </div>";

                if (!empty($post->postImage)) {
                    echo "
                <div class='post-image'>
                    <img src='../../../public_html/media/uploads/{$post->postImage}' alt='Post Image' />
                </div>";
                }

                echo "
                    <div class='post-footer'> 
                        <span class='heart " . ($platformController->checkIfLiked($post->postID, SessionManager::getUser()->id) ? 'liked' : '') . "' data-id='" . $post->postID . "'>&#9829;</span>
                        <span class='likes-count'>" . $platformController->getLikesCount($post->postID) . " Likes</span>
                    </div>

                    <div class='comments'>
                        <textarea class='commentInput' placeholder='Add a comment...'></textarea>
                        <button type='button' onclick='addComment(" . $post->postID . ")'>&uarr;</button>
                    </div>
                    <h3>Comments section:</h3>";

                if (empty($comments)) {
                    echo "<div class='commentList'>
                    <p>No comments yet. Be the first to comment!</p>
                    </div>";
                    echo "";
                } else {
                    echo "<div class='commentList'>";
                    foreach ($comments as $comment) {
                        echo "<div class='comment'>@{$comment['username']}: {$comment['commentText']}</div><hr>";
                    }
                    echo "</div>";
                }

                echo "
                </div>
            </div>
        </div>";
            }
            ?>
        </div>

        <div id="postModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <form id="postForm" action="platform.php" method="POST" enctype="multipart/form-data" autocomplete="off">

                    <h2>Create/Edit a Post</h2>
                    <div id="errorMessage" style="color: red; display: none;">Please fix the errors before submitting.
                    </div>
                    <div id="charWarning" style="color: red; display: none;">
                        Please don't exceed 300 characters.
                    </div>
                    <textarea id="postContent" name="text" placeholder="What's on your mind?"
                        required><?php echo isset($post->postText) ? htmlspecialchars($post->postText, ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
                    <input type="file" id="postFile" name="image" accept="image/,video/" style="display: none;" />
                    <label for="postFile" id="fileLabel" class="custom-file-label">Choose File</label>
                    <input type="hidden" name="action" value="addPost" id="formAction">
                    <input type="hidden" name="postID" id="postID">
                    <button type="submit" id="savePostBtn" disabled>Save Post</button>
                    <div id="charCount">0 / 300</div>
                </form>
            </div>
        </div>
    </div>

    <div id="confirmModal" class="popup" style="display: none;">
        <div class="popup-content">
            <p>Are you sure you want to delete this post? This action cannot be undone.</p>
            <button id="confirmDeleteBtn">Yes, Delete</button>
            <button id="cancelDeleteBtn">Cancel</button>
        </div>
    </div>

    <script>
        const userID = <?php echo json_encode(SessionManager::getUser() ? SessionManager::getUser()->id : 0); ?>;
    </script>

</body>

</html>