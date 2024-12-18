<?php
require_once __DIR__ . '/../app/config/db_config.php';
require_once __DIR__ . '/../controllers/SessionManager.php';

SessionManager::startSession();

function user_auth($pageName){
    global $conn;

    if (!SessionManager::isSessionActive()) {
        redirect_to_403();
    }
    

    $userTypeID = $_SESSION['userTypeID'];
    
    // SQL query to check if the userTypeID has access to the given page
    $sql = "SELECT COUNT(*) AS count 
            FROM userTypePages utp
            JOIN pages p ON utp.pageID = p.pageID
            WHERE utp.userTypeID = '$userTypeID' AND p.pageName = '$pageName'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);

    // Redirect to error page if no access
    if ($row['count'] == 0) {
        redirect_to_403();
    }
}

function redirect_to_403()
{
    header("Location: ../../../app/views/errors/error403.php");
    exit();
}