<?php
require_once __DIR__ . '/../app/config/db_config.php';

class Favorites
{
    public $favoriteID;
    public $carID;
    public $userID;

    public function __construct($carID, $userID)
    {
        $this->carID = $carID;
        $this->userID = $userID;
    }
    function getFavoriteID()
    {
        return $this->favoriteID;
    }
}

class FavoritesModel
{
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function createFavorite($carID, $userID)
    {
        $query = "INSERT INTO favorites (carID, userID) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $carID, $userID);
        if ($stmt->execute()) {
            return "Favorite added successfully!";
        } else {
            return "Failed to add favorite.";
        }
    }
    public function deleteFavorite($carID, $userID)
    {
        $query = "DELETE FROM favorites WHERE carID = ? AND userID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $carID, $userID);
        if ($stmt->execute()) {
            return "Favorite deleted successfully!";
        } else {
            return "Failed to delete favorite.";
        }
    }
    public function getFavoritesByUser($userID)
    {
        $query = "SELECT * FROM favorites WHERE userID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getAllFavorites()
    {
        $query = "SELECT * FROM favorites";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function fetchFavoriteCars($userID)
    {
        $query = "
            SELECT c.id, c.image, c.make, c.model, c.year, c.price, c.type, c.persona, 
                   c.engine, c.horsePower, c.doors, c.torque, c.topSpeed, c.acceleration, 
                   c.fuelEfficiency, c.fuelType, c.cylinders, c.transmission, c.drivenWheels, 
                   c.marketCategory, c.description
            FROM favorites f
            INNER JOIN cars c ON f.carID = c.id
            WHERE f.userID = ?
        ";

        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            die('MySQL prepare error: ' . $this->db->error);
        }

        $stmt->bind_param('i', $userID);

        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            echo "No favorites found for user ID $userID.";
        }
        $cars = $result->fetch_all(MYSQLI_ASSOC);
        return $cars;
    }

    public function checkIfFavoriteExists($carID, $userID) {
        $stmt = $this->db->prepare("SELECT 1 FROM favorites WHERE carID = ? AND userID = ?");
        $stmt->bind_param("ii", $carID, $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}