<?php
include_once __DIR__ . '/../app/config/db_config.php';
include_once __DIR__ . '/../controllers/SessionManager.php';

class Users
{
    public $id;
    public $username; //
    public $birthdate; //
    public $gender; //
    public $password; //
    public $email; //
    public $userTypeID;
    public $loginMethod; //
    public $personaID; //
    public $loginCounter; //
    public $timeStamp;

    function __construct($username, $birthdate, $gender, $password, $email, $userTypeID, $loginMethod, $personaID, $loginCounter, $timeStamp)
    {
        $this->username = $username;
        $this->birthdate = $birthdate;
        $this->gender = $gender;
        $this->password = $password;
        $this->email = $email;
        $this->userTypeID = $userTypeID;
        $this->loginMethod = $loginMethod;
        $this->personaID = $personaID;
        $this->loginCounter = (int) $loginCounter;
        $this->timeStamp = $timeStamp;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    function getUsername()
    {
        return $this->username;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }

    function getBirthdate()
    {
        return $this->birthdate;
    }

    function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    function getGender()
    {
        return $this->gender;
    }

    function setGender($gender)
    {
        $this->gender = $gender;
    }

    function getPassword()
    {
        return $this->password;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function getUserTypeID()
    {
        return $this->userTypeID;
    }

    function setUserTypeID($userTypeID)
    {
        $this->userTypeID = $userTypeID;
    }

    function getLoginMethod()
    {
        return $this->loginMethod;
    }

    function setLoginMethod($loginMethod)
    {
        $this->loginMethod = $loginMethod;
    }

    function getPersonaID()
    {
        return $this->personaID;
    }

    function setPersonaID($personaID)
    {
        $this->personaID = $personaID;
    }

    function getLoginCounter()
    {
        return $this->loginCounter;
    }

    function setLoginCounter($loginCounter)
    {
        $this->loginCounter = $loginCounter;
    }

    function getTimeStamp()
    {
        return $this->timeStamp;
    }

    function setTimeStamp($timeStamp)
    {
        $this->timeStamp = $timeStamp;
    }


    // Check if userTypeID exists in the userType table
    private static function isValidUserType($userTypeID)
    {
        global $conn;
        $sql = "SELECT * FROM userType WHERE userTypeID = '$userTypeID'";
        $result = mysqli_query($conn, $sql);
        return mysqli_num_rows($result) > 0; // Returns true if userTypeID exists
    }

    // Fetch valid pages for a given userTypeID
    private static function getValidPagesForUserType($userTypeID)
    {
        global $conn;
        $sql = "SELECT pageID FROM userTypePages WHERE userTypeID = '$userTypeID'";
        $result = mysqli_query($conn, $sql);
        $pages = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($pages, $row["pageID"]);
            }
        }
        return $pages;
    }

