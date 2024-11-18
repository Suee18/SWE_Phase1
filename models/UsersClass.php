<?php
include_once 'C:\xampp\htdocs\SWE Project\SWE_Phase1\app\config\db_config.php';

class Users
{
    public $id;

    public $username;

    public $birthdate;

    public $gender;

    public $password;

    public $email;

    public $userType;

    public $timeStamp;

    function __construct($username, $birthdate, $gender, $password, $email, $userType, $timeStamp)
    {
        $this->username = $username;
        $this->birthdate = $birthdate;
        $this->gender = $gender;
        $this->password = $password;
        $this->email = $email;
        $this->userType = $userType;
        $this->timeStamp = $timeStamp;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    static function getAllUsers()
    {
        global $conn;
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        $users = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $user = new Users($row["username"], $row["birthdate"], $row["gender"], $row["password"], $row["email"], $row["type"], $row["timeStamp"]);
                $user->id = $row["ID"];
                array_push($users, $user);
            }
        }

        return $users;
    }

    static function getUserById($id)
    {
        global $conn;
        $sql = "SELECT * FROM users WHERE ID = $id";
        $result = mysqli_query($conn, $sql);
        $user = null;
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user = new Users($row["username"], $row["birthdate"], $row["gender"], $row["password"], $row["email"], $row["type"], $row["timeStamp"]);
            $user->id = $row["ID"];
        } else {
            $user = null;
        }
        return $user;
    }

    static function getUserByUsername($username)
    {
        global $conn;
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $user = null;
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user = new Users($row["username"], $row["birthdate"], $row["gender"], $row["password"], $row["email"], $row["type"], $row["timeStamp"]);
            $user->id = $row["ID"];
        } else {
            $user = null;
        }
    }


    // function addUserIntoDB($user)
    // {
    //     global $conn;
    //     $sql = "INSERT INTO users (username, birthdate, gender, password, email, type, timeStamp) 
    //         VALUES ('$user->username', '$user->birthdate', '$user->gender', '$user->password', '$user->email', '$user->userType', '$user->timeStamp')";

    //     $result = mysqli_query($conn, $sql);
    //     return $result;
    // }


    public static function addUser($username, $birthdate, $gender, $password, $email, $userType)
    {
        global $conn;
        $username = mysqli_real_escape_string($conn, htmlspecialchars($username));
        $birthdate = mysqli_real_escape_string($conn, htmlspecialchars($birthdate));
        $password = mysqli_real_escape_string($conn, htmlspecialchars($password));
        $userType = mysqli_real_escape_string($conn, htmlspecialchars($userType));
        $email = mysqli_real_escape_string($conn, htmlspecialchars($email));
        $gender = mysqli_real_escape_string($conn, htmlspecialchars($gender));

        $sql = "INSERT INTO users (username, birthdate, gender, password, email, type) 
                VALUES ('$username', '$birthdate', '$gender', '$password', '$email', '$userType')";
        return mysqli_query($conn, $sql);
    }

    public static function updateUser($user_id, $username, $birthdate, $gender, $password, $email, $userType)
    {
        global $conn;
        $user_id = mysqli_real_escape_string($conn, htmlspecialchars($user_id));
        $username = mysqli_real_escape_string($conn, htmlspecialchars($username));
        $birthdate = mysqli_real_escape_string($conn, htmlspecialchars($birthdate));
        $password = mysqli_real_escape_string($conn, htmlspecialchars($password));
        $userType = mysqli_real_escape_string($conn, htmlspecialchars($userType));
        $email = mysqli_real_escape_string($conn, htmlspecialchars($email));
        $gender = mysqli_real_escape_string($conn, htmlspecialchars($gender));

        $sql = "UPDATE users 
                SET username='$username', birthdate='$birthdate', gender='$gender', password='$password', email='$email', type='$userType' 
                WHERE id='$user_id'";
        return mysqli_query($conn, $sql);
    }

    // function deleteUserFromDB($userId)
    // {
    //     global $conn;
    //     $sql = "DELETE FROM users WHERE id = '$userId'";
    //     $result = mysqli_query($conn, $sql);
    //     return $result;
    // }

    public static function deleteUser($user_id)
    {
        global $conn;
        $user_id = mysqli_real_escape_string($conn, htmlspecialchars($user_id));
        $sql = "DELETE FROM users WHERE id='$user_id'";
        return mysqli_query($conn, $sql);
    }
    static function loginUser($username, $password)
    {
        global $conn;
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $user = null;
    
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
    
            if ($password === $row["password"]) { // Use proper password hashing in production!
                $user = new Users($row["username"], $row["birthdate"], $row["gender"], $row["password"], $row["email"], $row["type"], $row["timeStamp"]);
                $user->id = $row["ID"];
            } else {
                return "Incorrect password.";
            }
        } else {
            return "User does not exist.";
        }
    
        return $user;
    }

    static function signUpUser($username, $birthdate, $gender, $password, $email, $userType, $timeStamp)
    {
        global $conn;

        // Check if username already exists
        $sqlUsername = "SELECT * FROM users WHERE username = '$username'";
        $resultUsername = mysqli_query($conn, $sqlUsername);

        // Check if email already exists
        $sqlEmail = "SELECT * FROM users WHERE email = '$email'";
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
        return self::addUser($username, $birthdate, $gender, $password, $email, $userType);
    }

}