<?php
include_once __DIR__ . '/../models/Favorites.php';

class FavoritesController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new Favorites($db);
    }

    public function fetchFavorites($userID)
    {
        return $this->model->getFavoritesByUser($userID);
    }

    public function addFavorite($carID, $userID)
    {
        return $this->model->createFavorite($carID, $userID);
    }

    public function removeFavorite($favoriteID)
    {
        return $this->model->deleteFavorite($favoriteID);
    }
}