    // Fetch all users from the database
    public static function getAllUsers()
    {
        global $conn;
        $sql = "SELECT * FROM User";
        $result = mysqli_query($conn, $sql);
        $users = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $user = new Users(
                    $row["userName"],
                    $row["birthdate"],
                    $row["gender"],
                    $row["password"],
                    $row["email"],
                    $row["userTypeID"],
                    $row["loginMethod"],
                    $row["personaID"],
                    $row["loginCounter"],
                    $row["Timestamp"]
                );
                $user->id = $row["ID"];
                array_push($users, $user);
            }
        }
        return $users;
    }

    // Fetch user by ID
    static function getUserById($id)
    {
        global $conn;
        $sql = "SELECT * FROM User WHERE ID = $id";
        $result = mysqli_query($conn, $sql);
        $user = null;
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user = new Users($row["userName"], $row["birthdate"], $row["gender"], $row["password"], $row["email"], $row["userTypeID"], $row["loginMethod"], $row["personaID"], $row["loginCounter"], $row["Timestamp"]);
            $user->id = $row["ID"];
        }
        return $user;
    }

    public static function viewAllUsers()
    {
        global $conn;  // Ensure the global $conn variable is accessible

        // SQL query to fetch all users
        $sql = "SELECT * FROM user";
        $result = mysqli_query($conn, $sql);  // Execute the query

        if (!$result) {
            // Return an error message if the query fails
            die("Error fetching users: " . mysqli_error($conn));
        }

        // Store the results in an array
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;  // Add each user to the $users array
        }

        return $users;  // Return the array of users
    }

    // Add a new user with userTypeID validation and associate valid pages
    public static function addUser($username, $birthdate, $gender, $password, $email, $userTypeID, $timeStamp, $loginMethod)
    {
        global $conn;

        // Validate if userTypeID exists in the userTypes table
        if (!self::isValidUserType($userTypeID)) {
            return "Invalid user type.";
        }

        // Sanitize inputs
        $username = mysqli_real_escape_string($conn, htmlspecialchars($username));
        $birthdate = mysqli_real_escape_string($conn, htmlspecialchars($birthdate));
        $password = mysqli_real_escape_string($conn, htmlspecialchars($password));
        $userTypeID = mysqli_real_escape_string($conn, htmlspecialchars($userTypeID));
        $email = mysqli_real_escape_string($conn, htmlspecialchars($email));
        $gender = mysqli_real_escape_string($conn, htmlspecialchars($gender));
        $loginMethod = mysqli_real_escape_string($conn, htmlspecialchars($loginMethod));
        $timeStamp = mysqli_real_escape_string($conn, htmlspecialchars($timeStamp));

        // Insert new user into the database, including timestamp and loginMethod
        $sql = "INSERT INTO User (userName, birthdate, gender, password, email, userTypeID, loginMethod, Timestamp) 
            VALUES ('$username', '$birthdate', '$gender', '$password', '$email', '$userTypeID', '$loginMethod', '$timeStamp')";

        if (mysqli_query($conn, $sql)) {
            // Get the last inserted user ID
            $userId = mysqli_insert_id($conn);
            $user = new Users($username, $birthdate, $gender, $password, $email, $userTypeID, $loginMethod, null, 0, $timeStamp);

            $user->setId($userId);

            // Initialize session
            SessionManager::startSession();
            SessionManager::setSessionUser($user);
            SessionManager::updateLoginCounter();

            return true;
        }

        return false;
    }


    //Method for admin to add users
    public static function addUserByAdmin($username, $password, $birthdate, $userType, $email, $gender)
    {
        global $conn;

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $birthdate = mysqli_real_escape_string($conn, $birthdate);
        $email = mysqli_real_escape_string($conn, $email);
        $gender = mysqli_real_escape_string($conn, $gender);

        $userTypeID = ($userType === 'admin') ? 2 : 1;  //  'admin' = 2 and 'user' = 1

        $sql = "INSERT INTO `user` (`userName`, `birthdate`, `gender`, `password`, `email`, `userTypeID`)
                VALUES ('$username', '$birthdate', '$gender', '$password', '$email', $userTypeID)";

        $result = mysqli_query($conn, $sql);

        return $result;
    }


    // Update user
    public static function updateUser($user_id, $username, $birthdate, $gender, $password, $email, $userType)
    {
        global $conn;

        // Prevent the userTypeID from being changed by the user
        $user_id = mysqli_real_escape_string($conn, htmlspecialchars($user_id));
        $username = mysqli_real_escape_string($conn, htmlspecialchars($username));
        $birthdate = mysqli_real_escape_string($conn, htmlspecialchars($birthdate));
        $password = mysqli_real_escape_string($conn, htmlspecialchars($password));
        $email = mysqli_real_escape_string($conn, htmlspecialchars($email));
        $gender = mysqli_real_escape_string($conn, htmlspecialchars($gender));
        $userType = mysqli_real_escape_string($conn, htmlspecialchars($userType));


        $userTypeID = ($userType === 'admin') ? 2 : 1;
        // Update user data in the database 
        $sql = "UPDATE User 
                SET userName='$username', birthdate='$birthdate', gender='$gender', password='$password', email='$email' , userTypeID='$userTypeID' 
                WHERE ID='$user_id'";
        return mysqli_query($conn, $sql);
    }

    // Delete a user and handle foreign key constraints
    public static function deleteUser($user_id)
    {
        global $conn;

        // Ensure cascading deletes or handle userPages deletion (if needed)
        $user_id = mysqli_real_escape_string($conn, htmlspecialchars($user_id));
        $sql = "DELETE FROM User WHERE ID='$user_id'";
        return mysqli_query($conn, $sql);
    }



    // Login user
    static function loginUser($username, $password)
    {
        global $conn;
        $sql = "SELECT * FROM user WHERE userName = '$username'";
        $result = mysqli_query($conn, $sql);
        $user = null;

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if ($password === $row["password"]) { // Use proper password hashing in production!
                $user = new Users($row["userName"], $row["birthdate"], $row["gender"], $row["password"], $row["email"], $row["userTypeID"], $row["loginMethod"], $row["personaID"], $row["loginCounter"], $row["Timestamp"]);
                $user->id = $row["ID"];

                // Initialize session
                SessionManager::startSession();
                SessionManager::setSessionUser($user);
                SessionManager::updateLoginCounter();

                return $user;
            } else {
                return "Incorrect password.";
            }
        } else {
            return "User does not exist.";
        }


    }

    static function signUpUser($username, $birthdate, $gender, $password, $email, $userType, $timeStamp, $loginMethod)
    {
        global $conn;

        // Check if username already exists
        $sqlUsername = "SELECT * FROM user WHERE username = '$username'";
        $resultUsername = mysqli_query($conn, $sqlUsername);

        // Check if email already exists
        $sqlEmail = "SELECT * FROM user WHERE email = '$email'";
        $resultEmail = mysqli_query($conn, $sqlEmail);

        $errors = ['name' => '', 'email' => ''];

        if (mysqli_num_rows($resultUsername) > 0) {
            $errors['name'] = "Username already exists.";
        }
        if (mysqli_num_rows($resultEmail) > 0) {
            $errors['email'] = "Email already exists.";
        }

        // If there are any errors, return the errors array
        if (!empty($errors['name']) || !empty($errors['email'])) {
            return $errors;
        }

        // If no errors, proceed to create the user
        return self::addUser($username, $birthdate, $gender, $password, $email, $userType, $timeStamp, $loginMethod);
    }


    static function addUserIntoDBGoogle($name, $email, $gender, $timeStamp)
    {
        global $conn;

        // Check if the user already exists in the database
        $sqlEmail = "SELECT * FROM user WHERE email = '$email'";
        $resultEmail = mysqli_query($conn, $sqlEmail);

        if (mysqli_num_rows($resultEmail) > 0) {
            $user = mysqli_fetch_assoc($resultEmail);

            // Check if the user has logged in with Google before
            if ($user['loginMethod'] == 'google') {
                // Allow the user to log in normally
                return [
                    'status' => true,
                    'message' => "User logged in successfully.",
                    'user' => $user
                ];
            } else {
                // User has a different login method
                return [
                    'status' => false,
                    'message' => "User already exists. Please log in with your username and password."
                ];
            }
        }

        $userTypeID = 1; // Default to registered user
        $loginMethod = 'google';

        // Insert the new user into the database, including the timestamp and loginMethod
        $sqlInsert = "INSERT INTO user (userName, email, gender, userTypeID, loginMethod, Timestamp) 
                  VALUES ('$name', '$email', '$gender', '$userTypeID', '$loginMethod', '$timeStamp')";

        if (mysqli_query($conn, $sqlInsert)) {
            // Get the last inserted user ID
            $userId = mysqli_insert_id($conn);

            // Fetch the newly inserted user
            $sqlFindUser = "SELECT * FROM user WHERE ID = '$userId'";
            $result = mysqli_query($conn, $sqlFindUser);
            $user = mysqli_fetch_assoc($result);

            return [
                'status' => true,
                'message' => "User created and logged in successfully.",
                'user' => $user // Return user object
            ];
        } else {
            return [
                'status' => false,
                'message' => "Error: " . mysqli_error($conn)
            ];
        }
    }


    static function loginUserGoogle($name, $email, $gender)
    {
        global $conn;

        // Check if the user exists with the provided email
        $sqlFindUserWithEmail = "SELECT * FROM user WHERE email='$email'";
        $sqlResult = mysqli_query($conn, $sqlFindUserWithEmail);

        if (mysqli_num_rows($sqlResult) === 0) {
            // User doesn't exist, so create a new user using the Google login method
            return self::addUserIntoDBGoogle($name, $email, $gender, date("Y-m-d H:i:s"));
        } else {
            $result = mysqli_fetch_assoc($sqlResult);

            $user = new Users($result["userName"], $result["birthdate"], $result["gender"], $result["password"], $result["email"], $result["userTypeID"], $result["loginMethod"], $result["personaID"], $result["loginCounter"], $result["Timestamp"]);
            $user->id = $result["ID"];
            // Check if the user logged in using Google
            if ($user->loginMethod === 'google') {
                // Return user object if the login method is Google
                return [
                    'status' => true,
                    'message' => "User logged in successfully.",
                    'user' => $user // Return user object
                ];
            } else {
                // The user has registered with a different login method
                return [
                    'status' => false,
                    'message' => "User already exists. Please log in with your username and password."
                ];
            }
        }
    }




    // public static function getLoginStatistics() {
    //     global $conn;  // Assuming a global database connection

    //     $sql = "SELECT userName, loginCounter FROM user";  // Adjust table/column names as needed
    //     $result = $conn->query($sql);

    //     // Initialize arrays to store the data
    //     $userNames = [];
    //     $loginCounters = [];

    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $userNames[] = $row['userName'];  // Fetch the user name
    //             $loginCounters[] = $row['loginCounter'];  // Fetch the login counter value
    //         }
    //     } else {
    //         echo "No login statistics found";
    //     }

    //     // Return the data as an associative array
    //     return ['userNames' => $userNames, 'loginCounters' => $loginCounters];
    // }

    //Persona Statistics
    public static function getPersonas()
    {
        global $conn;
        $sql = "SELECT personaName, personaCounter FROM persona";
        $result = $conn->query($sql);
        $personaNames = [];
        $personaCounters = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $personaNames[] = $row['personaName'];
                $personaCounters[] = $row['personaCounter'];
            }
        } else {
            echo "No data found";
        }

        return ['personaNames' => $personaNames, 'personaCounters' => $personaCounters];
    }


    //Login Statistics
    public static function getLoginStatistics()
    {
        global $conn;

        // Query to calculate login statistics grouped by month and year
        $query = "
                SELECT 
                    DATE_FORMAT(Timestamp, '%b %Y') AS formattedMonth, -- Abbreviated month name (e.g., Jan 2024)
                    SUM(loginCounter) AS totalLogins                  -- Sum of loginCounter for each month
                FROM 
                    user                                              -- Replace with your actual table name
                GROUP BY 
                    YEAR(Timestamp), MONTH(Timestamp)                 -- Group by year and month
                ORDER BY 
                    MIN(Timestamp) ASC                                -- Sort by earliest date in each group
            ";

        // Execute the query
        $queryResult = $conn->query($query);

        // Initialize arrays to store formatted months and login counts
        $formattedMonths = [];
        $totalLoginCounts = [];

        if ($queryResult) { // Check if query execution was successful
            if ($queryResult->num_rows > 0) {
                while ($dataRow = $queryResult->fetch_assoc()) {
                    $formattedMonths[] = $dataRow['formattedMonth'];      // Add formatted month to the array
                    $totalLoginCounts[] = $dataRow['totalLogins'];        // Add total logins to the array
                }
            } else {
                // No data found, return empty arrays
                return ['formattedMonths' => [], 'totalLoginCounts' => []];
            }
        } else {
            // If the query fails, log or handle the error (optional)
            error_log("SQL Error: " . $conn->error);
            return ['formattedMonths' => [], 'totalLoginCounts' => []];
        }

        // Return the arrays with formatted months and total login counts
        return ['formattedMonths' => $formattedMonths, 'totalLoginCounts' => $totalLoginCounts];
    }


    //Favourites Statistics
    public static function getFavoriteStatistics()
    {
        global $conn;

        $sql = "
                    SELECT 
                        marketCategory,                    
                        SUM(FavoritedCount) AS totalFavorites
                    FROM 
                        cars                              
                    GROUP BY 
                        marketCategory                          
                    ORDER BY 
                        marketCategory ASC";

        $result = $conn->query($sql);
        $categories = [];
        $favorites = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row['marketCategory'];
                $favorites[] = $row['totalFavorites'];
            }
        } else {

            return ['categories' => [], 'favorites' => []];
        }

        return ['categories' => $categories, 'favorites' => $favorites];
    }


    //Posts Statstics
    public static function getPostsCountByMonth()
    {

        global $conn;

        $sql = "
                    SELECT 
                        DATE_FORMAT(Timestamp, '%b %Y') AS month, 
                        COUNT(*) AS postCount 
                    FROM 
                        post  
                    GROUP BY 
                        month  
                    ORDER BY 
                        MIN(Timestamp) ASC";


        $result = $conn->query($sql);


        $months = [];
        $postCounts = [];

        if ($result && $result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $months[] = $row['month'];
                $postCounts[] = $row['postCount'];
            }
        } else {

            echo "No data found.";
        }


        return [
            'months' => $months,
            'postCounts' => $postCounts,
        ];
    }

    // Recommendation Statistics
    public static function getRecommendationStatistics()
    {
        global $conn;

        // SQL query to get the market categories and their respective recommendation counts
        $sql = "
        SELECT 
            marketCategory,                    
            SUM(RecommendationCount) AS totalRecommendations
        FROM 
            cars                              
        GROUP BY 
            marketCategory                           
        ORDER BY 
            marketCategory ASC";

        $result = $conn->query($sql);

        // Arrays to store categories and their total recommendations
        $categories = [];
        $recommendations = [];

        // Check if there are any results, then store them in the arrays
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row['marketCategory'];
                $recommendations[] = $row['totalRecommendations'];
            }
        } else {
            // Return categories and their recommendation counts
            return ['categories' => $categories, 'recommendations' => $recommendations];
        }
        return ['categories' => $categories, 'recommendations' => $recommendations];
    }


    //Reviews Statistics
    public static function getReviewsStatistics()
    {
        global $conn;

        $sql = "
            SELECT 
                reviewCategory, 
                COUNT(*) AS reviewCount 
            FROM 
                reviews 
            GROUP BY 
                reviewCategory 
            ORDER BY 
                reviewCategory ASC
        ";

        $result = $conn->query($sql);

        $reviewCategories = [];
        $reviewCategoryCounts = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Use the correct column name from the SQL query
                $reviewCategories[] = $row['reviewCategory'];
                $reviewCategoryCounts[] = $row['reviewCount'];
            }
        }

        return ['reviewCategories' => $reviewCategories, 'reviewCategoryCounts' => $reviewCategoryCounts];
    }
}
