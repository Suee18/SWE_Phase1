<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <title>Persona Quiz</title>
    <link rel="stylesheet" href="../../public_html/css/persona_test.css">
    <link rel="stylesheet" href="../../public_html/css/global_styles.css">
    <link rel="stylesheet" href="../../public_html/css/nav_bar.css">
</head>

<body>
    <?php include '../../public_html/components/nav_bar.php'; ?>

    <div class="background-images">
        <img src="../../public_html/media/Persona_Test_Images/Test_images/background.jpg" alt="Background Image 1"
            id="background-image-one">
        <img src="../../public_html/media/Persona_Test_Images/Test_images/background2.jpg" alt="Background Image 2"
            id="background-image-two">
    </div>

    <div class="swiper">
        <div class="swiper-wrapper">
            <!-- Question 1 -->
            <div class="swiper-slide">
                <div class="question-container">
                    <h1 class="question-number">Question 1</h1>
                    <p class="question-text">What is your primary use for a car?</p>
                    <div class="options-container-five">
                        <div class="first-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/commuting.png"
                                    alt="Commuting">
                                <p>Commuting in the City</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/family-icon.png"
                                    alt="Family Trips">
                                <p>Family Trips & daily school runs</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/long-road.png"
                                    alt="Long Road Trips">
                                <p>Long road trips or off-roading adventures</p>
                            </div>
                        </div>
                        <div class="second-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/fun-icon.png"
                                    alt="Driving">
                                <p>Enjoying the luxury of driving</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/i_don't_know.png"
                                    alt="Driving">
                                <p>I don't know</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Question 2 -->
            <div class="swiper-slide">
                <div class="question-container">
                    <h1 class="question-number">Question 2</h1>
                    <p class="question-text">How important is fuel efficiency to you?</p>
                    <div class="options-container-five">
                        <div class="first-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/electric-car-icon.png"
                                    alt="Electric Car">
                                <p>Extremely important - I want an electric/hybrid car</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/balance-icon.png"
                                    alt="Fairly Important">
                                <p>Fairly important - but I'm open to options</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/performance-icon.png"
                                    alt="Not a Priority">
                                <p>Not a priority - I focus more about performance</p>
                            </div>
                        </div>
                        <div class="second-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/driving-icon.png"
                                    alt="Driving Experience">
                                <p>Doesn't matter - I care more about the driving experience</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/i_don't_know.png"
                                    alt="Driving">
                                <p>I don't know</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="swiper-slide">
                <div class="question-container">
                    <h1 class="question-number">Question 3</h1>
                    <p class="question-text">How many passengers do you typically accommodate?</p>
                    <div class="options-container-five">
                        <div class="first-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/two-people-icon.png"
                                    alt="Two People">
                                <p>Just me or one other person</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/group-of-people-icon.png"
                                    alt="Group">
                                <p>3-4 people</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/family-icon.png"
                                    alt="Family">
                                <p>5 or more people</p>
                            </div>
                        </div>
                        <div class="second-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/flexible-icon.png"
                                    alt="Flexible">
                                <p>It depends on the occasion</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/i_don't_know.png"
                                    alt="Driving">
                                <p>I don't know</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="swiper-slide">
                <div class="question-container">
                    <h1 class="question-number">Question 4</h1>
                    <p class="question-text">What's your budget for a new car?</p>
                    <div class="options-container-five">
                        <div class="first-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/dollar-sign-icon.png"
                                    alt="Under $20,000">
                                <p>Under $20,000</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/price-tag-icon.png"
                                    alt="$20,000 - $50,000">
                                <p>$20,000 - $50,000</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/luxury-icon.png"
                                    alt="Over $50,000">
                                <p>Over $50,000</p>
                            </div>
                        </div>
                        <div class="second-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/money-bag-icon.png"
                                    alt="Money's No Issue">
                                <p>Money's no issue, I'm after</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/i_don't_know.png"
                                    alt="Driving">
                                <p>I don't know</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 5 -->
            <div class="swiper-slide">
                <div class="question-container">
                    <h1 class="question-number">Question 5</h1>
                    <p class="question-text">How important is having the latest technology in your car?</p>
                    <div class="options-container-five">
                        <div class="first-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/gadgets-icon.png"
                                    alt="Latest Gadgets">
                                <p>Very important - I want all the latest gadgets</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/bonus-icon.png"
                                    alt="Nice Bonus">
                                <p>It's a nice bonus but not essential</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/steering-wheel-icon.png"
                                    alt="Driving Mechanics">
                                <p>Not necessary - I'm more focused on driving mechanics</p>
                            </div>
                        </div>
                        <div class="second-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/safety-icon.png"
                                    alt="Practical Tech">
                                <p>I prefer practical tech for safety and convenience</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/i_don't_know.png"
                                    alt="Driving">
                                <p>I don't know</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 6 -->
            <div class="swiper-slide">
                <div class="question-container">
                    <h1 class="question-number">Question 6</h1>
                    <p class="question-text">What kind of road conditions do you usually drive on?</p>
                    <div class="options-container-five">
                        <div class="first-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/city-icon.png"
                                    alt="City">
                                <p>City streets and highways</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/countryside-icon.png"
                                    alt="Suburban">
                                <p>Suburban or rural roads</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/offroad-icon.png"
                                    alt="Rough Terrain">
                                <p>Rough terrain, off-road, or long-distance</p>
                            </div>
                        </div>
                        <div class="second-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/scenic-icon.png"
                                    alt="Scenic Drives">
                                <p>I love scenic and classic drives</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/i_don't_know.png"
                                    alt="Driving">
                                <p>I don't know</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 7 -->
            <div class="swiper-slide">
                <div class="question-container">
                    <h1 class="question-number">Question 7</h1>
                    <p class="question-text">How important is safety when choosing a car?</p>
                    <div class="options-container-five">
                        <div class="first-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/safety-icon.png"
                                    alt="Top Priority">
                                <p>It's my top priority</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/balance-icon.png"
                                    alt="Fairly Important">
                                <p>Fairly important - but I also consider performance</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/comfort-icon.png"
                                    alt="Comfort">
                                <p>Safety matters, but comfort and style come first</p>
                            </div>
                        </div>
                        <div class="second-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/fun-icon.png"
                                    alt="Fun Driving">
                                <p>Not a primary concern - I prioritize fun driving experience</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/i_don't_know.png"
                                    alt="Driving">
                                <p>I don't know</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 8 -->
            <div class="swiper-slide">
                <div class="question-container">
                    <h1 class="question-number">Question 8</h1>
                    <p class="question-text">Do you care about the environmental impact?</p>
                    <div class="options-container-five">
                        <div class="first-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/recycle-icon.png"
                                    alt="Sustainable Choices">
                                <p>Yes, I'm committed to sustainable choices</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/balance-icon.png"
                                    alt="Somewhat Important">
                                <p>Somewhat - but it's not my main concern</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/performance-icon.png"
                                    alt="Performance Focus">
                                <p>Not really - I care more about performance</p>
                            </div>
                        </div>
                        <div class="second-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/luxury-icon.png"
                                    alt="Luxury Preference">
                                <p>I'm more into classic aesthetics and luxury</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/i_don't_know.png"
                                    alt="Driving">
                                <p>I don't know</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 9 -->
            <div class="swiper-slide">
                <div class="question-container">
                    <h1 class="question-number">Question 9</h1>
                    <p class="question-text">What type of car body style do you prefer?</p>
                    <div class="options-container-five">
                        <div class="first-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/compact-car-icon.png"
                                    alt="Compact Cars">
                                <p>Compact cars or sedans</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/suv-icon.png"
                                    alt="SUVs or Minivans">
                                <p>SUVs or minivans</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/luxury-icon.png"
                                    alt="Luxury Sedans">
                                <p>Sleek, stylish luxury sedans or coupes</p>
                            </div>
                        </div>
                        <div class="second-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/sports-car-icon.png"
                                    alt="Sports Cars">
                                <p>Sports cars or performance vehicles</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/i_don't_know.png"
                                    alt="Driving">
                                <p>I don't know</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question 10 -->
            <div class="swiper-slide">
                <div class="question-container">
                    <h1 class="question-number">Question 10</h1>
                    <p class="question-text">How would you describe your ideal driving experience?</p>
                    <div class="options-container-five">
                        <div class="first-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/comfort-icon.png"
                                    alt="Quiet & Smooth">
                                <p>Quiet, smooth, and comfortable</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/family-icon.png"
                                    alt="Safe & Comfortable">
                                <p>Safe and comfortable for my family</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/luxury-icon.png"
                                    alt="Luxurious">
                                <p>Luxurious and tech-enhanced</p>
                            </div>
                        </div>
                        <div class="second-options-five">
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/sports-car-icon.png"
                                    alt="Fast & Exhilarating">
                                <p>Fast and exhilarating</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/classic-icon.png"
                                    alt="Nostalgic">
                                <p>Nostalgic and stylish</p>
                            </div>
                            <div class="option">
                                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/i_don't_know.png"
                                    alt="Driving">
                                <p>I don't know</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide last-slide">
                <img src="../../public_html/media/Persona_Test_Images/Test_Images/icons/persona-icon.png"
                    alt="Persona Icon" class="persona-icon" />
                <h3>Ready to see your results?</h3>
                <p class="subtext">Click below to unveil your persona!</p>
                <button class="submit-button">Find My Persona</button>
            </div>
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <div class="progress-bar-container">
        <div class="progress-bar"></div>
    </div>

    <script src="../../public_html/js/persona_test.js"></script>
</body>

</html>