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
    <h2>Check The Latest News!</h2>
  </div>
  <div class="rightSidebar">
    <div class="news-slider">
      <div class="news-container">
        <div class="news-card">
          <div class="header">
            <img src="https://avatar.vercel.sh/jack" alt="Jack" class="avatar">
            <div class="info">
              <p class="name">Jack</p>
              <p class="username">@jack</p>
            </div>
          </div>
          <p class="news">I've never seen anything like this before. It's amazing. I love it.</p>
        </div>
        <div class="news-card">
          <div class="header">
            <img src="https://avatar.vercel.sh/jill" alt="Jill" class="avatar">
            <div class="info">
              <p class="name">Jill</p>
              <p class="username">@jill</p>
            </div>
          </div>
          <p class="news">I don't know what to say. I'm speechless. This is amazing.</p>
        </div>

        <div class="news-card">
          <div class="header">
            <img src="https://avatar.vercel.sh/john" alt="John" class="avatar">
            <div class="info">
              <p class="name">John</p>
              <p class="username">@john</p>
            </div>
          </div>
          <p class="news">I'm at a loss for words. This is amazing. I love it.</p>
        </div>


      </div>
    </div>
  </div>
</body>

</html>