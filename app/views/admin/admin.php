<?php

include_once __DIR__ . '\..\..\config\db_config.php';

include __DIR__ . '\..\..\..\models\ReviewsClass.php';
include __DIR__ . '\..\..\..\models\UsersClass.php';
include_once __DIR__ . '\..\..\..\controllers\SessionManager.php';
include_once __DIR__ . '\..\..\..\controllers\carController.php';
include_once __DIR__ . '\..\..\..\controllers\UserControllers.php';
include_once __DIR__ . '\..\..\..\controllers\ReviewController.php';

include_once __DIR__ . '\..\..\..\controllers\SessionManager.php';

SessionManager::startSession();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
} 

//Statistics Generation part
//Generating Personas Statistics
$personasData = UserController::getPersonas();

$personaNames = $personasData['personaNames'];
$personaCounters = $personasData['personaCounters'];

//Generating Login Statistics
$data = UserController::getLoginStatistics();
$months = $data['formattedMonths'];
$loginCounts = $data['totalLoginCounts'];

//Generating Favourited Cars Statistics
$FavoriteData = UserController::getFavouritesStat();
$categories = $FavoriteData['categories'];
$favorites = $FavoriteData['favorites'];

//Generating Posts Statstics 
$postData = UserController::getPostsCountByMonth();
$postMonths = $postData['months'];
$postCounts = $postData['postCounts'];

//Generating Recommendation Statstics 
$RecommendationData = UserController::getRecommendationCounts();

$categories = $RecommendationData['categories'];
$recommendations = $RecommendationData['recommendations'];

//Generating Reviews Statistics
$reviewData = UserController::getReviewsStatistics();

$months = $reviewData['months'];
$reviewCounts = $reviewData['reviewCounts'];



