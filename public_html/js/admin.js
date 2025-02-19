// Get all the radio buttons and divs
const radios = document.querySelectorAll('input[name="nav"]');
const cards = document.querySelectorAll(".card");
const div0 = document.getElementById("div0");
const div1 = document.getElementById("div1");
// const div2 = document.getElementById('div2');
const div3 = document.getElementById("div3");
const div4 = document.getElementById("div4");
const div5 = document.getElementById("div5");
const div6 = document.getElementById("div6");
const div7 = document.getElementById("div7");



function showNavbar() {
    const navbar = document.querySelector('.header_admin');
    if (navbar) {
        navbar.style.display = 'block';
    }
    document.querySelector('.content').style.marginTop = '2rem';
}


// Add event listeners to each card
cards.forEach((card) => {
    card.addEventListener("click", function () {
        showNavbar();

        const value = card.querySelector("[data-value]")?.dataset.value;

        switch (value) {
            case "home":
                showDiv(div0);
                break;
            case "statistics":
                showDiv(div1);
                break;
            case "usersControl":
                showDiv(div3);
                break;
            case "logout":
                showDiv(div4);
                break;
            case "carsControl":
                showDiv(div5);
                break;
            case "reviewsControl":
                showDiv(div6);
                break;
            default:
                showDiv(div1);
        }
    });
});



// Add event listeners to each radio button
radios.forEach((radio) => {
    radio.addEventListener("change", function () {
        switch (this.value) {
            case "home":
                showDiv(div0);
                break;
            case "statistics":
                showDiv(div1);
                break;
            // case 'post':
            //     showDiv(div2);
            //     break;
            case "usersControl":
                showDiv(div3);
                break;
            case "logout":
                showDiv(div4);
                break;
            case "carsControl":
                showDiv(div5);
                break;

            case "reviewsControl":
                showDiv(div6);
                break;

            default:
                showDiv(div1); // Default to home
        }
    });
});

// Function to show a div and hide others
function showDiv(divToShow) {
    div0.style.display = "none";
    div1.style.display = "none";
    // div2.style.display = 'none';
    div3.style.display = "none";
    div4.style.display = "none";
    div5.style.display = "none";
    div6.style.display = "none";
    div7.style.display = "none";
    divToShow.style.display = "block";
}


function toggleDivs(hideDivId, showDivId) {
    document.getElementById(hideDivId).style.display = "none";
    document.getElementById(showDivId).style.display = "block";
}

function redirectTo(url) {
    window.location.href = url;
}

//CHARTS 
//Personas Statistics
var ctx = document.getElementById('personasChart').getContext('2d');
var personasChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: personaNames,
        datasets: [{
            label: 'Generated Personas',
            data: personaCounters,
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 230, 64, 0.2)',
                'rgba(240, 170, 215, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgb(221, 201, 66)',
                'rgb(193, 93, 155)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function (tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw + ' personas';
                    }
                }
            }
        }
    }
});



//Logins Statistics
var ctx = document.getElementById('loginsChart').getContext('2d');
var loginChart = new Chart(ctx, {
    type: 'line',  // You can use 'line', 'bar', etc.
    data: {
        labels: months,  // x-axis labels (months)
        datasets: [{
            label: 'Logins Per Month',
            data: loginCounts,  // y-axis values (login counts)
            backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Line fill color
            borderColor: 'rgba(75, 192, 192, 1)',  // Line border color
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true  // y-axis starts at 0
            }
        }
    }
});


//Favourites Statistics
var ctx = document.getElementById('FavouritesChart').getContext('2d');
var favoritesChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: categories,
        datasets: [{
            label: 'Total Favorites',
            data: favorites,
            borderColor: 'rgb(112, 234, 140)',
            backgroundColor: 'rgba(90, 230, 108, 0.3)',
            fill: true,
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function (tooltipItem) {
                        return tooltipItem.raw + ' favorites';
                    }
                }
            }
        }
    }
});

