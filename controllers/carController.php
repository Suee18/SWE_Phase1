
<?php
// include_once  '/../app/config/db_config.php';
// // include '../models/CarsModel.php';
require_once __DIR__ . '/../app/config/db_config.php';

include_once __DIR__ . '../../models/CarsModel.php';
// Instantiate the Cars class
$carModel = new CarsModel($conn);

// Handle the request based on the POST action (add, update, delete)
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//     // Check if the action is 'add', 'update', or 'delete'
//     switch ($_POST['action']) {
//         case 'add':
//             carController::addCar();
//             break;
//         case 'update':
//             carController::updateCar($carModel);
//             break;
//         case 'delete':
//             carController::deleteCar($carModel);
//             break;
//         default:
//             echo "Invalid action.";
//             break;
//     }
// }
// else {
//     echo "Invalid request.";
// }


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? 'read';

    switch ($action) {


            //CAR CRUDS
        case 'add-car':

            $image = $_POST['image']?? '';
            $make = $_POST['make'] ?? '';
            $model = $_POST['model'] ?? '';
            $year = $_POST['year'] ?? '';
            $price = $_POST['price'] ?? '';
            $type = $_POST['type'] ?? '';
            $persona = $_POST['persona'] ?? '';
            $engine = $_POST['Engine'] ?? '';
            $horsePower = $_POST['horsePower'] ?? '';
            $doors = $_POST['Doors'] ?? '';
            $torque = $_POST['Torque'] ?? '';
            $topSpeed = $_POST['topSpeed'] ?? '';
            $acceleration = $_POST['acceleration'] ?? '';
            $fuelEfficiency = $_POST['fuelEfficiency'] ?? '';
            $fuelType = $_POST['fuelType'] ?? '';
            $cylinders = $_POST['cylinders'] ?? '';
            $transmission = $_POST['transmission'] ?? '';
            $drivenWheels = $_POST['drivenWheels'] ?? '';
            $marketCategory = $_POST['marketCategory'] ?? '';
            $description = $_POST['description'] ?? '';
            $personaDescription = $_POST['personaDescription'] ?? '';

            CarController::addCar(
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
            );
            break;

        case 'update-car':
            $car_id = $_POST['car_id'] ?? '';
            $image = $_POST['image'];
            $make = $_POST['make'] ?? '';
            $model = $_POST['model'] ?? '';
            $year = $_POST['year'] ?? '';
            $price = $_POST['price'] ?? '';
            $type = $_POST['type'] ?? '';
            $persona = $_POST['persona'] ?? '';
            $engine = $_POST['Engine'] ?? '';
            $horsePower = $_POST['horsePower'] ?? '';
            $doors = $_POST['Doors'] ?? '';
            $torque = $_POST['Torque'] ?? '';
            $topSpeed = $_POST['topSpeed'] ?? '';
            $acceleration = $_POST['acceleration'] ?? '';
            $fuelEfficiency = $_POST['fuelEfficiency'] ?? '';
            $fuelType = $_POST['fuelType'] ?? '';
            $cylinders = $_POST['cylinders'] ?? '';
            $transmission = $_POST['transmission'] ?? '';
            $drivenWheels = $_POST['drivenWheels'] ?? '';
            $marketCategory = $_POST['marketCategory'] ?? '';
            $description = $_POST['description'] ?? '';
            $personaDescription = $_POST['personaDescription'] ?? '';

            carController::updateCar(
                $car_id,
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
            );
            break;
        case 'delete-car':
            $carID = $_POST['carID'];
            carController::deleteCar($carID);
            break;
    }
    header('Location: admin.php');
}

class carController
{


    //ADD CAR
    public static function addCar(
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
        // Prepare postData for validation
        $postData = [
            'image' => $image,
            'make' => $make,
            'model' => $model,
            'year' => $year,
            'price' => $price,
            'type' => $type,
            'persona' => $persona,
            'Engine' => $engine,
            'horsePower' => $horsePower,
            'Doors' => $doors,
            'Torque' => $torque,
            'topSpeed' => $topSpeed,
            'acceleration' => $acceleration,
            'fuelEfficiency' => $fuelEfficiency,
            'fuelType' => $fuelType,
            'cylinders' => $cylinders,
            'transmission' => $transmission,
            'drivenWheels' => $drivenWheels,
            'marketCategory' => $marketCategory,
            'description' => $description,
            'personaDescription' => $personaDescription
        ];

        // Validate the car data using the validation function
        $carData = validateCarData($postData);

        // If validation fails, stop further execution (optional: return error)
        if ($carData === false) {
            return;
        }

        // Proceed to create the car if validation is successful
        CarsModel::createCar($carData);
    }





