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
    type: 'bar',  // Type of chart (bar chart)
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
    type: 'line', // Bar chart type
    data: {
        labels: categories, // Categories as labels
        datasets: [{
            label: 'Total Recommendations',
            data: recommendations, // Recommendation data
            borderColor: 'rgb(54, 162, 235)',
            backgroundColor: 'rgba(54, 162, 235, 0.3)',
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
    type: 'line',
    data: {
        labels: months,
        datasets: [{
            label: 'Monthly Review Counts',
            data: reviewCounts,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
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


function setActionCarForm(action) {
     document.getElementById('carformAction').value = action;
    document.getElementById('carForm').submit();
}
// Form validation
function validate(form) {
    let isValid = true;

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
    } else if (username.value.length < 3) {
        setError(username, "Username must be at least 3 characters");
    } else if (!usernamePattern.test(username.value)) {
        setError(username, "Username must contain only letters ");
    } else {
        usernameERR.textContent = "";
    }

    // Birthdate validation
    const age = document.getElementById("age");
    const birthDateERR = document.getElementById("birthDateERR");
    age.errorElement = birthDateERR;

    if (age.value.trim() === "") {
        setError(age, "Date of Birth is required");
    } else {
        birthDateERR.textContent = "";
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


