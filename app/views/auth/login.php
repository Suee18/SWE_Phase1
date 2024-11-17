<?php
// Start session
session_start();
include_once "../../config/db_config.php";
include_once "../../../models/UsersClass.php";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Test the database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$error_message = '';  // Initialize error message

if (isset($_POST['Submit'])) {
    $Email = $_POST["Email"];
    $Password = $_POST["Password"];

    // // Escape the input to prevent SQL Injection
    // $Email = mysqli_real_escape_string($conn, $Email);

    // $sql = "SELECT * FROM users WHERE email = '$Email'";
    // $result = mysqli_query($conn, $sql);

    // if (mysqli_num_rows($result) > 0) {
    //     $row = mysqli_fetch_array($result);
    //     $rowEmail = $row["email"];
    //     $rowPassword = $row["password"];

    //     if ($Password === $rowPassword) {
    //         header("Location: ../../../public_html/index.php");
    //     } else {
    //         $error_message = "Invalid Email or Password";
    //     }
    // } else {
    //     $error_message = "Invalid Email or Password";
    // }


    $user = Users::loginUser($Email, $Password);
    if (is_string($user)) {
        $error_message = $user;
    } elseif ($user instanceof Users) {
        if ($user->userType === "admin") {
            header("Location: ../admin/admin.php");
        } else {
            header("Location: ../../../public_html/index.php");
        }
        exit();
    } else {
        $error_message = "An unknown error occurred.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../../public_html/css/login.css">
    <title>Sign In</title>
</head>

<body>
    <div class="biggest-containerLI">
        <!-- <div class="login-container"> -->


        <div class="form-section_LI">
            <form action="" method="post" id="loginForm">
                <p class="formTitle">Log in</p>
                <div class="fieldsConatinerLI">
                    <label for="email">E-mail :</label>
                    <input type="text" id="email" name="Email" placeholder="Enter your email">
                    <span class="error-message" id="email-error"></span>

                    <label for="password">Password :</label>
                    <input type="password" id="password" name="Password" placeholder="Enter your password">
                    <span class="error-message"
                        id="password-error"><?php echo htmlspecialchars($error_message); ?></span>
                </div>
                <div class="buttons">
                    <input class="R_button" type="submit" value="Log in" name="Submit" value="Login">
                    <input class="R_button" type="reset" value="Reset">
                </div>

                <p class="no-account-text">Don't have an account? <a href="../../views/auth/signup.php"
                        class="no-account-link">Sign up</a> now and explore more features!</p>

            </form>
        </div>

        <!-- 
        <div class="welcome-section">
            <h1>Welcome Back!</h1>
            <p>Our website's slogan and a brief introduction go here.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div> -->
    </div>
    <script src="../../../public_html/js/login.js"></script>
</body>

</html>