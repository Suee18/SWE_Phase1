<?php
include_once 'C:\xampp\htdocs\SWE Project\SWE_Phase1\app\config\db_config.php';
include 'C:\xampp\htdocs\SWE Project\SWE_Phase1\models\ReviewsClass.php';

$reviewsSliderArray = Reviews::getLastNumberOfReviews(7);

if (isset($_POST['Submit'])) {
    $reviewText = mysqli_real_escape_string($conn, htmlspecialchars($_POST['reviewText']));
    $reviewDate = date('Y-m-d H:i:s');
    $reviewUserName = "Anonymous";

    $review = new Reviews($reviewText, $reviewDate, $reviewUserName);
    $result = $review->addReviewIntoDB($review);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public_html/css/landing_page.css">
    <link rel="stylesheet" href="../public_html/css/global_styles.css">
    <link rel="stylesheet" href="../public_html/css/nav_bar.css">
    <link rel="stylesheet" href="../public_html/css/car_card.css">
    <!-- <link rel="stylesheet" href="../public_html/css/footer.css"> -->
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
            <img src="path_to_your_image3.jpg" class="slide-bg" alt="Image Background">
            <div class="text-overlay">
                <p class="slide4Title_lp">Discover latest news, and read authentic reviews.</p>
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
        <div class="partsTitles_lp">
            <P class="mostRecommendedCarsTitle_lp">
                most recommended Cars
            </P>
        </div>

        <div class="carCardsContainer_lp">
            <!-- static -->
            <?php include 'C:/xampp/htdocs/SWE Project/SWE_Phase1/public_html/components/car_card.php'; ?>
        </div>
    </div>


<!----------------PART 3:Reviews--------------------------->
<div class="landingPage_part3">
    <div class="partsTitles_lp">
        <p class="reviewsTitle_lp">Reviews</p>
    </div>
    <div class="reviews-section">
        <h2 class="header">What our Clients say!</h2>

        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                foreach ($reviewsSliderArray as $review) {
                    echo '<div class="swiper-slide">
                            <div class="review-card">
                                <h4>' . htmlspecialchars($review->reviewUserName, ENT_QUOTES, 'UTF-8') . '</h4>
                                <p class="review-paragraph">' . htmlspecialchars($review->reviewText, ENT_QUOTES, 'UTF-8') . '</p>
                            </div>
                          </div>';
                }
                ?>
            </div>
        </div>
    </div>
    <button class="reviewBtn" id="openOverlay">Add your own review!</button>

    <div class="overlay" id="reviewOverlay">
        <form class="overlay-content" method="post">
            <span class="closeBtn" id="closeOverlay">&times;</span>
            <h2>Write your review</h2>
            <textarea id="reviewText" placeholder=" Write your review here..." name="reviewText" required></textarea>
            <input class="submitBtn" type="submit" id="submitReview" name="Submit" value="Submit">
        </form>
    </div>
</div>


        <!-- Footer Section -->
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
                  <p>We’re dedicated to revolutionizing the<br> way you find your perfect car. Our <br>AI-powered platform 
                   offers personalized <br>car recommendations tailored to your<br> preferences, budget, and lifestyle. </p>
                </div>

      <div class="navigation">
        <h4>Navigation</h4>
        <ul>
          <li class="nav"><a href="#">Home</a></li>
          <li class="nav"><a href="#">Compare Cars</a></li>
     
        </ul>
      </div>
      <span>
        <h4>Social Media</h4>
        <ul  class="socials">
          <li><a href="#"><i class="icons fa-solid fa-envelope fa-xl"></i></a></li>
          <li><a href="#"><i class="icons fa-brands fa-facebook fa-xl"></i></a></li>
          <li><a href="#"><i class="icons fa-brands fa-instagram fa-xl"></i></a></li>
        </ul>
                </span>
   
</footer>

        <script src="../public_html/js/landing_page.js"></script>
</body>

</html>