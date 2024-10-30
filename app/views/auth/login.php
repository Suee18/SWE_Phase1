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
    <div class="login-container">
        <!-- Left: Form Section -->
        <div class="form-section">
            <h1>Sign in</h1>

            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Enter your email" />

            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter your password" />

            <label>
                <input type="checkbox"> Remember me
            </label>
            <button type="submit">Sign in</button>

            <p class="sign-up-link">Don't have an account? <a href="../auth/signup.php">Sign up</a></p>
        </div>

        <div class="welcome-section">
            <h1>Welcome Back!</h1>
            <p>Slogan and brief about the website</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f" style="color: #1E3A46;"></i></a>
                <a href="#"><i class="fab fa-instagram" style="color: #1E3A46;"></i></a>
            </div>
        </div>
    </div>
</body>

</html>