//User Cruds 
$users = UserController::viewAllUsers();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? 'read';

    switch ($action) {
        case 'add':

            $username = $_POST['username'];
            $birthdate = $_POST['age'];
            $password = $_POST['password'];
            $userType = $_POST['user_type'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            UserController::addNewUserCtrl($username, $password, $birthdate, $userType, $email, $gender);
            break;
        case 'update':
            $user_id = $_POST['user_id'];
            $username = $_POST['username'];
            $birthdate = $_POST['age'];
            $password = $_POST['password'];
            $userType = $_POST['user_type'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            UserController::updateUserCtrl($user_id, $username, $birthdate, $gender, $password, $email, $userType);
            break;
        case 'delete':
            $user_id = $_POST['user_id'];
            UserController::deleteUserCtrl($user_id);
            break;
    }
    header('Location: admin.php');
}




//Reviews Cruds
$reviews = ReviewController::getReviews();

if (isset($_POST['deleteReview'])) {

    $reviewID = $_POST['reviewID'];
    $strategy = new ReviewDatabaseStrategy();
    $controller = new ReviewController($strategy);
    $result = $controller->deleteReview($reviewID);

    // if (Reviews::deleteReviewFromDB($reviewID)) {
    //     header("Location: admin.php");
    // } else {
    //     echo "<alert>Error deleting review</alert>";
    // }
    if ($result) {
        echo "<p style='color: green;'>Review deleted successfully!</p>";
    } else {
        echo "<p style='color: red;'>Failed to delete the review.</p>";
    }

    // Refresh the page to reflect changes
    header("Location: " . $_SERVER['PHP_SELF']);
}


//Cars Cruds
$cars = carController::viewAllCars();
$highlyRecommended = carController::getHighlyRecommendedCars();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public_html/css/admin.css">
    <link rel="stylesheet" href="../../../public_html/css/car_card.css">
    <script src="js/favorites.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha384-4oVU5+BHEfuDd4Q6+lcl6v+9XYWQ0JN+DNJeSoDgxGfCxGp3h66laXK9N/5ay2ad" crossorigin="anonymous">


    <!-- <title>Admin dashboard</title> -->
</head>

<body>
    <!-- Navigation Bar -->
    <header class="header_admin">
        <nav class="admin-navbar">
            <label>
                <input type="radio" name="nav" value="home" id="home" checked
                    onclick="redirectTo('../../../public_html')">
                Home
            </label>
            <label>
                <input type="radio" name="nav" value="statistics" id="statistics">
                Statistics
            </label>
            <!-- <label>
                <input type="radio" name="nav" value="post" id="post">
                Post
            </label> -->
            <label>
                <input type="radio" name="nav" value="usersControl" id="usersControl">
                Users
            </label>
            <label>
                <input type="radio" name="nav" value="carsControl" id="carsControl">
                Cars
            </label>
            <label>
                <input type="radio" name="nav" value="reviewsControl" id="reviewsControl">
                reviews
            </label>
            <label>
                <input type="radio" name="nav" value="logout" id="logout">
                Logout
            </label>
        </nav>
    </header>

    <!-- Content Area -->
    <div class="content">

        <div id="div0" class="content-div" style="display: block;">
            <!-- <div class="welcomeIcon1"></div>

            <div class="welcome">welcome, Admin</div>
            <div class="welcomeParagraph">Access the website insights and have full control over everything through this
                dashboard</div>
            <div class="welcomeIcon"></div> -->

            <h1 class="welcom-admin">Admin Dashboard</h1>
            <div class="card-container">

                <!-- Home Card -->
                <div class="card" id="card1">
                    <div class="card-icon">
                        <i class="fa-solid fa-house"></i>

                    </div>
                    <div class="card-content">
                        <h3 data-value="home">Home</h3>
                    </div>
                </div>


                <!-- Statstics Card -->
                <div class="card" id="card2">
                    <div class="card-icon">
                        <i class="fa-solid fa-chart-pie "></i>

                    </div>
                    <div class="card-content">
                        <h3 data-value="statistics"> Statistics</h3>
                    </div>
                </div>

                <!-- Users Card -->
                <div class="card" id="card3">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-content">
                        <h3 data-value="usersControl">Users</h3>
                    </div>
                </div>

                <!-- Cars Card -->
                <div class="card" id="card4">
                    <div class="card-icon">
                        <i class="fa-solid fa-car"></i>

                    </div>
                    <div class="card-content">
                        <h3 data-value="carsControl"> Cars</h3>
                    </div>
                </div>

                <!-- Reviews Card -->
                <div class="card" id="card5">
                    <div class="card-icon">
                        <i class="fa-regular fa-note-sticky"></i>

                    </div>
                    <div class="card-content">
                        <h3 data-value="reviewsControl"> Reviews</h3>
                    </div>
                </div>

                <!-- Logout Card -->
                <div class="card" id="card6">
                    <div class="card-icon">
                        <i class="fa-solid fa-right-from-bracket"></i>

                    </div>
                    <div class="card-content">
                        <h3 data-value="logout"> Log Out</h3>
                    </div>
                </div>
            </div>


        </div>


        <!--======================= statistics =================================-->


        <div id="div1" class="content-div" style="display: none;">
            <div class="small-container">
                <div id="div1" class="stats-div">
                    <p class="stat-title"> Reviews per Month</p>
                    <canvas id="reviewsChart" width="400" height="200"></canvas>
                </div>
                <script>
                    var months = <?php echo json_encode($months); ?>;
                    var reviewCounts = <?php echo json_encode($reviewCounts); ?>;
                </script>

                <div id="div1" class="stats-div">
                    <p class="stat-title">Logins Per Month </p>
                    <canvas id="loginsChart" width="400" height="200"></canvas>
                </div>
                <script>
                    var months = <?php echo json_encode($months); ?>;
                    var loginCounts = <?php echo json_encode($loginCounts); ?>;
                </script>

                <div id="div1" class="stats-div">
                    <p class="stat-title">Favourited Cars</p class="stat-title">
                    <canvas id="FavouritesChart" width="400" height="200"></canvas>

                </div>
                <script>
                    var categories = <?php echo json_encode($categories); ?>;
                    var favorites = <?php echo json_encode($favorites); ?>;
                </script>
                <div id="div1" class="stats-div">
                    <p class="stat-title"> Posts Per Month</p>
                    <canvas id="postsChart" width="400" height="200"></canvas>
                </div>
                <script>
                    var months = <?php echo json_encode($postMonths); ?>;
                    var postCounts = <?php echo json_encode($postCounts); ?>;
                </script>


                <div id="div2" class="stats-div">
                    <p class="stat-title">Recommendation Statistics</p>
                    <canvas id="RecommendationChart" width="400" height="200"></canvas>
                </div>

                <script>
                    var categories = <?php echo json_encode($categories); ?>;
                    var recommendations = <?php echo json_encode($recommendations); ?>;
                </script>


                <div id="div1" class="stats-div">
                    <p>
                    <p class="stat-title"> Generated Personas</p>
                    <canvas id="personasChart" width="400" height="200"></canvas></p>
                </div>

                <script>
                    var personaNames = <?php echo json_encode($personaNames); ?>;
                    var personaCounters = <?php echo json_encode($personaCounters); ?>;
                </script>


            </div>
        </div>
        <!--======================= statistics end =================================-->


        <!--======================= post =======================-->
        <!-- 
        <div id="div2" class="content-div" style="display: none;">
            <div class="small-container">
                This is Post Content
                (@Aloo2a 😚 add anything here with id the same as that parent id)
            </div>
        </div> ======================= post end======================= -->



        <!--=================== USER CRUD form ===========================-->

        <div id="div3" class="content-div" style="display: none;">

            <div class="small-container">

                <div class="formContainer">
                    <form id="userForm" method="POST" action="admin.php" onsubmit="return validate(this)">

                        <div class="formInputfields">
                            <div>
                                <label class="formLabels" for="userSelect">Select User:</label>
                                <select id="userSelect" name="user_id" onchange="populateForm()">
                                    <option value="" disabled selected>Select a user</option>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?php echo isset($user['ID']) ? htmlspecialchars($user['ID']) : ''; ?>"
                                            data-username="<?php echo isset($user['userName']) ? htmlspecialchars($user['userName']) : ''; ?>"
                                            data-age="<?php echo isset($user['birthdate']) ? htmlspecialchars($user['birthdate']) : ''; ?>"
                                            data-gender="<?php echo isset($user['gender']) ? htmlspecialchars($user['gender']) : ''; ?>"
                                            data-email="<?php echo isset($user['email']) ? htmlspecialchars($user['email']) : ''; ?>"
                                            data-password="<?php echo isset($user['password']) ? htmlspecialchars($user['password']) : ''; ?>"
                                            data-type="<?php echo isset($user['userTypeID']) ? htmlspecialchars($user['userTypeID']) : ''; ?>">
                                            <?php echo isset($user['userName']) ? htmlspecialchars($user['userName']) : 'Unknown User'; ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>

                            <!-- hidden input to get the user id from DB -->
                            <input type="hidden" name="user_id" id="user_id" value="">
                            <div>
                                <label class="formLabels" for="username">Username :</label>
                                <input type="text" name="username" id="username" readonly disabled>
                                <span id="usernameERR" class="error"></span>
                            </div>

                            <div>
                                <label class="formLabels" for="email">e-mail :</label>
                                <input type="email" name="email" id="email" readonly disabled>
                                <span id="emailERR" class="error"></span>
                            </div>

                            <div>
                                <label class="formLabels" for="password">Password :</label>
                                <input type="password" name="password" id="password" readonly disabled>
                                <span id="passERR" class="error"></span>
                            </div>


                            <label class="formLabels" for="age">Date of Birth:</label>
                            <input type="date" id="age" name="age" disabled>
                            <span id="birthDateERR" class="error"></span>
                            <div>



                                <label class="formLabels" for="gender">Gender :</label>
                                <select id="gender" name="gender" disabled>
                                    <option value=""></option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span id="genderERR" class="error"></span>
                            </div>



                            <div>
                                <label class="formLabels" for="user_type">User Type :</label>
                                <select id="user_type" name="user_type" disabled>

                                    <option value=""></option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                                <span id="userTypeERR" class="error"></span>
                            </div>


                        </div>
                        <!-- Hidden field for form action -->
                        <input type="hidden" name="action" id="formAction" value="">
                        <div class="CRUD_bigcontainer">
                            <p class="controlPanel_text">control panel</p>

                            <!-- Buttons -->
                            <div class="CRUD_control">
                                <div class="CRUDcontainer">
                                    <!-- add -->
                                    <button class="button" name="addUser" type="button" id="adduserButton"
                                        onclick="enableFormFields(); switchAddButtons();">
                                        <span class="button__text">Add user</span>
                                        <span class="button__icon">
                                            <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i>
                                        </span>
                                    </button>

                                    <button style="display:none" class="button" name="addButton" type="submit"
                                        id="addButton" onclick="setAction('add')">
                                        <span class="button__text">Add user</span>
                                        <span class="button__icon">
                                            <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i>
                                        </span>
                                    </button>

                                    <!-- edit -->
                                    <button class="button" type="button" id="editButton" onclick="enableFormFields();showSaveButton()"
                                        style=" display:none">
                                        <span class="button__text">Edit info</span>
                                        <span class="button__icon">
                                            <i class="fa-solid fa-user-pen" style="color: #ffffff;"></i>
                                        </span>
                                    </button>
                                    <!-- save -->
                                    <button style="display:none" class="button" type="submit" id="saveButton"
                                        onclick=" setAction('update')">
                                        <span class="button__text"> Save info</span>
                                        <span class="button__icon">
                                            <i class="fa-regular fa-floppy-disk" style="color: #ffffff;"></i>
                                    </button>
                                    <!-- delete -->
                                    <button class="button" type="submit" id="deleteButton" style="display:none"
                                        onclick="setAction('delete')">
                                        <span class="button__text">Delete user</span>
                                        <span class="button__icon">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div> <!--=================== USER FORM END ===========================-->


        <!-- =====================LOG OUT=========================== -->
        <div id="div4" class="content-div" style="display: none;">
            <a class="logout-gif" href="https://yourlink.com" target="_blank">
                <iframe src="https://lottie.host/embed/a8e35add-6bd4-4e1a-83fe-8b0054b0e1e9/crKXr3yJMI.lottie"></iframe>
            </a>

            <h3 class="logout-title">Are you sure?</h3>
            <span class="logout-btns">
                <button class="yes-btn">Yes</button>
                <button class="no-btn">No</button>
            </span>
        </div>

        <!-- =========================  CAR TABLE ========================== -->
        <div id="div5" class="content-div" style="display: none;">
            <div class="small-container">
                <div class="table-container-adminCars">
                    <table class="table-adminCars">
                        <thead>
                            <tr>
                                <th>Car ID</th>
                                <th>Model</th>
                                <th>Make</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cars as $allCars): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($allCars['ID']); ?></td>
                                    <td><?php echo htmlspecialchars($allCars['model']); ?></td>
                                    <td><?php echo htmlspecialchars($allCars['make']); ?></td>
                                    <!-- <td>
                                       
                                        <form method="POST" action="admin.php" style="display:inline;">
                                          
                                            <input type="hidden" name="carID" value="<?php echo htmlspecialchars($allCars['ID']); ?>">

                                           
                                            <button type="button" name="addCar" id="addCar-btn" onclick="toggleDivs('div5','div7')">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </form>
                                    </td> -->


                                    <td> <!-- Edit Button -->
                                        <button type="button" name="editCar" id="editCar-btn" onclick="toggleDivs('div5','div7')">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>

                                    </td>

                                    <td> <!-- Delete Button -->
                                        <button type="submit" name="deleteCar" id="deleteCar-btn">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <!-- Hidden field for form action -->
                        <input type="hidden" name="action" id="carFormformAction" value="">
                        <div class="Car-CRUD_bigcontainer">
                            <p class="controlPanel_text">control panel</p>

                            <!-- Buttons -->
                            <div class="CRUD_control">
                                <div class="CRUDcontainer">
                                    <!-- add -->
                                    <button class="button" name="addUser" type="button" id="adduserButton"
                                        onclick="enableFormFields(); switchAddButtons(); toggleDivs('div5','div7');"    >
                                        <span class="button__text">Add Car</span>
                                        <span class="button__icon">
                                            <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i>
                                        </span>
                                    </button>

                                    <button style="display:none" class="button" name="addButton" type="submit"
                                        id="addButton" onclick="setActionCarForm('add')">
                                        <span class="button__text">Add user</span>
                                        <span class="button__icon">
                                            <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i>
                                        </span>
                                    </button>

                                    
                                </div>
                            </div>

                        </div>
                    </table>

                </div>
            </div>
        </div>




        <!-- =================== CAR FORM================== -->
        <div id="div7" class="content-div" style="display: none;">
            <div class="small-container">

                <div class="formContainer">
                    <form id="userForm" method="POST" action="admin.php" onsubmit="return validate(this)">

                        <div class="carFormInputfields">

                            <!-- Hidden Input -->
                            <input type="hidden" name="car_id" id="car_id" value="">


                            <!-- Image -->
                            <div>
                                <label class="formLabels" for="image">Image :</label>
                                <input class="carInputs" type="file" name="image" id="image" accept="image/*">
                                <span id="imageERR" class="error"></span>
                            </div>

                            <!-- Make -->
                            <div>
                                <label class="formLabels" for="make">Make :</label>
                                <input class="carInputs" type="text" name="make" id="make">
                                <span id="makeERR" class="error"></span>
                            </div>

                            <!-- Model -->
                            <div>
                                <label class="formLabels" for="model">Model :</label>
                                <input class="carInputs" type="text" name="model" id="model">
                                <span id="modelERR" class="error"></span>
                            </div>

                            <!-- Year (Select) -->
                            <div>
                                <label class="formLabels" for="year">Year :</label>
                                <select class="carInputs" name="year" id="year">
                                    <option value="">Select Year</option>
                                    <?php

                                    $currentYear = date("Y");
                                    $startYear = 2018;

                                    for ($year = $startYear; $year <= $currentYear; $year++) {
                                        echo "<option value='$year'>$year</option>";
                                    }
                                    ?>
                                </select>
                                <span id="yearERR" class="error"></span>
                            </div>

                            <!-- Price -->
                            <div>
                                <label class="formLabels" for="price">Price :</label>
                                <input class="carInputs" type="number" name="price" id="price">
                                <span id="priceERR" class="error"></span>
                            </div>

                            <!-- Type -->
                            <div>
                                <label class="formLabels" for="type">Type :</label>
                                <input class="carInputs" type="text" name="type" id="type">
                                <span id="typeERR" class="error"></span>
                            </div>

                            <!-- Persona (Select) -->
                            <div>
                                <label class="formLabels" for="persona">Persona :</label>
                                <select class="carInputs" name="persona" id="persona">
                                    <option value="">Select Persona</option>
                                    <option value="Tech Geek">Tech Geek</option>
                                    <option value="Performance Enthusiast">Performance Enthusiast</option>
                                    <option value="Classic Car Lover">Classic Car Lover</option>
                                    <option value="Family First">Family First</option>
                                    <option value="Luxury Seeker">Luxury Seeker</option>
                                    <option value="Budget Conscious">Budget Conscious</option>



                                </select>
                                <span id="personaERR" class="error"></span>
                            </div>


                            <!-- Horsepower -->
                            <div>
                                <label class="formLabels" for="horsePower">Horsepower :</label>
                                <input class="carInputs" type="number" name="horsePower" id="horsePower">
                                <span id="horsePowerERR" class="error"></span>
                            </div>

                            <!-- Doors (Select) -->
                            <div>
                                <label class="formLabels" for="doors">Doors :</label>
                                <select class="carInputs" name="doors" id="doors">
                                    <option value="">Select Doors</option>
                                    <option value="2">2</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <span id="doorsERR" class="error"></span>
                            </div>

                            <!-- Engine -->
                            <div>
                                <label class="formLabels" for="engine">Engine :</label>
                                <input class="carInputs" type="text" name="engine" id="engine">
                                <span id="engineERR" class="error"></span>
                            </div>

                            <!-- Cylinders -->
                            <div>
                                <label class="formLabels" for="cylinders">Cylinders:</label>
                                <select class="carInputs" id="cylinders" name="cylinders" required>
                                    <option value="" disabled selected>Select Cylinders</option>
                                    <option value="0">0 Cylinders</option>
                                    <option value="4">4 Cylinders</option>
                                    <option value="6">6 Cylinders</option>
                                    <option value="8">8 Cylinders</option>
                                    <option value="10">10 Cylinders</option>
                                </select>
                                <span id="cylindersERR" class="error"></span>
                            </div>

                            <!-- Torque -->
                            <div>
                                <label class="formLabels" for="torque">Torque :</label>
                                <input class="carInputs" type="number" name="torque" id="torque">
                                <span id="torqueERR" class="error"></span>
                            </div>

                            <div>
                                <label class="formLabels" for="fuelEfficiency">Fuel Efficiency :</label>

                                <input class="carInputs" type="number" name="fuelEfficiency" id="fuelEfficiency" value="50" step="0.1" min="0" required>

                                <span id="fuelEfficiencyERR" class="error"></span>
                            </div>



                            <!-- Fuel Type -->
                            <div>
                                <label class="formLabels" for="fuelType">Fuel Type :</label>
                                <select class="carInputs" name="fuelType" id="fuelType">
                                    <option value=""></option>
                                    <option value="Petrol">Petrol</option>
                                    <option value="Diesel">Gasoline</option>
                                    <option value="Electric">Electric</option>
                                </select>
                                <span id="fuelTypeERR" class="error"></span>
                            </div>

                            <!-- Transmission -->
                            <div>
                                <label class="formLabels" for="transmission">Transmission:</label>
                                <select class="carInputs" id="transmission" name="transmission" required>
                                    <option value="" disabled selected>Select Transmission</option>
                                    <option value="manual">Manual</option>
                                    <option value="automatic">Automatic</option>
                                    <option value="CVT">CVT (Continuously Variable Transmission)</option>
                                </select>
                                <span id="transmissionERR" class="error"></span>
                            </div>


                            <!-- Driven Wheels -->
                            <div>
                                <label class="formLabels" for="drivenWheels">Driven Wheels:</label>
                                <select class="carInputs" id="drivenWheels" name="drivenWheels" required>
                                    <option value="" disabled selected>Select Driven Wheels</option>
                                    <option value="front">Front-Wheel Drive (FWD)</option>
                                    <option value="rear">Rear-Wheel Drive (RWD)</option>
                                    <option value="all">All-Wheel Drive (AWD)</option>
                                    <option value="four">Four-Wheel Drive (4WD)</option>
                                </select>
                                <span id="drivenWheelsERR" class="error"></span>
                            </div>
                            <!-- Description -->
                            <div>
                                <label class="formLabels" for="description">Description :</label>
                                <textarea class="carInputs" name="description" id="description"></textarea>
                                <span id="descriptionERR" class="error"></span>
                            </div>
                            <button type="submit">Save Car</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- =======================REVIEWS PART========================= -->
        <div id="div6" class="content-div" style="display: none;">
            <div class="small-container">

                <div class="table-container-adminReview">
                    <table class="table-adminReview">

                        <thead>
                            <tr>
                                <th>Review ID</th>
                                <th>Review Content</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reviews as $review): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($review->reviewID); ?></td>
                                    <td><?php echo htmlspecialchars($review->reviewText); ?></td>
                                    <td><?php echo htmlspecialchars($review->reviewCategory); ?></td>
                                    <td><?php echo htmlspecialchars($review->reviewDate); ?></td>
                                    <td class="delete-icon-adminReview">
                                        <!-- <form method="POST" action="admin.php" style="display:inline;">
                                            <input type="hidden" name="reviewID"
                                                value="<?php echo htmlspecialchars($review->id); ?>">
                                            <input type="submit" value="" name="deleteReview" id="deleteReview-btn">
                                            <i class="fa-solid fa-trash-can" style="color: #edeff2;"></i>
                            
                                        </form> -->
                                        <form method="POST" action="admin.php" style="display:inline;">
                                            <input type="hidden" name="reviewID" value="<?php echo htmlspecialchars($review->reviewID); ?>">
                                            <button type="submit" name="deleteReview" id="deleteReview-btn">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="../../../public_html/js/admin.js"></script>

</body>

</html>