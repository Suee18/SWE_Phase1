<?php
include_once __DIR__ . '/../models/favoriteClass.php';

class FavoritesController
{
    private $model;

    public function __construct($conn)
    {
        $this->model = new FavoritesModel($conn);
    }

    public function fetchFavorites($userID)
    {
        return $this->model->getFavoritesByUser($userID);
    }

    public function addFavorite($carID, $userID)
    {
        $favorite = new Favorites($carID, $userID);
        return $this->model->createFavorite($favorite);
    }

    public function removeFavorite($favoriteID)
    {
        return $this->model->deleteFavorite($favoriteID);
    }

    public function fetchFavoriteCars($userID)
    {
        return $this->model->fetchFavoriteCars($userID);
    }
}
