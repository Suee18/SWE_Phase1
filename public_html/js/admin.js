// Get all the radio buttons and divs
const radios = document.querySelectorAll('input[name="nav"]');
const div0 = document.getElementById('div0');
const div1 = document.getElementById('div1');
// const div2 = document.getElementById('div2');
const div3 = document.getElementById('div3');
const div4 = document.getElementById('div4');
const div5 = document.getElementById('div5');
const div6 = document.getElementById('div6');
const div7 = document.getElementById('div7');

// Add event listeners to each radio button
radios.forEach(radio => {
    radio.addEventListener('change', function () {
        switch (this.value) {
            case 'home':
                showDiv(div0);
                break;
            case 'statistics':
                showDiv(div1);
                break;
            // case 'post':
            //     showDiv(div2);
            //     break;
            case 'usersControl':
                showDiv(div3);
                break;
            case 'logout':
                showDiv(div4);
                break;
            case 'carsControl':
                showDiv(div5);
                break;

            case 'reviewsControl':
                showDiv(div6);
                break;


            default:
                showDiv(div1); // Default to home
        }
    });
});

// Function to show a div and hide others
function showDiv(divToShow) {
    div0.style.display = 'none';
    div1.style.display = 'none';
    // div2.style.display = 'none';
    div3.style.display = 'none';
    div4.style.display = 'none';  
     div5.style.display = 'none';
    div6.style.display = 'none';
    divToShow.style.display = 'block';
}


function redirectTo(url) {
    window.location.href = url;
}





//CHARTS TRIAL
// Website Views Data (Simulated)
const viewsData = {
    labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
    datasets: [{
        label: 'Website Views',
        data: [120, 150, 180, 200, 240, 260, 300],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
    }]
};

// Generated Plans Data (Simulated)
const plansData = {
    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
    datasets: [{
        label: 'Generated Plans',
        data: [20, 25, 15, 30],
        backgroundColor: 'rgba(153, 102, 255, 0.2)',
        borderColor: 'rgba(153, 102, 255, 1)',
        borderWidth: 1
    }]
};

