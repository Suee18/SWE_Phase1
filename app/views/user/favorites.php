<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/SWE_Phase1/app/config/db_config.php';
include_once __DIR__ . '/../../../models/UsersClass.php';
include_once __DIR__ . '/../../../controllers/FavoritesController.php';
include_once __DIR__ . '/../../../controllers/SessionManager.php';
require_once __DIR__ . '/../../../middleware/user_auth.php';

SessionManager::startSession();
$user = SessionManager::getUser() ? SessionManager::getUser()->id : 0;
$favoritesController = new FavoritesController($conn);
$favCars = $favoritesController->fetchFavoriteCars($user);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public_html/css/favorites.css">
    <link rel="stylesheet" href="../../../public_html/css/car_card.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../../../public_html/js/favorites.js" defer></script>
    <title>Favorite Cars</title>
</head>

<body>
    <?php include '../../../public_html/components/userNavbar.php'; ?>
    <div class="fav_cars">
        <h1>Your Favorite Cars</h1>
        <div class="carCardsContainer_lp">
            <div class="car-cards-container">
                <div class="container2">
                    <?php foreach ($favCars as $car): ?>
                        <div class="car-card">
                            <div class="car-card-inner">

                                <!-- Front of the card -->
                                <div class="car-card-front">
                                    <div class="img-container">
                                        <img src="<?php echo $car['image']; ?>"
                                            alt="<?php echo htmlspecialchars($car['make']); ?>" class="car-card-img">
                                    </div>

                                    <div class="car-card-content">
                                        <div class="car-info-container">
                                            <p class="car-name"><?php echo htmlspecialchars($car['make']); ?></p>
                                            <p class="carModel"><?php echo htmlspecialchars($car['model']); ?></p>
                                        </div>

                                        <?php
                                        if (!function_exists('limitDescription')) {
                                            function limitDescription($description, $wordLimit = 30)
                                            {
                                                $words = explode(' ', $description);
                                                if (count($words) > $wordLimit) {
                                                    return implode(' ', array_slice($words, 0, $wordLimit)) . '...';
                                                }
                                                return $description;
                                            }
                                        }
                                        ?>
                                        <p class="car-description"><?php echo limitDescription($car['description']); ?></p>
                                        <p class="car-price"><?php echo '$' . number_format($car['price'], 0); ?></p>
                                    </div>
                                </div>

                                <!-- Back of the card -->
                                <div class="car-card-back">
                                    <div class="car-specs-content">
                                        <h3 class="specs-title">Car Specifications</h3>
                                        <table class="specs-table">
                                            <tbody>
                                                <tr>
                                                    <td class="spec-in-table">Engine</td>
                                                    <td><?php echo htmlspecialchars($car['engine']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="spec-in-table">Power</td>
                                                    <td><?php echo htmlspecialchars($car['horsePower']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="spec-in-table">Torque</td>
                                                    <td><?php echo htmlspecialchars($car['torque']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="spec-in-table">0-60 mph</td>
                                                    <td><?php echo htmlspecialchars($car['acceleration']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="spec-in-table">Fuel Economy (City/Highway)</td>
                                                    <td><?php echo htmlspecialchars($car['fuelEfficiency']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="spec-in-table">Transmission</td>
                                                    <td><?php echo htmlspecialchars($car['transmission']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="spec-in-table">DrivenWheels</td>
                                                    <td><?php echo htmlspecialchars($car['drivenWheels']); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>


                                        <div class="con-like">
                                            <input class="like" type="checkbox" title="like">
                                            <div class="checkmark">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="outline" viewBox="0 0 24 24">
                                                    <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="filled" viewBox="0 0 24 24">
                                                    <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"></path>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" class="celebrate">
                                                    <polygon class="poly" points="10,10 20,20"></polygon>
                                                    <polygon class="poly" points="10,50 20,50"></polygon>
                                                    <polygon class="poly" points="20,80 30,70"></polygon>
                                                    <polygon class="poly" points="90,10 80,20"></polygon>
                                                    <polygon class="poly" points="90,50 80,50"></polygon>
                                                    <polygon class="poly" points="80,80 70,70"></polygon>
                                                </svg>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>