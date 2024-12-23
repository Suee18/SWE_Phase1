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
        return $this->model->createFavorite($carID, $userID);
    }

    public function removeFavorite($carID, $userID)
    {
        return $this->model->deleteFavorite($carID, $userID);
    }

    public function fetchFavoriteCars($userID)
    {
        return $this->model->fetchFavoriteCars($userID);
    }

    public function checkIfFavoriteExists($carID, $userID)
    {
        return $this->model->checkIfFavoriteExists($carID, $userID);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'apexnew'); 
    $controller = new FavoritesController($conn);

    $userId = $_POST['userId'];
    $carId = $_POST['carId'];
    $action = $_POST['action'];

    if ($action === 'add') {
        $response = $controller->addFavorite($carId, $userId);
        echo json_encode(['success' => true, 'message' => $response]);
    } elseif ($action === 'remove') {
        $response = $controller->removeFavorite($carId, $userId);
        echo json_encode(['success' => true, 'message' => $response]);
    }
}
?>