    //UPDATE CAR

    public static function updateCar(
        $car_id,
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
        // Prepare postData for validation
        $postData = [
            'image' => $image,
            'make' => $make,
            'model' => $model,
            'year' => $year,
            'price' => $price,
            'type' => $type,
            'persona' => $persona,
            'Engine' => $engine,
            'horsePower' => $horsePower,
            'Doors' => $doors,
            'Torque' => $torque,
            'topSpeed' => $topSpeed,
            'acceleration' => $acceleration,
            'fuelEfficiency' => $fuelEfficiency,
            'fuelType' => $fuelType,
            'cylinders' => $cylinders,
            'transmission' => $transmission,
            'drivenWheels' => $drivenWheels,
            'marketCategory' => $marketCategory,
            'description' => $description,
            'personaDescription' => $personaDescription
        ];


        $carData = validateCarData($postData);


        if ($carData === false) {
            return;
        }

        // Proceed to update the car if validation is successful
        carsModel::updateCar(
            $car_id,
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
            $carData['personaDescription']
        );
    }


    //DELETE CAR
    public static function deleteCar($ID)
    {
        carsModel::deleteCar($ID);
    }

    //View All Cars
    public static function viewAllCars()
    {
        return CarsModel::viewAllCars();
    }


    //Get Highly Recommended Cars
    public static function getHighlyRecommendedCars()
    {
        return  CarsModel::getHighestRecommendedCars();
    }


    // // Function to add a car
    // public static function addCar($carModel)
    // {
    //     $carData = validateCarData($_POST);

    //     // Check if validation was successful
    //     if ($carData === false) {
    //         echo "Invalid car data.";
    //         return;
    //     }

    //     // Call the createCar method to add the car to the database
    //     // if 
    //     $carModel->createCar($carData);
    //     //     echo "Car added successfully!";
    //     // } else {
    //     //     echo "Failed to add car.";
    //     // }
    // }


    // public static function addCar(
    //     $image,
    //     $make,
    //     $model,
    //     $year,
    //     $price,
    //     $type,
    //     $persona,
    //     $engine,
    //     $horsePower,
    //     $doors,
    //     $torque,
    //     $topSpeed,
    //     $acceleration,
    //     $fuelEfficiency,
    //     $fuelType,
    //     $cylinders,
    //     $transmission,
    //     $drivenWheels,
    //     $marketCategory,
    //     $description,
    //     $personaDescription
    // ) {
    //     CarsModel::createCar(
    //         $image,
    //         $make,
    //         $model,
    //         $year,
    //         $price,
    //         $type,
    //         $persona,
    //         $engine,
    //         $horsePower,
    //         $doors,
    //         $torque,
    //         $topSpeed,
    //         $acceleration,
    //         $fuelEfficiency,
    //         $fuelType,
    //         $cylinders,
    //         $transmission,
    //         $drivenWheels,
    //         $marketCategory,
    //         $description,
    //         $personaDescription
    //     );
    // }


    //     public static function updateCar($car_id,
    //     $image,
    //     $make,
    //     $model,
    //     $year,
    //     $price,
    //     $type,
    //     $persona,
    //     $engine,
    //     $horsePower,
    //     $doors,
    //     $torque,
    //     $topSpeed,
    //     $acceleration,
    //     $fuelEfficiency,
    //     $fuelType,
    //     $cylinders,
    //     $transmission,
    //     $drivenWheels,
    //     $marketCategory,
    //     $description,
    //     $personaDescription)
    // {
    //     if (empty($make)) {
    //         echo "Car make is required.";
    //         return false;
    //     }

    //     if ($persona < 1 || $persona > 7) {
    //         echo "Persona must be between 1 and 7.";
    //         return false;
    //     }

    //     if ($price < 0) {
    //         echo "Price cannot be negative.";
    //         return false;
    //     }

    //     if (str_word_count($description) > 25) {
    //         echo "Description must be 25 words or fewer.";
    //         return false;
    //     }

    //     if (!in_array($drivenWheels, ['FWD', 'AWD', 'RWD', '4WD'])) {
    //         echo "Driven wheels must be one of 'FWD', 'AWD', 'RWD', '4WD'.";
    //         return false;
    //     }

    //     if ($doors % 2 != 0) {
    //         echo "Doors must be an even number.";
    //         return false;
    //     }

