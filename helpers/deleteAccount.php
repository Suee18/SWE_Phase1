<?php
include_once __DIR__ . '/../app/config/db_config.php';
include_once __DIR__ . '/../controllers/SessionManager.php';
SessionManager::startSession();

global $conn;

// Ensure cascading deletes or handle userPages deletion (if needed)
$user_id = mysqli_real_escape_string($conn, htmlspecialchars($user_id));

// Delete from related tables first
$sql_comments = "DELETE FROM comments WHERE userID='$user_id'";
$sql_favorites = "DELETE FROM favorites WHERE userID='$user_id'";
$sql_likes = "DELETE FROM likes WHERE userID='$user_id'";
$sql_post = "DELETE FROM post WHERE userID='$user_id'";
$sql_reviews = "DELETE FROM reviews WHERE userID='$user_id'";

// Execute all deletions
mysqli_query($conn, $sql_comments);
mysqli_query($conn, $sql_favorites);
mysqli_query($conn, $sql_likes);
mysqli_query($conn, $sql_post);
mysqli_query($conn, $sql_reviews);

// Finally, delete the user from the User table
$sql_user = "DELETE FROM User WHERE ID='$user_id'";

// Destroy the session
SessionManager::destroySession();

// Redirect to the home page
header("Location: ../public_html/index.php");
exit; // Make sure to stop further script execution after redirect
