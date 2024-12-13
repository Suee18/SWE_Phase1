<?php

require_once __DIR__ . '/../app/config/db_config.php';

class SessionManager
{
    public static function startSession()
    {
        // Start the session only if it hasn't already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Initialize default userType as Guest if no session exists
        if (!isset($_SESSION['userTypeID'])) {
            $_SESSION['userTypeID'] = 3; // Default to Guest user type
        }
    }

    public static function setSessionUser($user)
    {
        // Store user details in the session
        $_SESSION['user'] = $user;
        $_SESSION['userTypeID'] = $user->userTypeID; // Set userTypeID from user object
    }

    public static function destroySession()
    {
        session_unset();
        session_destroy();
    }

    public static function isSessionActive()
    {
        return isset($_SESSION['user']);
    }

    public static function getUser()
    {
        return $_SESSION['user'] ?? null;
    }


    public static function updateLoginCounter()
    {
        $_SESSION['user']->loginCounter += 1;

        global $conn;
        $sql = "UPDATE user SET loginCounter = loginCounter + 1 WHERE ID = " . $_SESSION['user']->id;
        $result = mysqli_query($conn, $sql);
        return $result;
    }
}