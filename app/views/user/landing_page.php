<?php
include_once __DIR__ . '\..\..\config\db_config.php';
include __DIR__ . '\..\..\..\models\ReviewsClass.php';
include_once __DIR__ . '\..\..\..\controllers\ReviewController.php';
include __DIR__ . '\..\..\..\models\UsersClass.php';
include_once __DIR__ . '\..\..\..\controllers\SessionManager.php';
include_once __DIR__ . '\..\..\..\models\CarsModel.php';
include_once __DIR__ . '\..\..\..\controllers\carController.php';
SessionManager::startSession();

// $reviewsSliderArray = ReviewController::getNumberOfReviews(7);

$reviewController = new ReviewController(new ReviewDatabaseStrategy());
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Submit'])) {
    $reviewData = [
        'reviewText' => mysqli_real_escape_string($conn, htmlspecialchars($_POST['reviewText'])),
        'reviewCategory' => mysqli_real_escape_string($conn, htmlspecialchars($_POST['reviewCategory'])),
        'reviewDate' => date('Y-m-d H:i:s'),
        'reviewRating' => $_POST['starRating'] ?? NULL,
        'userID' => SessionManager::getUser() ? SessionManager::getUser()->id : 0
    ];

    $reviewController->addReview($reviewData);

    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

$cars = carController::getHighlyRecommendedCars();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/landing_page.css">
    <link rel="stylesheet" href="css/global_styles.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="../public_html/css/car_card.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <title>Landing Page</title>
</head>

