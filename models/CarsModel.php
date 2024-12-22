

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
        // public function createCar($carData)
        // {
        //     $query = "INSERT INTO cars (image, make, model, year, price, type, persona, Engine, horsePower, Doors, Torque, topSpeed, acceleration, fuelEfficiency, fuelType, cylinders, transmission, drivenWheels, marketCategory, description) 
        //           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        //     $stmt = $this->db->prepare($query);

        //     $stmt->bind_param(
        //         "ssssdsdssddsdsdssdss",
        //         $carData['image'],
        //         $carData['make'],
        //         $carData['model'],
        //         $carData['year'],
        //         $carData['price'],
        //         $carData['type'],
        //         $carData['persona'],
        //         $carData['Engine'],
        //         $carData['horsePower'],
        //         $carData['Doors'],
        //         $carData['Torque'],
        //         $carData['topSpeed'],
        //         $carData['acceleration'],
        //         $carData['fuelEfficiency'],
        //         $carData['fuelType'],
        //         $carData['cylinders'],
        //         $carData['transmission'],
        //         $carData['drivenWheels'],
        //         $carData['marketCategory'],
        //         $carData['description'],
        //     );

        //     return $stmt->execute();
        // }

        public static function createCar(
            $image,
            $make,
            $model,
            $year,
            $price,
            $type,
            $persona,
            $engine,
            $horsePower,
            $doors,
            $torque,
            $topSpeed,
            $acceleration,
            $fuelEfficiency,
            $fuelType,
            $cylinders,
            $transmission,
            $drivenWheels,
            $marketCategory,
            $description,
            $personaDescription
        ) {
            global $conn;
    
            // Escape input values to prevent SQL injection
            $image = mysqli_real_escape_string($conn, $image);
            $make = mysqli_real_escape_string($conn, $make);
            $model = mysqli_real_escape_string($conn, $model);
            $year = mysqli_real_escape_string($conn, $year);
            $price = mysqli_real_escape_string($conn, $price);
            $type = mysqli_real_escape_string($conn, $type);
            $persona = mysqli_real_escape_string($conn, $persona);
            $engine = mysqli_real_escape_string($conn, $engine);
            $horsePower = mysqli_real_escape_string($conn, $horsePower);
            $doors = mysqli_real_escape_string($conn, $doors);
            $torque = mysqli_real_escape_string($conn, $torque);
            $topSpeed = mysqli_real_escape_string($conn, $topSpeed);
            $acceleration = mysqli_real_escape_string($conn, $acceleration);
            $fuelEfficiency = mysqli_real_escape_string($conn, $fuelEfficiency);
            $fuelType = mysqli_real_escape_string($conn, $fuelType);
            $cylinders = mysqli_real_escape_string($conn, $cylinders);
            $transmission = mysqli_real_escape_string($conn, $transmission);
            $drivenWheels = mysqli_real_escape_string($conn, $drivenWheels);
            $marketCategory = mysqli_real_escape_string($conn, $marketCategory);
            $description = mysqli_real_escape_string($conn, $description);
            $personaDescription = mysqli_real_escape_string($conn, $personaDescription);
    
            // Insert query to add the car to the database
            $sql = "INSERT INTO `cars` (`image`, `make`, `model`, `year`, `price`, `type`, `persona`, 
                                    `engine`, `horsePower`, `doors`, `torque`, `topSpeed`, `acceleration`, 
                                    `fuelEfficiency`, `fuelType`, `cylinders`, `transmission`, `drivenWheels`, 
                                    `marketCategory`, `description`, 
                                    `personaDescription`)
                VALUES ('$image', '$make', '$model', '$year', '$price', '$type', '$persona', 
                        '$engine', '$horsePower', '$doors', '$torque', '$topSpeed', '$acceleration', 
                        '$fuelEfficiency', '$fuelType', '$cylinders', '$transmission', '$drivenWheels', 
                        '$marketCategory', '$description',  
                        '$personaDescription')";
    
            // Execute the query and return the result
            $result = mysqli_query($conn, $sql);
    
            return $result;
        }

        // Read car data (single or all cars)
        // public function getCars($id = null)
        // {
        //     if ($id) {
        //         $query = "SELECT * FROM cars WHERE ID = ?";
        //         $stmt = $this->db->prepare($query);
        //         $stmt->bind_param("i", $id);
        //         $stmt->execute();
        //         $result = $stmt->get_result();
        //         return $result->fetch_assoc();
        //     } else {
        //         $query = "SELECT * FROM cars";
        //         $result = $this->db->query($query);
        //         return $result->fetch_all(MYSQLI_ASSOC);
        //     }
        // }

        public static function viewAllCars()
        {
            global $conn;

            $sql = "SELECT * FROM cars";
            $result = mysqli_query($conn, $sql);

            if (!$result) {

                die("Error fetching users: " . mysqli_error($conn));
            }


            $cars = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $cars[] = $row;
            }

            return $cars;
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


        // Delete a car
        public function deleteCar($id)
        {
            $query = "DELETE FROM cars WHERE ID = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }


        public static function getHighestRecommendedCars()
        {
            global $conn;
            $sql = "SELECT * FROM cars ORDER BY RecommendationCount DESC LIMIT 11";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                $cars = [];
                while ($row = $result->fetch_assoc()) {
                    $cars[] = $row;
                }
            } else {
                $cars = [];
            }


            $conn->close();

            
            return $cars;
        }
    }


    ?> 