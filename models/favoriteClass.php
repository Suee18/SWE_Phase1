<?php
require_once __DIR__ . '/../app/config/db_config.php';

class Favorites
{
    private $conn;
    public $favoriteID;
    public $carID;
    public $userID;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createFavorite($carID, $userID)
    {
        $query = "INSERT INTO favorites (carID, userID) VALUES (:carID, :userID)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':carID', $carID);
        $stmt->bindParam(':userID', $userID);

        if ($stmt->execute()) {
            return "Favorite added successfully!";
        } else {
            return "Failed to add favorite.";
        }
    }

    public function deleteFavorite($favoriteID)
    {
        $query = "DELETE FROM favorites WHERE favoriteID = :favoriteID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':favoriteID', $favoriteID);

        if ($stmt->execute()) {
            return "Favorite deleted successfully!";
        } else {
            return "Failed to delete favorite.";
        }
    }

    public function getFavoritesByUser($userID)
    {
        $query = "SELECT * FROM favorites WHERE userID = :userID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllFavorites()
    {
        $query = "SELECT * FROM favorites";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
