<?php
session_start();
include_once "../../config/db_config.php";
include_once "../../../models/UsersClass.php";

$errorMessages = [
    'name' => '',
    'email' => '',
    'password' => '',
    'age' => '',
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];

    if ($password !== $confirmPassword) {
        $errorMessages['password'] = "Passwords do not match.";
    }

    $birthDate = new DateTime($birthdate);
    $currentDate = new DateTime();
    $age = $birthDate->diff($currentDate)->y;

    if ($age < 18) {
        $errorMessages['age'] = "Age must be 18 or older. Please enter a valid birthdate.";
    }

    if (empty($errorMessages['password']) && empty($errorMessages['age'])) {
        $signUpResult = Users::signUpUser($userName, $birthdate, $gender, $password, $email, "user", date('Y-m-d H:i:s'));

        if (is_array($signUpResult)) {
            $errorMessages = array_merge($errorMessages, $signUpResult);
        } else {
            header("Location: ../../../public_html/index.php");
            exit();
        }
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
    <title>Sign Up</title>
</head>

<body>
    <!-- <div class="signup-container"> -->
    <div class="biggest-containerLI">

        <div class="form-sectionSU">
            <form id="signupForm" action="" method="POST">
                <p class="formTitle"> Sign Up</p>

                <div class="fieldsConatinerSU">

                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required />
                    <span id="nameError" class="error-message"><?php echo $errorMessages['name']; ?></span>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required />
                    <span id="emailError" class="error-message"><?php echo $errorMessages['email']; ?></span>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required />
                    <span id="passwordError" class="error-message"><?php echo $errorMessages['password']; ?></span>

                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required />
                    <span id="confirmPasswordError" class="error-message"></span>

                    <label for="birthdate">Birthdate</label>
                    <input type="date" id="birthdate" name="birthdate" placeholder="Enter your birthdate" required />
                    <span id="birthdateError" class="error-message"><?php echo $errorMessages['age']; ?></span>

                    <label  for="gender">Gender</label>
                    <select  class="gender-selection"id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <span id="genderError" class="error-message"></span>
                </div>
                <button class="R_button" type="submit" name="signup">Sign Up</button>
            <p id="tempMessage" style="display: none; color: green;">Sign-up successful! Redirecting to login...</p>
            <p class="no-account-text">Already have an account? <a href="../../views/auth/login.php" class="no-account-link">Log in.</a></p>
            </form>
        </div>

        <!-- <div class="welcome-section">
            <h1>Join Us!</h1>
            <p>Create an account and get started today</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f" style="color: #1E3A46;"></i></a>
                <a href="#"><i class="fab fa-instagram" style="color:#1E3A46;"></i></a>
            </div>
        </div> -->
        <!-- </div> -->
    </div>
    <script src="../../../public_html/js/signup.js"></script>
</body>

</html>