<?php
require_once __DIR__ . '/../app/config/db_config.php';

class CarsModel
{
    private $db;

    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    // Create a new car entry
    public function createCar($carData)
    {
        $query = "INSERT INTO cars (image, make, model, year, price, type, persona, Engine, horsePower, Doors, Torque, topSpeed, acceleration, fuelEfficiency, fuelType, cylinders, transmission, drivenWheels, marketCategory, description) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);

        $stmt->bind_param(
            "ssssdsdssddsdsdssdss",
            $carData['image'],
            $carData['make'],
            $carData['model'],
            $carData['year'],
            $carData['price'],
            $carData['type'],
            $carData['persona'],
            $carData['Engine'],
            $carData['horsePower'],
            $carData['Doors'],
            $carData['Torque'],
            $carData['topSpeed'],
            $carData['acceleration'],
            $carData['fuelEfficiency'],
            $carData['fuelType'],
            $carData['cylinders'],
            $carData['transmission'],
            $carData['drivenWheels'],
            $carData['marketCategory'],
            $carData['description'],
        );

        return $stmt->execute();
    }

    // Read car data (single or all cars)
    public function getCars($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM cars WHERE ID = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } else {
            $query = "SELECT * FROM cars";
            $result = $this->db->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }


    public function getCarById($carId)
    {
        // Use $this->db instead of $this->pdo
        $stmt = $this->db->prepare("SELECT * FROM cars WHERE id = ?");
        if ($stmt === false) {
            // If prepare() failed, output the error message
            die("Error in prepare() statement: " . implode(", ", $this->db->errorInfo()));
        }
        $stmt->bind_param('i', $carId);  // Using 'i' for integer parameter
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }


    // Get cars by persona
    public function getCarsByPersona($personaNumber)
    {
        $query = "SELECT * FROM cars WHERE persona = ?";
        $stmt = $this->db->prepare($query);

        if ($stmt === false) {
            // Handle prepare() failure
            die("Error in prepare() statement: " . $this->db->error);
        }

        $stmt->bind_param("i", $personaNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            // Handle query execution failure
            die("Error in query execution: " . $this->db->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
// Increment RecommendationCount for a car
public function incrementRecommendationCount($carId)
{
    $query = "UPDATE cars SET RecommendationCount = RecommendationCount + 1 WHERE ID = ?";
    $stmt = $this->db->prepare($query);

    if ($stmt === false) {
        die("Error in prepare() statement: " . $this->db->error);
    }

    $stmt->bind_param("i", $carId);
    return $stmt->execute();
}

    
    // Delete a car
    public function deleteCar($id)
    {
        $query = "DELETE FROM cars WHERE ID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
