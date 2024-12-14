<?php
include_once __DIR__ . '\..\..\config\db_config.php';
include __DIR__ . '\..\..\..\models\ReviewsClass.php';
include __DIR__ . '\..\..\..\models\UsersClass.php';
include_once __DIR__ . '\..\..\..\controllers\SessionManager.php';
$reviewsSliderArray = Reviews::getLastNumberOfReviews(7);

if (isset($_POST['Submit'])) {
    $reviewText = mysqli_real_escape_string($conn, htmlspecialchars($_POST['reviewText']));
    $reviewCategory = mysqli_real_escape_string($conn, htmlspecialchars($_POST['reviewCategory']));
    $reviewDate = date('Y-m-d H:i:s');

    $user = SessionManager::getUser();
    $userID = $user ? $user['ID'] : null;

    $reviewUserName = "Anonymous";

    $review = new Reviews($reviewText, $reviewCategory, $reviewDate, 5, $userID);
    $result = $review->addReviewIntoDB($review);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../public_html/css/landing_page.css">
    <link rel="stylesheet" href="../public_html/css/global_styles.css">
    <link rel="stylesheet" href="../public_html/css/nav_bar.css">
    <link rel="stylesheet" href="../public_html/css/car_card.css">
    <link rel="stylesheet" href="../public_html/css/footer.css"> -->

    <link rel="stylesheet" href="css/landing_page.css">
    <link rel="stylesheet" href="css/global_styles.css">
    <link rel="stylesheet" href="css/footer.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
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
                <!-- static -->
                <?php include __DIR__ . '/../../../public_html/components/car_card.php'; ?>
            </div>
        </div>

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
                            foreach ($reviewsSliderArray as $review) {
                                echo '<div class="swiper-slide">
                                <div class="review-card">
                                    <h4 class="reviewUserName">' . 'Anonymous' . '</h4>
                                    <p class="review-paragraph">"' . htmlspecialchars($review->reviewText) . '"</p>
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
                                        <img src=" ../public_html/media/website.png" alt="Website Icon">
                                    </span>
                                </div>
                            </div>
                            <div class="button" type="submit" name="reviewCategory" data-choice="Comparison">
                                <div class="button-wrapper">
                                    <div class="text">Comparison</div>
                                    <span class="icon">
                                        <img src=" ../public_html/media/compare.png" alt="Website Icon">
                                    </span>
                                </div>
                            </div>
                            <div class="button" type="submit" name="reviewCategory" data-choice="Search">
                                <div class="button-wrapper">
                                    <div class="text">Search</div>
                                    <span class="icon">
                                        <img src=" ../public_html/media/website.png" alt="Website Icon">
                                    </span>
                                </div>
                            </div>
                            <div class="button" type="submit" name="reviewCategory" data-choice="Persona Test">
                                <div class="button-wrapper">
                                    <div class="text">Persona Test</div>
                                    <span class="icon">
                                        <img src=" ../public_html/media/test.png" alt="Website Icon">
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
                        <textarea id="reviewText" placeholder=" Write your review here..." name="reviewText"
                            required></textarea>
                        <input type="hidden" id="reviewCategory" name="reviewCategory" value="">
                        <input class="submitBtn" type="submit" id="submitReview" name="Submit">
                    </form>
                </div>
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
                            <li class="nav"><a href="#">Compare Cars</a></li>
                            <li class="nav"><a href="#">Turbo Chatbot</a></li>
                            <li class="nav"><a href="#">Persona Test</a></li>

                        </ul>
                    </div>
                    <span>
                        <h4>Social Media</h4>
                        <ul class="socials">
                            <li><a
                                    href="https://accounts.google.com/v3/signin/identifier?elo=1&ifkv=AcMMx-feKYaT0FszQKn3DJ8ymV-9wmjlXgJFF5fYlczJUJhk7ZI3YEiop__7VgL1H0SNOPL1n1mO&ddm=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin&continue=https%3A%2F%2Faccounts.google.com%2FManageAccount%3Fnc%3D1">
                                    <i class="icons fa-solid fa-envelope fa-xl"></i></a></li>
                            <li><a href="https://www.facebook.com/"><i
                                        class="icons fa-brands fa-facebook fa-xl"></i></a></li>
                            <li><a href="https://www.instagram.com/accounts/login/?hl=en"><i
                                        class="icons fa-brands fa-instagram fa-xl"></i></a></li>
                        </ul>
                    </span>
                </div>
            </div>
        </footer>

        <script src="../public_html/js/landing_page.js"></script>
</body>

</html>