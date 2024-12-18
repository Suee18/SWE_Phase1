<?php

require_once __DIR__ . '/../app/config/db_config.php';

class SessionManager
{
    static $isSessionActive = false;

    public function __construct()
    {
        session_start();
    }

    public static function startSession()
    {
        
        // Start the session only if it hasn't already started
        if (!self::$isSessionActive) {
            self::$isSessionActive = true;
            new SessionManager();
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
        self::$isSessionActive = false;
    }

    public static function isSessionActive()
    {
        return self::$isSessionActive;
    }

    public static function getUser()
    {
        return $_SESSION['user'] ?? null;
    }


    public static function updateLoginCounter()
    {

        $user = self::getUser();     
        
        if ($user == null) {
            return false;
        }

        $user->loginCounter += 1;
        
        global $conn;
        $sql = "UPDATE user SET loginCounter = ". $user->loginCounter ." WHERE ID = " . $user->id; 
        echo $sql;
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    public static function updatePersonaID($topPersonaID)
    {
        $user = self::getUser(); 
    
        if ($user == null) {
            return false;
        }
    
        // Update personaID in the session
        $_SESSION['personaID'] = $topPersonaID;
    
        global $conn;
        $sql = "UPDATE user SET personaID = " . (int)$topPersonaID . " WHERE ID = " . (int)$user->id;
        $result = mysqli_query($conn, $sql);
    
        return $result;
    }


}