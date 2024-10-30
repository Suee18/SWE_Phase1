<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../../../public_html/css/login.css">
    <title>Sign Up</title>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../../../public_html/css/login.css">

</head>
<body>
    <div class="signup-container">
        <!-- Left: Form Section -->
        <div class="form-section">
            <h1>Sign Up</h1>

            <label for="name">Name</label>
            <input type="text" id="name" placeholder="Enter your name" />

            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Enter your email" />

            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter your password" />

            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" placeholder="Confirm your password" />

            <label>
                <input type="checkbox"> I agree to the terms and conditions
            </label>
            <button type="submit">Sign Up</button>
        </div>

        <!-- Right: Welcome Section -->
        <div class="welcome-section">
            <h1>Join Us!</h1>
            <p>Create an account and get started today</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f" style="color: #1E3A46;"></i></a>
                <a href="#"><i class="fab fa-instagram" style="color:#1E3A46;"></i></a>
            </div>
        </div>
    </div>
</body>
</html>