//Statistics For Posts
var ctx = document.getElementById('postsChart').getContext('2d');
var postChart = new Chart(ctx, {
    type: 'line',  // Type of chart (bar chart)
    data: {
        labels: months,  // x-axis labels (months)
        datasets: [{
            label: 'Number of Posts',
            data: postCounts,  // y-axis values (post counts)
            backgroundColor: 'rgba(158, 50, 59, 0.2)',  // Bar color
            borderColor: 'rgb(175, 62, 62)',  // Bar border color
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});



//Recommendation Statistics
var ctx = document.getElementById('RecommendationChart').getContext('2d');
var recommendationChart = new Chart(ctx, {
    type: 'bar', // Bar chart type
    data: {
        labels: recommendationCategories, // Categories as labels
        datasets: [{
            label: 'Total Recommendations',
            data: recommendations, // Recommendation data
            borderColor: 'rgb(213, 104, 230)',
            backgroundColor: 'rgba(139, 43, 170, 0.3)',
            fill: true,
            tension: 0.1
        }]
    },
    options: {  
        responsive: true,
        scales: {
            y: {
                beginAtZero: true, // Start y-axis at zero
                title: {
                    display: true,
                    text: 'Total Recommendations'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Market Categories'
                },
                ticks: {
                    autoSkip: false, // Ensure all categories are shown
                    maxRotation: 45, // Rotate labels if they overlap
                    minRotation: 45
                }
            }
        },
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function (tooltipItem) {
                        return tooltipItem.raw + ' recommendations';
                    }
                }
            }
        }
    }

});

