<?php

// Include the CarsModel to fetch car details
require_once __DIR__ . '/../../../models/CarsModel.php';
require_once __DIR__ . '/../../../app/config/db_config.php';
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../models/UsersClass.php';
require_once __DIR__ . '/../../../controllers/SessionManager.php';

// session_start();
SessionManager::startSession();

if (!isset($_SESSION['topPersona'])) {
    echo "No persona data found. Please retake the test.";
    exit;
}

// Load the top persona details from the session
$topPersona = $_SESSION['topPersona'];
 $_SESSION['user']->personaID=$topPersona['id'];

// Instantiate the CarsModel and fetch cars for the persona
$carsModel = new CarsModel($conn);
$cars = $carsModel->getCarsByPersona($topPersona['id']);

// Debugging
file_put_contents('debug_cars.txt', print_r($cars, true));

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public_html/css/persona.css">
    <link rel="stylesheet" href="../../../public_html/css/userNavbar.css">
    <link rel="stylesheet" href="../../../public_html/css/car_card.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Your Persona</title>
    <link rel="icon" href="../../../public_html/media/persona-icon.png" alt="persona-icon" />
    <script src="../../../public_html/js/persona.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../../../public_html/js/favorites.js" defer></script>
</head>

<body>


    <?php include '../../../public_html/components/userNavbar.php'; ?>

    <div class="resultsBiggestContainer">

        <div class="content-container">
            <h2 class="titleBanner1">Your car persona</h2>
            <h4 class="paragraphBanner1">
                Here are your results based on the persona test you've just completed...<br>
                Understand more about your persona below, and discover cars that are just your type!
            </h4>
        </div>

        <div class="persona-container">



            <div class="left-column">
                <div class="persona-info">
                    <img src="<?= htmlspecialchars($topPersona['icon']); ?>" alt="Persona Icon" class="persona-image">
                    <div>
                        <p class="persona-title"><?= htmlspecialchars($topPersona['name']); ?></p>
                    </div>
                    <p class="personaDiscriptionParagraph"><?= htmlspecialchars($topPersona['description']); ?></p>
                </div>
            </div>


            <div class="right-column">
                <?php if (!empty($cars)): ?>
                    <div class="carList">
                        <?php
                        // Get the first car
                        $firstCar = $cars[0];
                        ?>
                        <div class="topCarDiv">

                            <div class="topImagediv">
                                <img class="car-image"
                                    src="<?= htmlspecialchars($firstCar['image']); ?>"
                                    alt="<?= htmlspecialchars($firstCar['make'] . ' ' . $firstCar['model']); ?>">
                            </div>

                            <h4 class="carName">
                                <?= htmlspecialchars($firstCar['make'] . ' ' . $firstCar['model']); ?>
                            </h4>

                            <div class="car-info">
                                <p class="topCarDescription">
                                    <?= htmlspecialchars($firstCar['personaDescription']); ?>
                                </p>
                            </div>

                        </div>
                    </div>
                <?php else: ?>
                    <p class="noCarsMessage">No top car available for this persona.</p>
                <?php endif; ?>
            </div>


        </div>

        <!-- ======================ALL PERSONA CARS======================================== -->


        <!-- Updated HTML: car_cards.html -->
        <div class="landingPage_part2">
            <div class="filter">
                <div class="partsTitles_lp">
                    <p class="mostRecommendedCarsTitle_lp">
                        Cars matching your persona
                    </p>
                </div>

                <div class="carCardsContainer_lp">
                    <div class="car-cards-container">
                        <div class="container2"> <!-- Fixed wrapper for cards -->
                            <?php foreach ($cars as $car): ?>
                                <div class="car-card">
                                    <div class="car-card-inner">

                                        <!-- Front of the card -->
                                        <div class="car-card-front">
                                            <div class="img-container">
                                                <img src="<?php echo $car['image']; ?>" alt="<?php echo htmlspecialchars($car['make']); ?>" class="car-card-img">
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
                                                            <td><?php echo htmlspecialchars($car['Engine']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="spec-in-table">Power</td>
                                                            <td><?php echo htmlspecialchars($car['horsePower']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="spec-in-table">Torque</td>
                                                            <td><?php echo htmlspecialchars($car['Torque']); ?></td>
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
        </div>


        <hr class="divider">

        <!-- ============================END OF PAGE  ========================-->



        <div class="slider-container">
            <div class="persona-slider-section">
                <h2 class="resultsSectionHeader">Our Different Persona's</h2>

                <div class="swiper-container">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="persona-card">
                                <img src="../../../public_html/media/Persona_Test_Images/Landing/icons/eco-warrior-icon.png"
                                    alt="Eco-Warrior Icon" class="persona-icon">
                                <h4>Eco-Warrior</h4>
                                <p class="persona-paragraph">Focuses on eco-conscious vehicles like electric & hybrid
                                    cars,
                                    prioritizing sustainability and efficiency</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="persona-card">
                                <img src="../../../public_html/media/Persona_Test_Images/Landing/icons/family-first-icon.png"
                                    alt="Family First Icon" class="persona-icon">
                                <h4>Family First</h4>
                                <p class="persona-paragraph">Prioritizes spacious, safe vehicles for family use,
                                    typically
                                    favoring SUVs or minivans</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="persona-card">
                                <img src="../../../public_html/media/Persona_Test_Images/Landing/icons/luxury-seeker-icon.png"
                                    alt="Luxury Seeker Icon" class="persona-icon">
                                <h4>Luxury Seeker</h4>
                                <p class="persona-paragraph">Focuses on high-end, premium vehicles with luxury features,
                                    comfort, and brand prestige</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="persona-card">
                                <img src="../../../public_html/media/Persona_Test_Images/Landing/icons/tech-geek-icon.png"
                                    alt="Tech Geek Icon" class="persona-icon">
                                <h4>Tech Geek</h4>
                                <p class="persona-paragraph">Wants cutting-edge tech in the car, such as autopilot,
                                    driver
                                    assistance, and smart connectivity</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="persona-card">
                                <img src="../../../public_html/media/Persona_Test_Images/Landing/icons/performance-enthusiast-icon.png"
                                    alt="Performance Enthusiast Icon" class="persona-icon">
                                <h4>Performance Enthusiast</h4>
                                <p class="persona-paragraph">Prefers high-performance cars with a focus on speed,
                                    handling,
                                    &
                                    acceleration</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="persona-card">
                                <img src="../../../public_html/media/Persona_Test_Images/Landing/icons/budget-conscious-icon.png"
                                    alt="Budget Conscious Icon" class="persona-icon">
                                <h4>Budget Conscious</h4>
                                <p class="persona-paragraph">Focuses on affordability, looking for the best value within
                                    a
                                    budget while balancing reliability</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="persona-card">
                                <img src="../../../public_html/media/Persona_Test_Images/Landing/icons/classic-car-lover-icon.png"
                                    alt="Classic Car Lover Icon" class="persona-icon">
                                <h4>Classic Car Lover</h4>
                                <p class="persona-paragraph">Seeks timeless, vintage, or iconic car designs, sometimes
                                    preferring restored older models.</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="persona-card">
                                <img src="../../../public_html/media/Persona_Test_Images/Test_Images/icons/i_dont_know.png"
                                    alt="Classic Car Lover Icon" class="persona-icon">
                                <h4>The path Finder</h4>
                                <p class="persona-paragraph">
                                    Doesn't have any idea about their prefrences on wheels, but are driven by curiousty to find out.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pageEnd">
            <button class="animated-button open-modal-button" onclick="window.location.href='../../../app/views/user/persona_test.php'">
                <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
                    <path
                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                    </path>
                </svg>
                <span class="text">Retake the test</span>
                <span class="circle"></span>
                <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
                    <path
                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                    </path>
                </svg>
            </button>
        </div>
    </div>




































    </div> <!--biggest Filter Container -->
    </div>


</body>

</html>
<?php
// Clear the stored persona and cars data
// unset($_SESSION['personaID']);
// unset($_SESSION['cars']);
unset($_SESSION['answers']); 
// unset($_SESSION['topPersona']); 
?>