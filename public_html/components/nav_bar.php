<link rel="stylesheet" href="../public_html/css/nav_bar.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<nav class="navbar">
    <div class="container">
        <ul class="nav-links">
            <!-- search bar -->
            <li>
                <a href="javascript:void(0);" id="search-icon">
                    <span class="material-icons">search</span>
                </a>
            </li>
            <li class="search-input-container" style="display: none;">
                <input type="text" class="search-input" id="search-input" placeholder="Search for cars...">
            </li>
            <!-- ----------------------------------------- -->
            <li>
                <a href=".././app/views/car_comparison.php" class="listElement_navBar compare-link">
                    Compare cars
                </a>
            </li>
            <li>
                <a href="#" class="listElementLogo_navBar logo-link">
                    Apex
                </a>
            </li>
            <li>
                <a href=".././app/views/auth/login.php" class="listElement_login_navBar" id="listElement_login_navBar">
                    Log in
                </a>
            </li>
        </ul>
    </div>
</nav>

<script src="../js/nav_bar.js"></script>