    //     if ($cylinders % 2 != 0) {
    //         echo "Cylinders must be an even number.";
    //         return false;
    //     }

    //     if (!in_array($fuelType, ['Gasoline', 'Diesel', 'Electric', 'Hybrid'])) {
    //         echo "Fuel type must be one of 'Gasoline', 'Diesel', 'Electric', 'Hybrid'.";
    //         return false;
    //     }

    //     $intFields = ['horsePower', 'torque', 'topSpeed', 'acceleration', 'fuelEfficiency'];
    //     foreach ($intFields as $field) {
    //         if ($$field < 0) {
    //             echo ucfirst($field) . " cannot be negative.";
    //             return false;
    //         }
    //     }

    //     //function call from cars model
    //     carsModel::updateCar($car_id,
    //     $image,
    //     $make,
    //     $model,
    //     $year,
    //     $price,
    //     $type,
    //     $persona,
    //     $engine,
    //     $horsePower,
    //     $doors,
    //     $torque,
    //     $topSpeed,
    //     $acceleration,
    //     $fuelEfficiency,
    //     $fuelType,
    //     $cylinders,
    //     $transmission,
    //     $drivenWheels,
    //     $marketCategory,
    //     $description,
    //     $personaDescription);

    // }


    // Function to update a car
    // public static function updateCar($carModel)
    // {
    //     $carId = $_POST['id']; // Get the car ID
    //     $carData = validateCarData($_POST, true);

    //     // Check if validation was successful
    //     if ($carData === false) {
    //         echo "Invalid car data.";
    //         return;
    //     }

    //     // Call the updateCar method to update the car in the database
    //     if ($carModel->updateCar($carId, $carData)) {
    //         echo "Car updated successfully!";
    //     } else {
    //         echo "Failed to update car.";
    //     }
    //     // Update a car
    //     // Update a car

    //     $carId = $_POST['id']; // Get the car ID

    //     // Check if the car exists
    //     $existingCar = $carModel->getCarById($carId);
    //     if (!$existingCar) {
    //         echo "Car with ID $carId does not exist.";
    //         exit;
    //     }

    //     // Initialize the updated car data with the existing data
    //     $carData = $existingCar;

    //     // Overwrite only the fields provided in the POST request
    //     if (!empty($_POST['image'])) {
    //         $carData['image'] = $_POST['image'];
    //     }
    //     if (!empty($_POST['make'])) {
    //         $carData['make'] = $_POST['make'];
    //     }
    //     if (!empty($_POST['model'])) {
    //         $carData['model'] = $_POST['model'];
    //     }
    //     if (!empty($_POST['year'])) {
    //         $carData['year'] = $_POST['year'];
    //     }
    //     if (!empty($_POST['price'])) {
    //         $carData['price'] = $_POST['price'];
    //     }
    //     if (!empty($_POST['type'])) {
    //         $carData['type'] = $_POST['type'];
    //     }
    //     if (!empty($_POST['persona'])) {
    //         $carData['persona'] = $_POST['persona'];
    //     }
    //     if (!empty($_POST['Engine'])) {
    //         $carData['Engine'] = $_POST['Engine'];
    //     }
    //     if (!empty($_POST['horsePower'])) {
    //         $carData['horsePower'] = $_POST['horsePower'];
    //     }
    //     if (!empty($_POST['Doors'])) {
    //         $carData['Doors'] = $_POST['Doors'];
    //     }
    //     if (!empty($_POST['Torque'])) {
    //         $carData['Torque'] = $_POST['Torque'];
    //     }
    //     if (!empty($_POST['topSpeed'])) {
    //         $carData['topSpeed'] = $_POST['topSpeed'];
    //     }
    //     if (!empty($_POST['acceleration'])) {
    //         $carData['acceleration'] = $_POST['acceleration'];
    //     }
    //     if (!empty($_POST['fuelEfficiency'])) {
    //         $carData['fuelEfficiency'] = $_POST['fuelEfficiency'];
    //     }
    //     if (!empty($_POST['fuelType'])) {
    //         $carData['fuelType'] = $_POST['fuelType'];
    //     }
    //     if (!empty($_POST['cylinders'])) {
    //         $carData['cylinders'] = $_POST['cylinders'];
    //     }
    //     if (!empty($_POST['transmission'])) {
    //         $carData['transmission'] = $_POST['transmission'];
    //     }
    //     if (!empty($_POST['drivenWheels'])) {
    //         $carData['drivenWheels'] = $_POST['drivenWheels'];
    //     }
    //     if (!empty($_POST['marketCategory'])) {
    //         $carData['marketCategory'] = $_POST['marketCategory'];
    //     }
    //     if (!empty($_POST['description'])) {
    //         $carData['description'] = $_POST['description'];
    //     }