//Reviews statistics
var ctx = document.getElementById('reviewsChart').getContext('2d');
var reviewsChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: reviewCategories,
        datasets: [{
            label: 'Monthly Review Counts',
            data: reviewCategoryCounts,
            borderColor: 'rgb(208, 206, 144)',
            backgroundColor: 'rgba(228, 212, 91, 0.2)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});
// CRUD user

function populateForm() {
    var select = document.getElementById("userSelect");
    var selectedOption = select.options[select.selectedIndex];

    if (selectedOption.value) {
        var username = document.getElementById("username");
        var email = document.getElementById("email");
        var birthdate = document.getElementById("age");
        var userType = document.getElementById("user_type");

        var gender = document.getElementById("gender");
        var password = document.getElementById("password");
        var userId = document.getElementById("user_id");

        if (username)
            username.value = selectedOption.getAttribute("data-username");
        if (email) email.value = selectedOption.getAttribute("data-email");
        if (birthdate)
            birthdate.value = selectedOption.getAttribute("data-age");

        if (userType) {
            var userTypeID = selectedOption.getAttribute("data-type");
            if (userTypeID == '1') {
                userType.value = 'user';
            } else if (userTypeID == '2') {
                userType.value = 'admin';
            }
        }
        if (gender) gender.value = selectedOption.getAttribute("data-gender");
        if (password) {
            password.value = selectedOption.getAttribute("data-password");
            password.disabled = true;
        }
        if (userId) userId.value = selectedOption.value;

        // enableFormFields();

        // Show and hide buttons appropriately
        var editButton = document.getElementById("editButton");
        var adduserButton = document.getElementById("adduserButton");
        var addButton = document.getElementById("addButton");
        var saveButton = document.getElementById("saveButton");
        var deleteButton = document.getElementById("deleteButton");

        if (editButton) editButton.style.display = "flex";
        if (adduserButton) adduserButton.style.display = "none";
        if (addButton) addButton.style.display = "none";
        if (saveButton) saveButton.style.display = "none";
        if (deleteButton) deleteButton.style.display = "flex";
    } else {
        clearForm();
    }
}

function showSaveButton() {
    document.getElementById("saveButton").style.display = "flex";
    enableFormFields();
}

function enableFormFields() {
    // Enable the form fields
    document.getElementById("username").disabled = false;
    document.getElementById("age").disabled = false;
    document.getElementById("gender").disabled = false;
    document.getElementById("password").disabled = false;
    document.getElementById("user_type").disabled = false;
    document.getElementById("email").disabled = false;

    // Make inputs editable
    const inputs = document.querySelectorAll(
        "#username,#age,#gender, #password, #user_type, #email"
    );
    inputs.forEach((input) => {
        input.readOnly = false;
        input.disabled = false;
        input.classList.add("editable");
    });
}

function switchAddButtons() {
    document.getElementById("adduserButton").style.display = "none";
    document.getElementById("addButton").style.display = "flex";
}

function clearForm() {
    document.getElementById("userForm").reset();
    document.getElementById("username").disabled = false;
    document.getElementById("age").disabled = false;
    document.getElementById("password").disabled = false;
    document.getElementById("user_type").disabled = false;
    document.getElementById("email").disabled = false;
    document.getElementById("saveButton").disabled = false;
}

// // specifying the crud operation for car/user form
// function setAction(formId, action) {
//     const form = document.getElementById(formId);
//         form.value = action;

// }

//for specifying the crud operation
function setAction(action) {
    document.getElementById("formAction").value = action;
}

// Form validation
function validate(form) {
    let isValid = true;

    // Helper function to set error messages
    function setError(field, message) {
        field.errorElement.textContent = message;
        isValid = false;
    }

    // Username validation
    const username = document.getElementById("username");
    const usernameERR = document.getElementById("usernameERR");
    const usernamePattern = /^[a-zA-Z]+$/;

    username.errorElement = usernameERR;
    if (username.value.trim() === "") {
        setError(username, "Username is required");
    } else if (username.value.length < 1) {
        setError(username, "Username must be at least 1 character");
    } else if (!usernamePattern.test(username.value)) {
        setError(username, "Username must contain only letters");
    } else {
        usernameERR.textContent = "";
    }

    // Birthdate validation
    const birthdate = document.getElementById("age");
    const birthDateERR = document.getElementById("birthDateERR");
    birthdate.errorElement = birthDateERR;

    if (birthdate.value.trim() === "") {
        setError(birthdate, "Date of Birth is required");
    } else {
        // Optional: You could add additional checks, like age verification
        // For example, the user must be at least 18 years old
        const age = calculateAge(birthdate.value);
        if (age < 18) {
            setError(birthdate, "You must be at least 18 years old");
        } else {
            birthDateERR.textContent = "";
        }
    }

    // Gender validation
    const gender = document.getElementById("gender");
    const genderERR = document.getElementById("genderERR");
    gender.errorElement = genderERR;

    if (gender.value.trim() === "") {
        setError(gender, "Gender is required");
    } else {
        genderERR.textContent = "";
    }

    // Password validation
    const password = document.getElementById("password");
    const passERR = document.getElementById("passERR");
    password.errorElement = passERR;

    if (password.value.trim() === "") {
        setError(password, "Password is required");
    } else if (password.value.length < 6) {
        setError(password, "Password must be at least 6 characters long");
    } else {
        passERR.textContent = "";
    }

    // User type validation
    const userType = document.getElementById("user_type");
    const userTypeERR = document.getElementById("userTypeERR");
    userType.errorElement = userTypeERR;

    if (userType.value.trim() === "") {
        setError(userType, "User type is required");
    } else {
        userTypeERR.textContent = "";
    }

    // Email validation
    const email = document.getElementById("email");
    const emailERR = document.getElementById("emailERR");
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    email.errorElement = emailERR;

    if (email.value.trim() === "") {
        setError(email, "Email is required");
    } else if (!emailPattern.test(email.value)) {
        setError(email, "Please enter a valid email address");
    } else {
        emailERR.textContent = "";
    }

    return isValid;
}

// Helper function to calculate age from birthdate
function calculateAge(birthdate) {
    const birthDate = new Date(birthdate);
    const currentDate = new Date();
    const age = currentDate.getFullYear() - birthDate.getFullYear();
    const monthDifference = currentDate.getMonth() - birthDate.getMonth();

    // Adjust age if the birthday hasn't occurred yet this year
    if (monthDifference < 0 || (monthDifference === 0 && currentDate.getDate() < birthDate.getDate())) {
        return age - 1;
    }

    return age;
}


//Populating Car Form
function populateCarForm(button) {

    const form = document.getElementById('carForm');

    // Set the action to "update-car"
    document.getElementById('carFormAction').value = 'update-car';

    const carId = button.getAttribute('data-id');
    const make = button.getAttribute('data-make');
    const model = button.getAttribute('data-model');
    const year = button.getAttribute('data-year');
    const price = button.getAttribute('data-price');
    const type = button.getAttribute('data-type');
    const persona = button.getAttribute('data-persona');
    const personaDescription = button.getAttribute('data-persona-description');
    const topSpeed = button.getAttribute('data-top-speed');
    const acceleration = button.getAttribute('data-acceleration');
    const marketCategory = button.getAttribute('data-market-category');
    const horsepower = button.getAttribute('data-horsepower');
    const doors = button.getAttribute('data-doors');
    const engine = button.getAttribute('data-engine');
    const cylinders = button.getAttribute('data-cylinders');
    const torque = button.getAttribute('data-torque');
    const fuelEfficiency = button.getAttribute('data-fuel-efficiency');
    const fuelType = button.getAttribute('data-fuel-type');
    const transmission = button.getAttribute('data-transmission');
    const drivenWheels = button.getAttribute('data-driven-wheels');
    const description = button.getAttribute('data-description');

    // Populate the form fields with the retrieved data
    document.getElementById('car_id').value = carId;
    document.getElementById('make').value = make;
    document.getElementById('model').value = model;
    document.getElementById('year').value = year;
    document.getElementById('price').value = price;
    document.getElementById('type').value = type;
    document.getElementById('persona').value = persona;
    document.getElementById('personaDescription').value = personaDescription;
    document.getElementById('topSpeed').value = topSpeed;
    document.getElementById('acceleration').value = acceleration;
    document.getElementById('marketCategory').value = marketCategory;
    document.getElementById('horsePower').value = horsepower;
    document.getElementById('doors').value = doors;
    document.getElementById('engine').value = engine;
    document.getElementById('cylinders').value = cylinders;
    document.getElementById('torque').value = torque;
    document.getElementById('fuelEfficiency').value = fuelEfficiency;
    document.getElementById('fuelType').value = fuelType;
    document.getElementById('transmission').value = transmission;
    document.getElementById('drivenWheels').value = drivenWheels;
    document.getElementById('description').value = description;

}


function setActionCarForm() {
    const actionField = document.getElementById('carFormAction');
    const carIdField = document.getElementById('car_id');

    // If `car_id` is empty, it's an add action; otherwise, it's an update
    if (carIdField.value === '') {
        actionField.value = 'add-car';
    }
}

// Function to validate form
function validateCarForm(event) {
    let isValid = true;

    // Clear all previous error messages
    clearErrorMessages();

    // Validate Image
    const image = document.getElementById('image');
    if (!image.value) {
        showError("imageERR", "Image is required.");
        isValid = false;
    }

    // Validate Make
    const make = document.getElementById('make');
    if (!make.value.trim()) {
        showError("makeERR", "Make is required.");
        isValid = false;
    }

    // Validate Model
    const model = document.getElementById('model');
    if (!model.value.trim()) {
        showError("modelERR", "Model is required.");
        isValid = false;
    }

    // Validate Year
    const year = document.getElementById('year');
    if (!year.value) {
        showError("yearERR", "Please select a year.");
        isValid = false;
    }

    // Validate Price
    const price = document.getElementById('price');
    if (!price.value || price.value <= 0) {
        showError("priceERR", "Price must be a positive number.");
        isValid = false;
    }

    // Validate Type
    const type = document.getElementById('type');
    if (!type.value.trim()) {
        showError("typeERR", "Type is required.");
        isValid = false;
    }

    // Validate Persona
    const persona = document.getElementById('persona');
    if (!persona.value) {
        showError("personaERR", "Please select a persona.");
        isValid = false;
    }

    // Validate Persona Description
    const personaDescription = document.getElementById('personaDescription');
    if (!personaDescription.value.trim()) {
        showError("personaDescriptionERR", "Persona Description is required.");
        isValid = false;
    }

    // Validate Top Speed
    const topSpeed = document.getElementById('topSpeed');
    if (!topSpeed.value || topSpeed.value <= 0) {
        showError("topSpeedERR", "Top Speed must be a positive number.");
        isValid = false;
    }

    // Validate Acceleration
    const acceleration = document.getElementById('acceleration');
    if (!acceleration.value || acceleration.value <= 0) {
        showError("accelerationERR", "Acceleration must be a positive number.");
        isValid = false;
    }

    // Validate Market Category
    const marketCategory = document.getElementById('marketCategory');
    if (!marketCategory.value) {
        showError("marketCategoryERR", "Please select a market category.");
        isValid = false;
    }

    // Validate Horsepower
    const horsepower = document.getElementById('horsePower');
    if (!horsepower.value || horsepower.value <= 0) {
        showError("horsePowerERR", "Horsepower must be a positive number.");
        isValid = false;
    }

    // Validate Doors
    const doors = document.getElementById('doors');
    if (!doors.value) {
        showError("doorsERR", "Please select the number of doors.");
        isValid = false;
    }

    // Validate Engine
    const engine = document.getElementById('engine');
    if (!engine.value.trim()) {
        showError("engineERR", "Engine is required.");
        isValid = false;
    }

    // Validate Cylinders
    const cylinders = document.getElementById('cylinders');
    if (!cylinders.value) {
        showError("cylindersERR", "Please select the number of cylinders.");
        isValid = false;
    }

    // Validate Torque
    const torque = document.getElementById('torque');
    if (!torque.value || torque.value <= 0) {
        showError("torqueERR", "Torque must be a positive number.");
        isValid = false;
    }

    // Validate Fuel Efficiency
    const fuelEfficiency = document.getElementById('fuelEfficiency');
    if (!fuelEfficiency.value || fuelEfficiency.value <= 0) {
        showError("fuelEfficiencyERR", "Fuel Efficiency must be a positive number.");
        isValid = false;
    }

    // Validate Fuel Type
    const fuelType = document.getElementById('fuelType');
    if (!fuelType.value) {
        showError("fuelTypeERR", "Please select a fuel type.");
        isValid = false;
    }

    // Validate Transmission
    const transmission = document.getElementById('transmission');
    if (!transmission.value) {
        showError("transmissionERR", "Please select a transmission.");
        isValid = false;
    }

    // Validate Driven Wheels
    const drivenWheels = document.getElementById('drivenWheels');
    if (!drivenWheels.value) {
        showError("drivenWheelsERR", "Please select the driven wheels.");
        isValid = false;
    }

    // Validate Description
    const description = document.getElementById('description');
    if (!description.value.trim()) {
        showError("descriptionERR", "Description is required.");
        isValid = false;
    }

    // If form is not valid, prevent submission
    if (!isValid) {
        event.preventDefault();
    }
}

// Function to display error message
function showError(fieldId, message) {
    const errorSpan = document.getElementById(fieldId);
    errorSpan.textContent = message;
}

// Function to clear error messages
function clearErrorMessages() {
    const errorMessages = document.querySelectorAll('.error');
    errorMessages.forEach(error => {
        error.textContent = '';
    });
}

// Attach validate function to form submission
const carForm = document.getElementById('carForm');
carForm.addEventListener('submit', validateCarForm);
    