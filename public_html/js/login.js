
document.getElementById('loginForm').addEventListener('submit', function(event) {
    let valid = true;

    // Get form fields and error message elements
    const emailField = document.getElementById('email');
    const passwordField = document.getElementById('password');
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');

    // Clear previous error messages
    emailError.textContent = '';
    passwordError.textContent = '';

    if (!emailField.value.includes('@')) {
        emailError.textContent = "Email must contain an '@' sign.";
        valid = false;
    }

    // Validate password (example check for minimum length)
    /*if (passwordField.value.length < 6) {
        passwordError.textContent = "Password must be at least 6 characters.";
        valid = false;
    }*/

    // If validation fails, prevent form submission
    if (!valid) {
        event.preventDefault();
    }
});
