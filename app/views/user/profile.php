<?php
include_once  __DIR__ . '/../../../models/UsersClass.php';
require_once __DIR__ . '/../../../middleware/user_auth.php';
include_once __DIR__ . '/../../config/db_config.php';
include_once __DIR__ . '/../../../controllers/PlatformController.php';
include_once __DIR__ . '/../../../controllers/SessionManager.php';

user_auth("User Profile");
SessionManager::startSession();

$ctrl = new PlatformController($conn);
$user = SessionManager::getUser();
if ($user) {
  $userPosts = $ctrl->fetchPostsByUserID($user->id);

} else {
  echo "User not logged in or session expired.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
  <link rel="stylesheet" href="../../../../SWE_Phase1/public_html/css/user-profile.css">
  <script src="../../../public_html/js/user.js" defer></script>
  <title>Profile</title>
</head>

<body>

  <?php include "../../../public_html/components/userNavbar.php" ?>

  <span id="profile-pic" class="material-symbols-outlined">account_circle</span>

  <div class="user-profile">
    <div class="user-info">

      <div class="info-section">
        <h2 class="info-title">Full Name:</h2>
        <div class="info-content editable" contenteditable="false">John Doe</div>
        <span class="material-symbols-outlined edit-icon" onclick="editInfo(this)">edit</span>
      </div>

      <div class="info-section">
        <h2 class="info-title">Email:</h2>
        <div class="info-content editable" contenteditable="false">john.doe@example.com</div>
        <span class="material-symbols-outlined edit-icon" onclick="editInfo(this)">edit</span>
      </div>

      <div class="info-section">
        <h2 class="info-title">Password:</h2>
        <div class="info-content editable" contenteditable="false">********</div>
        <span class="material-symbols-outlined edit-icon" onclick="editInfo(this)">edit</span>
      </div>

    </div>
  </div>


  <div class="news-header">
    <h2>Check Out Your Posts!</h2>
  </div>
  <div class="rightSidebar">
    <div class="news-slider">
      <div class="news-container">
        <?php foreach ($userPosts as $post): ?>
          <div class="news-card">
            <div class="header">
            <img src="https://avatar.vercel.sh/jill" alt="Jill" class="avatar">
              <p class="name"><?= $post->username ?></p>
            </div>
            <p class="news"><?= $post->postText ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</body>

</html>