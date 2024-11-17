<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public_html/css/chat_page.css">
    <script src="../../../public_html/js/chat_page.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <title>Turbo</title>
</head>
<body>

<!-- User Profile icon -->
<nav>
    <div class="nav-content">
        <div class="toggle-btn">
        <i class="fa-solid fa-user" style="color: #ffffff;"></i>
        </div>
        <span style="--i:4;"><a href="../../../public_html/index.php"><i class="fa-solid fa-house" style="color: #ffffff;"></i></a></span>
        <span style="--i:3;"><a href="profile.php"><i class="fa-solid fa-user" style="color: #ffffff;"></i></a></span>
        <span style="--i:2;"><a href="favorites.php"><i class="fa-solid fa-heart" style="color: #ffffff;"></i></a></span>
        <span style="--i:1;"><a href="../../../public_html/index.php"><i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i></a></span>
    </div>
</nav>

<div class="chat-card">
    <div id="date-time" class="date-time"></div>
    <div class="chat-box" id="chat-box">
        <div class="caption" id="caption">Start your engines! <br> What’s your question?</div>
    </div>
    <div class="user-input">
        <div class="input-container">
            <input type="text" id="input" placeholder="Enter your question here...">
            <button id="send-btn"><i class="fa-solid fa-arrow-up"></i></button>
        </div>
    </div>
</div>

</body>
</html>