    //     // Validate car data (call the validation function)
    //     $validatedData = validateCarData($carData, true);  // Passing true to indicate this is an update
    //     if ($validatedData === false) {
    //         exit;  // Exit if validation fails
    //     }

    //     // Call the updateCar method to update the car in the database
    //     if ($carModel->updateCar($carId, $validatedData)) {
    //         echo "Car updated successfully!";
    //     } else {
    //         echo "Failed to update car.";
    //     }
    // }








    // Function to delete a car
    // public static function deleteCar($carModel)
    // {
    //     $carId = $_POST['id'];

    //     // Call the deleteCar method to remove the car from the database
    //     if ($carModel->deleteCar($carId)) {
    //         echo "Car deleted successfully!";
    //     } else {
    //         echo "Failed to delete car.";
    //     }
    // }


}



// Function to validate car data
function validateCarData($postData, $isUpdate = false)
{
    $carData = [
        'image' => $postData['image'] ?? null,
        'make' => $postData['make'] ?? null,
        'model' => $postData['model'] ?? null,
        'year' => $postData['year'] ?? null,
        'price' => $postData['price'] ?? null,
        'type' => $postData['type'] ?? null,
        'persona' => $postData['persona'] ?? null,
        'Engine' => $postData['Engine'] ?? null,
        'horsePower' => $postData['horsePower'] ?? null,
        'Doors' => $postData['Doors'] ?? null,
        'Torque' => $postData['Torque'] ?? null,
        'topSpeed' => $postData['topSpeed'] ?? null,
        'acceleration' => $postData['acceleration'] ?? null,
        'fuelEfficiency' => $postData['fuelEfficiency'] ?? null,
        'fuelType' => $postData['fuelType'] ?? null,
        'cylinders' => $postData['cylinders'] ?? null,
        'transmission' => $postData['transmission'] ?? null,
        'drivenWheels' => $postData['drivenWheels'] ?? null,
        'marketCategory' => $postData['marketCategory'] ?? null,
        'description' => $postData['description'] ?? null,
        'personaDescription' => $postData['personaDescription'] ?? null,
    ];

    // Validation Rules
    if (!$isUpdate && empty($carData['make'])) {
        echo "Car make is required.";
        return false;
    }
    if (isset($carData['persona']) && ($carData['persona'] < 1 || $carData['persona'] > 7)) {
        echo "Persona must be a value between 1 and 7.";
        return false;
    }
    if (isset($carData['price']) && $carData['price'] < 0) {
        echo "Price cannot be negative.";
        return false;
    }
    if (isset($carData['description']) && str_word_count($carData['description']) > 25) {
        echo "Description must be 25 words or fewer.";
        return false;
    }
    if (isset($carData['drivenWheels']) && !in_array($carData['drivenWheels'], ['FWD', 'AWD', 'RWD', '4WD'])) {
        echo "Driven wheels must be one of 'FWD', 'AWD', 'RWD', '4WD'.";
        return false;
    }
    if (isset($carData['Doors']) && $carData['Doors'] % 2 != 0) {
        echo "Doors must be an even number.";
        return false;
    }
    if (isset($carData['cylinders']) && $carData['cylinders'] % 2 != 0) {
        echo "Cylinders must be an even number.";
        return false;
    }
    if (isset($carData['fuelType']) && !in_array($carData['fuelType'], ['Gasoline', 'Diesel', 'Electric', 'Hybrid'])) {
        echo "Fuel type must be one of 'Gasoline', 'Diesel', 'Electric', 'Hybrid'.";
        return false;
    }
    $intFields = ['year', 'horsePower', 'Torque', 'topSpeed', 'acceleration', 'fuelEfficiency'];
    foreach ($intFields as $field) {
        if (isset($carData[$field]) && $carData[$field] < 0) {
            echo ucfirst($field) . " cannot be negative.";
            return false;
        }
    }
    $currentYear = date('Y');
    if (isset($carData['year']) && ($carData['year'] < 1886 || $carData['year'] > $currentYear)) {
        echo "Year must be between 1886 and $currentYear.";
        return false;
    }

    // Return the valid car data
    return $carData;
}
