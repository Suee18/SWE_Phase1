<?php
require_once(__DIR__ . '/../core/cars_database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'fetch_makes':
            fetchMakes($db);
            break;

        case 'fetch_models':
            $make = $_GET['make'] ?? null;
            if ($make) {
                fetchModels($db, $make);
            } else {
                echo json_encode(['error' => 'Make not provided']);
            }
            break;

        case 'fetch_years':
            $make = $_GET['make'] ?? null;
            $model = $_GET['model'] ?? null;
            if ($make && $model) {
                fetchYears($db, $make, $model);
            } else {
                echo json_encode(['error' => 'Make or Model not provided']);
            }
            break;

        case 'fetch_car_details':
            $make = $_GET['make'] ?? null;
            $model = $_GET['model'] ?? null;
            $year = $_GET['year'] ?? null;
            if ($make && $model && $year) {
                fetchCarDetails($db, $make, $model, $year);
            } else {
                echo json_encode(['error' => 'Make, Model, or Year not provided']);
            }
            break;

        default:
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['error' => 'No action specified']);
}

function fetchMakes($db) {
    $query = "SELECT DISTINCT make FROM cars";
    $stmt = $db->query($query);
    $makes = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $makes[] = $row['make'];
    }
    echo json_encode($makes);
}

function fetchModels($db, $make) {
    try {
        $query = "SELECT DISTINCT model FROM cars WHERE make = :make"; // Use a named placeholder
        $stmt = $db->prepare($query); // Prepare the query
        $stmt->bindParam(':make', $make, PDO::PARAM_STR); // Bind the parameter
        $stmt->execute(); // Execute the query

        $models = $stmt->fetchAll(PDO::FETCH_COLUMN); // Fetch results as an array of column values
        echo json_encode($models); // Output as JSON
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]); // Return error message
    }
}

function fetchYears($db, $make, $model) {
    $query = "SELECT DISTINCT year FROM cars WHERE make = :make AND model = :model ORDER BY year DESC";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':make', $make, PDO::PARAM_STR);
    $stmt->bindValue(':model', $model, PDO::PARAM_STR);
    $stmt->execute();

    $years = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $years[] = $row['year'];
    }
    echo json_encode($years);
}

function fetchCarDetails($db, $make, $model, $year) {
    $query = "SELECT * FROM cars WHERE make = :make AND model = :model AND year = :year";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':make', $make, PDO::PARAM_STR);
    $stmt->bindParam(':model', $model, PDO::PARAM_STR);
    $stmt->bindParam(':year', $year, PDO::PARAM_STR);
    $stmt->execute();
  
    $carData = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($carData);
  }
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'];

    if ($action === 'fetch_car_details') {
        $model = $input['model'];


        // Replace this with your database query to fetch car details based on the model
        $stmt = $pdo->prepare("SELECT * FROM cars WHERE model = ?");
        $stmt->execute([$model]);
        $carDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($carDetails) {
            echo json_encode(["success" => true, "carDetails" => $carDetails]);
        } else {
            echo json_encode(["success" => false, "message" => "No details found for this model."]);
        }
        exit;
    }
    if (isset($_GET['make'], $_GET['model'], $_GET['year'])) {
    $make = $_GET['make'];
    $model = $_GET['model'];
    $year = $_GET['year'];

    // Connect to your database
    $conn = new mysqli("localhost", "username", "password", "database");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch car details for the selected make, model, and year
    $query = $conn->prepare("SELECT * FROM cars WHERE make = ? AND model = ? AND year = ?");
    $query->bind_param("sss", $make, $model, $year);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $car = $result->fetch_assoc();
        echo json_encode($car);
    } else {
        echo json_encode(["error" => "No car found matching the selected criteria."]);
    }

    $conn->close();
}


}



?>
