<?php
include_once __DIR__ . '/../app/config/db_config.php';
include_once __DIR__ . '/../controllers/SessionManager.php';

class Users
{
    public $id;
    public $username;
    public $birthdate;
    public $gender;
    public $password;
    public $email;
    public $userTypeID;
    public $loginMethod;
    public $personaID;
    public $loginCounter;
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
        $this->loginCounter = $loginCounter;
        $this->timeStamp = $timeStamp;
    }

    function setId($id)
    {
        $this->id = $id;
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
    static function getAllUsers()
    {
        global $conn;
        $sql = "SELECT * FROM User";
        $result = mysqli_query($conn, $sql);
        $users = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $user = new Users($row["userName"], $row["birthdate"], $row["gender"], $row["password"], $row["email"], $row["userTypeID"], $row["loginMethod"], $row["personaID"], $row["loginCounter"], $row["Timestamp"]);
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
            return true;
        }

        return false;
    }

    // Update user (prevent updating userTypeID)
    public static function updateUser($user_id, $username, $birthdate, $gender, $password, $email)
    {
        global $conn;

        // Prevent the userTypeID from being changed by the user
        $user_id = mysqli_real_escape_string($conn, htmlspecialchars($user_id));
        $username = mysqli_real_escape_string($conn, htmlspecialchars($username));
        $birthdate = mysqli_real_escape_string($conn, htmlspecialchars($birthdate));
        $password = mysqli_real_escape_string($conn, htmlspecialchars($password));
        $email = mysqli_real_escape_string($conn, htmlspecialchars($email));
        $gender = mysqli_real_escape_string($conn, htmlspecialchars($gender));

        // Update user data in the database (without modifying userTypeID)
        $sql = "UPDATE User 
                SET userName='$username', birthdate='$birthdate', gender='$gender', password='$password', email='$email' 
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
            $user = mysqli_fetch_assoc($sqlResult);

            // Check if the user logged in using Google
            if ($user['loginMethod'] === 'google') {
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

}