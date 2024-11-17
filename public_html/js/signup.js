document.getElementById("signupForm").addEventListener("submit", function (e) {
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm-password");
    const birthdate = document.getElementById("birthdate");

    let isValid = true;

    // Reset error messages and styles
    document.getElementById("emailError").innerText = "";
    email.classList.remove('error'); 
    document.getElementById("passwordError").innerText = "";
    password.classList.remove('error'); 
    document.getElementById("confirmPasswordError").innerText = "";
    confirmPassword.classList.remove('error');
    document.getElementById("birthdateError").innerText = "";
    birthdate.classList.remove('error'); 

    // Validate email
    if (!email.value.includes('@')) {
        document.getElementById("emailError").innerText = "Please include an '@' in the email address.";
        email.classList.add('error'); 
        isValid = false;
    }

    // Validate password match
    if (password.value !== confirmPassword.value) {
        document.getElementById("confirmPasswordError").innerText = "Passwords do not match.";
        password.classList.add('error'); 
        confirmPassword.classList.add('error'); 
        isValid = false;
    }

    const birthDate = new Date(birthdate.value);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    if (age < 18) {
        document.getElementById("birthdateError").innerText = "Age must be 18 or older. Please enter a valid birthdate.";
        birthdate.classList.add('error');
        isValid = false;
    }

    // Prevent form submission if there are validation errors
    if (!isValid) {
        e.preventDefault();
    }
});