<body>

    <?php include '../public_html/components/nav_bar.php'; ?>

    <div class="slideShowContainer_lp">

        <!-- Slide 1 -->
        <div class="slide" id="slide1">
            <div class="videoBG_lp">
                <video autoplay muted loop class="slide-bg" id="myVideo">
                    <source src="../public_html/media/BMWM5CS.mp4" type="video/mp4">
                    Your browser does not support the video
                </video>
            </div>



            <div class="text-overlay">
                <p class="slide1Title_lp">
                    you can't really hide who you are</p>
                <p class="slide1paragraph_lp">
                    Take the test now, and find your match on wheels.</p>
            </div>
        </div>

        <!-- Slide 2 -->

        <div class="slide" id="slide2">
            <img src="../public_html/media/thisOrThat.png" class="slide-bg" alt="Image Background">

            <div class="text-overlay">
                <p class="slide2Title_lp">
                    This or that?
                </p>
                <p class="slide2paragraph_lp">
                    Compare between any two car Models
                </p>
            </div>

        </div>

        <!-- Slide 3:  -->
        <div class="slide" id="slide3">
            <div class="videoBG_lp">
                <video autoplay muted loop class="slide-bg" id="myVideo">
                    <source src="../public_html/media/astonmartin.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="text-overlay">
                <p class="slide3Title_lp">
                    Ready, set,
                    <span class="slide3Title_lp">
                        Turbo!
                    </span>
                </p>
                <p class="slide3paragraph_lp">
                    Talk now to Turbo, the chatbot
                </p>
            </div>
        </div>

        <!-- Slide 4: -->
        <div class="slide" id="slide4">
            <img src="https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/ac03f9160627007.63c65854745ec.jpg"
                class="slide-bg" alt="Image Background">
            <!-- <img src="https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/de399d160627007.63bc726268b18.jpg" class="slide-bg" alt="Image Background" style="margin-top: 10px;"> -->
            <!-- <img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/260f6b160627007.63c655267b415.jpg
      " class="slide-bg" alt="Image Background" style="margin-top: 50px;"> -->

            <div class="text-overlay">
                <p class="slide4Title_lp">Drive. Share. Connect.</p>
                <p class="slide4Paragraph_lp">Join the ultimate car community.
                    Share your experiences,<br> discover posts,
                    and connect with car enthusiasts..</p>

            </div>
        </div>



        <!-- Dots for navigation -->
        <div class="dots">
            <span class="dot" onclick="showSlideOnClick(1)"></span>
            <span class="dot" onclick="showSlideOnClick(2)"></span>
            <span class="dot" onclick="showSlideOnClick(3)"></span>
            <span class="dot" onclick="showSlideOnClick(4)"></span>
        </div>
    </div>

    <!----------------PART 2:MOST RECOMMENDED CARS--------------------------->
    <div class="landingPage_part2">
        <div class="filter">
            <div class="partsTitles_lp">
                <P class="mostRecommendedCarsTitle_lp">
                    most recommended Cars
                </P>
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
                                            <p class="car-description"><?php echo limitDescription($car['description']); ?>
                                            </p>
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="outline"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                                        </path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="filled"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                                        </path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100"
                                                        class="celebrate">
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

    <!----------------PART 3:Reviews--------------------------->
    <!----------------PART 3:Reviews--------------------------->
    <div class="landingPage_part3">
        <div class="filter_reviews">
            <div class="partsTitles_lp">
                <P class="reviewsTitle_lp">
                    Reviews
                </P>
            </div>
            <div class="reviews-section">
                <h2 class="header">What our Clients say!</h2>

                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        include_once __DIR__ . '/../../../controllers/ReviewController.php';

                        $reviewsSliderArray = ReviewController::getHighRatedReviews(3);

                        foreach ($reviewsSliderArray as $review) {
                            $rating = $review->reviewRating;

                            $stars = '';
                            for ($i = 1; $i <= 5; $i++) {
                                $stars .= $i <= $rating
                                    ? '<span class="rating filled">★</span>'
                                    : '<span class="rating">★</span>';
                            }

                            echo
                                '<div class="swiper-slide">
                                        <div class="review-card">
                                            <h4 class="reviewUserName">' . 'Anonymous' . '</h4>
                                            <p class="review-paragraph">"' . htmlspecialchars($review->reviewText) . '"</p>
                                            <div class="review-rating">' . $stars . '</div>
                                        </div>
                                </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>


            <button class="btn" id="openOverlay">
                <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
                    <path
                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                    </path>
                </svg>
                <span class="text">Add Your Own Review!</span>
                <span class="circle"></span>
                <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
                    <path
                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                    </path>
                </svg>
            </button>
            <div class="overlay" id="reviewOverlay">
                <form class="overlay-content" method="post">
                    <span class="closeBtn" id="closeOverlay">&times;</span>
                    <h2>Write your review</h2>
                    <div class="review-buttons" id="reviewButtons">
                        <div class="button" type="submit" name="reviewCategory" data-choice="Apex">
                            <div class="button-wrapper">
                                <div class="text">Apex</div>
                                <span class="icon">
                                    <img src="../public_html/media/website.png" alt="Website Icon">
                                </span>
                            </div>
                        </div>
                        <div class="button" type="submit" name="reviewCategory" data-choice="Comparison">
                            <div class="button-wrapper">
                                <div class="text">Comparison</div>
                                <span class="icon">
                                    <img src="../public_html/media/compare.png" alt="Website Icon">
                                </span>
                            </div>
                        </div>
                        <div class="button" type="submit" name="reviewCategory" data-choice="Search">
                            <div class="button-wrapper">
                                <div class="text">Search</div>
                                <span class="icon">
                                    <img src="../public_html/media/website.png" alt="Website Icon">
                                </span>
                            </div>
                        </div>
                        <div class="button" type="submit" name="reviewCategory" data-choice="Persona Test">
                            <div class="button-wrapper">
                                <div class="text">Persona Test</div>
                                <span class="icon">
                                    <img src="../public_html/media/test.png" alt="Website Icon">
                                </span>
                            </div>
                        </div>
                        <div class="button" type="submit" name="reviewCategory" data-choice="Turbo">
                            <div class="button-wrapper">
                                <div class="text">Turbo</div>
                                <span class="icon">
                                    <img src="../public_html/media/chatbot.png" alt="Website Icon">
                                </span>
                            </div>
                        </div>
                        <div class="button" type="submit" name="reviewCategory" data-choice="Apex Community">
                            <div class="button-wrapper">
                                <div class="text">ApexConnect</div>
                                <span class="icon">
                                    <img src="../public_html/media/social-media.png" alt="Website Icon">
                                </span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="reviewCategory" name="reviewCategory">
                    <textarea id="reviewText" placeholder="Write your review here..." name="reviewText"
                        required></textarea>
                    <div id="starRatingContainer" style="display: none;"></div>
                    <input type="hidden" id="starRating" name="starRating">
                    <input class="submitBtn" type="submit" id="submitReview" name="Submit">
                </form>
            </div>
        </div>
    </div>




    <div id="searchModal" class="search-modal-overlay">
        <div class="search-modal-content">
            <!-- Close Button -->
            <button class="search-modal-close-btn" id="closeSearchModalBtn">&times;</button>

            <!-- Search Content -->
            <h2>Search</h2>
            <input type="text" id="searchInput" class="search-modal-input" placeholder="Type here to search..." />
            <div id="searchResults" class="search-results-list"></div>
            <button id="searchSubmitBtn" class="search-modal-submit-btn"><span
                    class="material-symbols-outlined">search</span></button>
        </div>
    </div>

    <footer>
        <div class="footer-container">


            <div class="main-text-section">
                <h1 class="main-text">
                    GET IN T<span class="tire"><img class="tire" src="../public_html/media/tire.png"></span>UCH
                </h1>

            </div>

            <div class="footer-sections">
                <div class="about-us">
                    <h4>About Us</h4>
                    <p>We’re dedicated to revolutionizing the<br> way you find your perfect car. Our <br>AI-powered
                        platform
                        offers personalized <br>car recommendations tailored to your<br> preferences, budget, and
                        lifestyle. </p>
                </div>

                <div class="navigation">
                    <h4>Navigation</h4>
                    <ul>
                        <li class="nav"><a href="#">Home</a></li>
                        <li class="nav"><a href="..\app\views\user\car_comparison.php">Compare Cars</a></li>
                        <li class="nav"><a href="..\app\views\user\chatbot_mainPage.php">Turbo Chatbot</a></li>
                        <li class="nav"><a href="..\app\views\user\persona_test_landing_page.php">Persona Test</a></li>

                    </ul>
                </div>
                <span>
                    <h4>Social Media</h4>
                    <ul class="socials">
                        <li><a
                                href="https://accounts.google.com/v3/signin/identifier?elo=1&ifkv=AcMMx-feKYaT0FszQKn3DJ8ymV-9wmjlXgJFF5fYlczJUJhk7ZI3YEiop__7VgL1H0SNOPL1n1mO&ddm=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin&continue=https%3A%2F%2Faccounts.google.com%2FManageAccount%3Fnc%3D1">
                                <i class="icons fa-solid fa-envelope fa-xl"></i></a></li>
                        <li><a href="https://www.facebook.com/"><i class="icons fa-brands fa-facebook fa-xl"></i></a>
                        </li>
                        <li><a href="https://www.instagram.com/accounts/login/?hl=en"><i
                                    class="icons fa-brands fa-instagram fa-xl"></i></a></li>
                    </ul>
                </span>
            </div>
        </div>
    </footer>
    <script src="js/landing_page.js"></script>

</body>

</html>