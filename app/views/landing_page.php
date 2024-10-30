<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/landing_page.css">
    <link rel="stylesheet" href="css/global_styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <title>Landing Page</title>
</head>

<body>
    <?php include './components/nav_bar.php'; ?>

    <div class="slideShowContainer_lp">

        <!-- Slide 1 -->
        <div class="slide" id="slide1">
            <div class="videoBG_lp">
                <video autoplay muted loop class="slide-bg" id="myVideo">
                    <source src="media/BMWM5CS.mp4" type="video/mp4">
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
            <img src="media/thisOrThat.png" class="slide-bg" alt="Image Background">

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
                    <source src="media/astonmartin.mp4" type="video/mp4">
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
            <?php include './components/car_card.php'; ?>
        </div>



    </div>


    <!----------------PART 3:Reviews--------------------------->
    <div class="landingPage_part3">
        <div class="partsTitles_lp">
            <P class="reviewsTitle_lp">
                Reviews
            </P>
        </div>
        <div class="reviews-section">
            <h2 class="header">What our Clients say!</h2>

            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="review-card">

                            <h4>Sarah Johnson</h4>
                            <p class="review-paragraph">"I was really impressed with how easy it was to find the perfect car for my needs. The website recommended exactly what I was looking for based on my preferences. Highly recommend!"</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">

                            <h4>Mark Thompson</h4>
                            <p class="review-paragraph">"The comparison tool is fantastic! It helped me weigh the pros and cons of different models in a very user-friendly way. Will definitely use this again when I’m ready for my next car."</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">

                            <h4>Emily Carter</h4>
                            <p class="review-paragraph">"Absolutely love the personalized recommendations. The system picked out cars that matched my criteria and even gave detailed reviews. It made my buying decision so much easier!".</p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="review-card">

                            <h4>John Smith</h4>
                            <p class="review-paragraph">"Great tool for comparing cars, but I would have liked a bit more detail on each model’s specs. Still, it helped narrow down my choices quickly."</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">

                            <h4>Jessica Davis</h4>
                            <p class="review-paragraph">"This site is a game-changer! It gave me personalized options that I wouldn't have considered otherwise. The chatbot was also very helpful in answering my questions in real-time."</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">

                            <h4>Michael Brown</h4>
                            <p class="review-paragraph">"Really helpful website with solid comparisons. I was able to find a few cars that fit my budget and needs. I appreciate the transparency of the reviews."</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">

                            <h4>Olivia Martinez</h4>
                            <p class="review-paragraph">"I can't believe how easy it was to find the best car for my family. The site not only recommended cars but also explained the features I cared about most. Definitely a time-saver!"</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">

                            <h4> David Wilson</h4>
                            <p class="review-paragraph">"Great platform! The comparison tool is intuitive, and I appreciated the detailed breakdowns of each car's performance, safety, and fuel efficiency."</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">

                            <h4>Chloe Lee</h4>
                            <p class="review-paragraph">"I’ve used a few car recommendation websites before, but this one takes the cake. The personalized approach made me feel like I was really taken into consideration. Will be back for future car buying!"</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">

                            <h4>Ryan Harris</h4>
                            <p class="review-paragraph">"Good site, but I found that some of the recommendations were a bit off the mark for my needs. That said, the comparison feature is really solid."</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">
                            <h4>Lauren Miller</h4>
                            <p class="review-paragraph">"I was skeptical at first, but this website really knows its cars. The recommendations were spot-on and helped me make a decision faster than I thought possible."</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-card">

                            <h4>Daniel Wilson</h4>
                            <p class="review-paragraph">"Very helpful website. It gave me a list of cars that suited my driving habits and budget. The only downside was that I had to sign up to access some features, but it was worth it."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="reviewBtn" id="openOverlay">Add your own review!</button>

        <div class="overlay" id="reviewOverlay">
        <div class="overlay-content">
            <span class="closeBtn" id="closeOverlay">&times;</span>
            <h2>Write your review</h2>
            <textarea id="reviewText" placeholder=" Write your review here..."></textarea>
            <button class="submitBtn" id="submitReview">Submit</button>
        </div>
    </div>

    <script src="js/landing_page.js"></script>
</body>

</html>