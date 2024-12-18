<?php
include_once __DIR__ . '/../../controllers/SessionManager.php';
SessionManager::startSession();
?>
<link rel="stylesheet" href="../public_html/css/nav_bar.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<nav class="navbar">
    <div class="container">
        <ul class="nav-links">
            <div class="left-section">
                <li>
                    <a href="javascript:void(0);" id="search-icon">
                        <span class="material-icons">search</span>
                    </a>
                </li>
                <li>
                    <a href="../app/views/user/car_comparison.php" class="listElement_navBar compare-link">
                        Compare cars
                    </a>
                </li>
            </div>
            <div class="center-section">
                <li>
                    <a href="#" class="listElementLogo_navBar logo-link">
                        Apex
                    </a>
                </li>
            </div>
            <div class="right-section">
                <li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <a href="../app/views/user/profile.php" class="listElement_login_navBar"
                            id="listElement_login_navBar">
                            <?php echo htmlspecialchars($_SESSION['user']->username); ?>
                        </a>
                    <?php else: ?>
                        <a href="../app/views/auth/login.php" class="listElement_login_navBar"
                            id="listElement_login_navBar">
                            Log in
                        </a>
                    <?php endif; ?>
                </li>
            </div>
        </ul>
    </div>
</nav>

<script src="../js/nav_bar.js"></script>