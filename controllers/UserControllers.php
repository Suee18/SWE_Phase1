<?php
include_once "../../config/db_config.php";
include_once __DIR__ . '../../models/UsersClass.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? 'read';

    switch ($action) {
        case 'add-user':
            $username = $_POST['username'];
            $birthdate = $_POST['age'];
            $password = $_POST['password'];
            $userType = $_POST['user_type'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            UserController::addNewUserCtrl($username, $password, $birthdate, $userType, $email, $gender);
            break;
        case 'update-user':
            $user_id = $_POST['user_id'];
            $username = $_POST['username'];
            $birthdate = $_POST['age'];
            $password = $_POST['password'];
            $userType = $_POST['user_type'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            UserController::updateUserCtrl($user_id, $username, $birthdate, $gender, $password, $email, $userType);
            break;
        case 'delete-user':
            $user_id = $_POST['user_id'];
            UserController::deleteUserCtrl($user_id);
            break;
    }
    
    header('Location: admin.php');
}

class UserController
{

    public static function addNewUserCtrl($username, $password, $birthdate, $userType, $email, $gender)
    {
        Users::addUserByAdmin($username, $password, $birthdate, $userType, $email, $gender);
    }

    public static function updateUserCtrl($user_id, $username, $birthdate, $gender, $password, $email, $userType)
    {
        Users::updateUser($user_id, $username, $birthdate, $gender, $password, $email, $userType);
    }

    public static function deleteUserCtrl($user_id)
    {
        Users::deleteUser($user_id);
    }

    public static function viewAllUsers()
    {
        return Users::viewAllUsers();
    }

    public static function getPersonas()
    {
        return Users::getPersonas();
    }

    public static function getLoginStatistics()
    {
        return Users::getLoginStatistics();
    }

    public static function getFavouritesStat()
    {
        return Users::getFavoriteStatistics();
    }

    public static function getPostsCountByMonth()
    {
        return Users::getPostsCountByMonth();
    }

    public static function getRecommendationCounts()
    {
        return Users::getRecommendationStatistics();
    }

    public static function getReviewsStatistics()
    {
        return Users::getReviewsStatistics();
    }
}
