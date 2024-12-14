<?php
include_once __DIR__ . '/../controllers/SessionManager.php';
include_once __DIR__ . '/../app/config/db_config.php';
require_once __DIR__ . '/../models/UsersClass.php';
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../env_loader.php';

// Initialize Google Client
$client = new Google\Client;
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);

if (isset($_GET['code'])) {
    // Fetch the access token
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token["access_token"]);
    
    // Get user information
    $oauth = new Google\Service\Oauth2($client);
    $user = $oauth->userinfo->get();

    $email = $user->email;
    $name = $user->name;
    $gender = $user->gender;

    // Check if the user exists and log them in or sign them up
    // If user exists, perform login; otherwise, perform signup
    $response = Users::loginUserGoogle($name, $email, $gender);

    if ($response['status'] === true) {

        $user = $response['user'];

        SessionManager::startSession();
        SessionManager::setSessionUser($user);
        SessionManager::updateLoginCounter();
        
        // User exists, perform login
        header("Location: index.php");  // Redirect to the home page or dashboard
        exit;
    } else {
        // User does not exist, perform signup
        $response = Users::addUserIntoDBGoogle($name, $email, $gender, date("Y-m-d H:i:s"));
        
        if ($response) {
            // User was successfully signed up
            $user = $response['user'];
            

            SessionManager::startSession();
            SessionManager::setSessionUser($user);
            SessionManager::updateLoginCounter();
            
            // Redirect to the home page or dashboard after successful signup
            header("Location: index.php");
            exit;
        } else {
            // If there was an issue with the signup, redirect to the login page
            
            // Salma's path
            // header('Location: /../zUiedits/SWE_Phase1/app/views/auth/login.php');
          
            // Omneya's Path
            // header('Location: /../SWE_Phase1/app/views/auth/login.php');
            header('Location: /../SWE_Project/SWE_Phase1/app/views/auth/login.php');
            exit;
        }
    }
} else {
    // If no authorization code is provided, redirect to the login page
      // Salma's path  
    //header('Location: /../zUiedits/SWE_Phase1/app/views/auth/login.php');
  
  // Omneya's Path
            // header('Location: /../SWE_Phase1/app/views/auth/login.php');
    header('Location: /../SWE_Project/SWE_Phase1/app/views/auth/login.php');
    exit;
}
