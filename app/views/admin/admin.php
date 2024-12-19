<?php

include_once "../../config/db_config.php";
include '../../../models/UsersClass.php';
include '../../../models/ReviewsClass.php';
include_once __DIR__ . '\..\..\..\controllers\SessionManager.php';
include_once __DIR__ . '\..\..\..\middleware\user_auth.php';

user_auth("Admin Dashboard");


$users = [];
$sql = "select id, username,birthdate, gender, password, email,userTypeID FROM user";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row; // Store each user in the $users array
    }
} else {
    echo "Error fetching users: " . mysqli_error($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? 'read';

    switch ($action) {
        case 'add':
            // include 'add_user.php';
            $username = $_POST['username'];
            $birthdate = $_POST['age'];
            $password = $_POST['password'];
            $userType = $_POST['user_type'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            Users::addUser($username, $birthdate, $gender, $password, $email, $userType);
            break;
        case 'update':
            $user_id = $_POST['user_id'];
            $username = $_POST['username'];
            $birthdate = $_POST['age'];
            $password = $_POST['password'];
            $userType = $_POST['user_type'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            Users::updateUser($user_id, $username, $birthdate, $gender, $password, $email, $userType);
            break;
        case 'delete':
            $user_id = $_POST['user_id'];
            Users::deleteUser($user_id);
            break;
    }
}

$reviews = Reviews::getAllReviews();

if (isset($_POST['deleteReview'])) {
    $reviewID = $_POST['reviewID'];

    if (Reviews::deleteReviewFromDB($reviewID)) {
        header("Location: admin.php");
    } else {
        echo "<alert>Error deleting review</alert>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public_html/css/admin.css">
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
                    <p class="stat-title"> Turbo Conversations</p>
                    <canvas id="conversationsChart" width="400" height="200"></canvas>
                </div>
                <div id="div1" class="stats-div">
                    <p class="stat-title">Generated Plans</p>
                    <canvas id="plansChart" width="400" height="200"></canvas>
                </div>

                <div id="div1" class="stats-div">
                    <p class="stat-title">Website Views</p class="stat-title">
                    <canvas id="viewsChart" width="400" height="200"></canvas>

                </div>
                <div id="div1" class="stats-div">
                    <p class="stat-title"> Average Session Duration (Minutes)</p>
                    <canvas id="sessionDurationChart" width="400" height="200"></canvas>
                </div>

                <div id="div1" class="stats-div">
                    <p>
                    <p class="stat-title"> Registered Users per Month
                    <p>
                        <canvas id="usersChart" width="400" height="200"></canvas>
                    </p>
                </div>

                <div id="div1" class="stats-div">
                    <p>
                    <p class="stat-title"> Generated Personas</p>
                    <canvas id="personasChart" width="400" height="200"></canvas></p>
                </div>
                <div id="div1" class="stats-div">
                    <p>Most recommended car this month</p>
                    <!--waiting on dynamic car car -->
                </div>
            </div>
        </div> <!--======================= statistics end =================================-->


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
                                <label class="userformLabels" for="userSelect">Select User:</label>
                                <select id="userSelect" name="user_id" onchange="populateForm()">
                                    <option value="" disabled selected>Select a user</option>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?php echo $user['id']; ?>"
                                            data-username="<?php echo htmlspecialchars($user['username']); ?>"
                                            data-age="<?php echo htmlspecialchars($user['birthdate']); ?>"
                                            data-gender="<?php echo htmlspecialchars($user['gender']); ?>"
                                            data-email="<?php echo htmlspecialchars($user['email']); ?>"
                                            data-password="<?php echo htmlspecialchars($user['password']); ?>"
                                            data-type="<?php echo htmlspecialchars($user['type']); ?>">
                                            <?php echo htmlspecialchars($user['username']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- hidden input to get the user id from DB -->
                            <input type="hidden" name="user_id" id="user_id" value="">
                            <div>
                                <label class="userformLabels" for="username">Username :</label>
                                <input type="text" name="username" id="username" readonly disabled>
                                <span id="usernameERR" class="error"></span>
                            </div>

                            <div>
                                <label class="userformLabels" for="email">e-mail :</label>
                                <input type="email" name="email" id="email" readonly disabled>
                                <span id="emailERR" class="error"></span>
                            </div>

                            <div>
                                <label class="userformLabels" for="password">Password :</label>
                                <input type="password" name="password" id="password" readonly disabled>
                                <span id="passERR" class="error"></span>
                            </div>


                            <label class="userformLabels" for="age">Date of Birth:</label>
                            <input type="date" id="age" name="age" disabled>
                            <span id="birthDateERR" class="error"></span>
                            <div>



                                <label class="userformLabels" for="gender">Gender :</label>
                                <select id="gender" name="gender" disabled>
                                    <option value=""></option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span id="genderERR" class="error"></span>
                            </div>



                            <div>
                                <label class="userformLabels" for="user_type">User Type :</label>
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
        
        <div id="div5" class="content-div" style="display: none;">
            cars control form goes here
        </div>


        <div id="div6" class="content-div" style="display: none;">
            <div class="small-container">

                <div class="table-container-adminReview">
                    <table class="table-adminReview">

                        <thead>
                            <tr>
                                <th>Review ID</th>
                                <th>Username</th>
                                <th>Review Content</th>
                                <th>Date</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reviews as $review): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($review->id); ?></td>
                                    <td><?php echo htmlspecialchars($review->reviewUserName); ?></td>
                                    <td><?php echo htmlspecialchars($review->reviewText); ?></td>
                                    <td><?php echo htmlspecialchars($review->reviewDate); ?></td>
                                    <td class="delete-icon-adminReview">
                                        <!-- <form method="POST" action="admin.php" style="display:inline;">
                                            <input type="hidden" name="reviewID"
                                                value="<?php echo htmlspecialchars($review->id); ?>">
                                            <input type="submit" value="" name="deleteReview" id="deleteReview-btn">
                                            <i class="fa-solid fa-trash-can" style="color: #edeff2;"></i>
                            
                                        </form> -->
                                        <form method="POST" action="admin.php" style="display:inline;">
                                            <input type="hidden" name="reviewID" value="<?php echo htmlspecialchars($review->id); ?>">
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