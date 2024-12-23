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
    global $conn;
    $controller = new FavoritesController($conn);

    // Safely retrieve POST data
    $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
    $carId = isset($_POST['carId']) ? $_POST['carId'] : null;
    $action = isset($_POST['action']) ? $_POST['action'] : null;

    // Validate inputs
    if (!$userId || !$carId || !$action) {
        echo json_encode(['success' => false, 'message' => 'Invalid input. Missing required fields.']);
        exit;
    }

    if ($action === 'add') {
        $response = $controller->addFavorite($carId, $userId);
        echo json_encode(['success' => true, 'message' => $response]);
    } elseif ($action === 'remove') {
        $response = $controller->removeFavorite($carId, $userId);
        echo json_encode(['success' => true, 'message' => $response]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    }
}
?>