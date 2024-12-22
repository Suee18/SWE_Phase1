<?php

include_once "../../config/db_config.php";
include_once __DIR__ . '../../models/UsersClass.php';


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