// Configuring Website Views Chart
const ctxViews = document.getElementById('viewsChart').getContext('2d');
const viewsChart = new Chart(ctxViews, {
    type: 'bar',
    data: viewsData,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Configuring Generated Plans Chart
const ctxPlans = document.getElementById('plansChart').getContext('2d');
const plansChart = new Chart(ctxPlans, {
    type: 'line',
    data: plansData,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Data for Registered Users per Month (Simulated)
const usersData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [{
        label: 'Registered Users',
        data: [30, 50, 40, 60, 70, 80, 100, 90, 110, 130, 120, 150], // Simulated data for users per month
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
    }]
};

// Data for Generated Personas (Simulated)
const personasData = {
    labels: ['Adventurous', 'Family-Oriented', 'Budget-Friendly', 'Luxury Seeker'],
    datasets: [{
        label: 'Generated Personas',
        data: [45, 30, 60, 25], // Simulated persona data
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)'
        ],
        borderWidth: 1
    }]
};

// Configuring Registered Users Chart
const ctxUsers = document.getElementById('usersChart').getContext('2d');
const usersChart = new Chart(ctxUsers, {
    type: 'bar',
    data: usersData,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Configuring Generated Personas Chart (Pie Chart)
const ctxPersonas = document.getElementById('personasChart').getContext('2d');
const personasChart = new Chart(ctxPersonas, {
    type: 'doughnut', // You can change this to 'pie' if you prefer
    data: personasData,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});



// Total Conversations Data (Simulated)
const conversationsData = {
    labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
    datasets: [{
        label: 'Total Conversations',
        data: [50, 75, 60, 80, 120, 90, 150], // Simulated data for total conversations per day
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
    }]
};

// Average Session Duration Data (Simulated)
const sessionDurationData = {
    labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
    datasets: [{
        label: 'Average Session Duration (Minutes)',
        data: [4.5, 5, 6.2, 5.5, 7.1, 6.8, 5.9], // Simulated data for average session duration
        backgroundColor: 'rgba(255, 159, 64, 0.2)',
        borderColor: 'rgba(255, 159, 64, 1)',
        borderWidth: 1
    }]
};

// Configuring Total Conversations Chart
const ctxConversations = document.getElementById('conversationsChart').getContext('2d');
const conversationsChart = new Chart(ctxConversations, {
    type: 'bar',
    data: conversationsData,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Configuring Average Session Duration Chart
const ctxSessionDuration = document.getElementById('sessionDurationChart').getContext('2d');
const sessionDurationChart = new Chart(ctxSessionDuration, {
    type: 'line',
    data: sessionDurationData,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// CRUD user


function populateForm() {
    var select = document.getElementById('userSelect');
    var selectedOption = select.options[select.selectedIndex];

    if (selectedOption.value) {

        document.getElementById('username').value = selectedOption.getAttribute('data-username');
        document.getElementById('email').value = selectedOption.getAttribute('data-email');
        document.getElementById('age').value = selectedOption.getAttribute('data-age');
        document.getElementById('user_type').value = selectedOption.getAttribute('data-type');
        document.getElementById('gender').value = selectedOption.getAttribute('data-gender');
        document.getElementById('password').value =  selectedOption.getAttribute('data-password');
        document.getElementById('password').disabled = true;
     
         // Set the user ID in the hidden field
         document.getElementById('user_id').value = selectedOption.value;

        //  enableFormFields();

        // Show and hide buttons appropriately
        document.getElementById('editButton').style.display = 'flex';
           document.getElementById('adduserButton').style.display = 'none';
        document.getElementById('addButton').style.display = 'none';
        document.getElementById('saveButton').style.display = 'none';
        document.getElementById('deleteButton').style.display = 'flex';


    } else {
       
        clearForm();
    }
}


function showSaveButton() {
    document.getElementById('saveButton').style.display = 'flex'; 
    enableFormFields(); 
}

function enableFormFields() {
    // Enable the form fields
    document.getElementById('username').disabled = false;
    document.getElementById('age').disabled = false;
    document.getElementById('gender').disabled = false;
    document.getElementById('password').disabled = false;
    document.getElementById('user_type').disabled = false;
    document.getElementById('email').disabled = false;

    // Make inputs editable
    const inputs = document.querySelectorAll('#username,#age,#gender, #password, #user_type, #email');
    inputs.forEach(input => {
        input.readOnly = false;
        input.disabled = false;
        input.classList.add('editable');
    });


}

function switchAddButtons(){
    
    document.getElementById('adduserButton').style.display = 'none';
    document.getElementById('addButton').style.display = 'flex';
}



function clearForm() {
    document.getElementById('userForm').reset();
    document.getElementById('username').disabled = false;
    document.getElementById('age').disabled = false;
    document.getElementById('password').disabled = false;
    document.getElementById('user_type').disabled = false;
    document.getElementById('email').disabled = false;
    document.getElementById('saveButton').disabled = false;
}


//for specifying the crud operation
function setAction(action) {
    document.getElementById('formAction').value = action;
}

// Form validation
function validate(form) {
    let isValid = true;

    function setError(field, message) {
        field.errorElement.textContent = message;
        isValid = false;
    }

    // Username validation
    const username = document.getElementById('username');
    const usernameERR = document.getElementById('usernameERR');
    const usernamePattern = /^[a-zA-Z]+$/; 

    username.errorElement = usernameERR; 
    if (username.value.trim() === '') {
        setError(username, 'Username is required');
    } else if (username.value.length < 3) { 
        setError(username, 'Username must be at least 3 characters');
    } else if (!usernamePattern.test(username.value)) {
        setError(username, 'Username must contain only letters ');
    } else {
        usernameERR.textContent = '';
    }

    // Birthdate validation
    const age = document.getElementById('age');
    const birthDateERR = document.getElementById('birthDateERR');
    age.errorElement = birthDateERR; 

    if (age.value.trim() === '') {
        setError(age, 'Date of Birth is required');
    } else {
        birthDateERR.textContent = '';
    }

    // Gender validation
    const gender = document.getElementById('gender');
    const genderERR = document.getElementById('genderERR');
    gender.errorElement = genderERR; 

    if (gender.value.trim() === '') {
        setError(gender, 'Gender is required');
    } else {
        genderERR.textContent = '';
    }

    // Password validation
    const password = document.getElementById('password');
    const passERR = document.getElementById('passERR');
    password.errorElement = passERR; 

    if (password.value.trim() === '') {
        setError(password, 'Password is required');
    } else if (password.value.length < 6) {
        setError(password, 'Password must be at least 6 characters long');
    } else {
        passERR.textContent = ''; 
    }

    // User type validation
    const userType = document.getElementById('user_type');
    const userTypeERR = document.getElementById('userTypeERR');
    userType.errorElement = userTypeERR; 
    if (userType.value.trim() === '') {
        setError(userType, 'User type is required');
    } else {
        userTypeERR.textContent = ''; 
    }

    // Email validation
    const email = document.getElementById('email');
    const emailERR = document.getElementById('emailERR');
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    email.errorElement = emailERR; 

    if (email.value.trim() === '') {
        setError(email, 'Email is required');
    } else if (!emailPattern.test(email.value)) {
        setError(email, 'Please enter a valid email address');
    } else {
        emailERR.textContent = ''; 
    }

    return isValid; 
}
