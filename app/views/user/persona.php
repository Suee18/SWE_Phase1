<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public_html/css/persona.css">
    <link rel="stylesheet" href="../../../public_html/css/userNavbar.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Your Persona</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=New+Amsterdam&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">

    <script src="../../../public_html/js/persona.js"></script>
    <title>Car Persona Results</title>
</head>

<body>
    <?php include '../../../public_html/components/userNavbar.php'; ?>

    <div class="content-container">
        <h2>Your Results</h2>
        <h4>Review your personality test results and learn more about your personality type and core traits.</h4>
    </div>

    <div class="persona-container">
        <div class="left-column">
            <h2>Your Car Persona</h2>
            <div class="persona-info">
                <img src="../../../public_html/media/Persona_Page_Images/icons/eco_warrior_icon.png" alt=""
                    class="persona-image">
                <div class="persona-title">
                    <h3>Eco-Warrior</h3>
                </div>
                <p>Eco-Warriors are environmentally conscious drivers who prioritize fuel efficiency and
                    sustainability. They prefer cars that minimize carbon footprints and promote a greener future.
                </p>
            </div>
        </div>
        <div class="right-column">
            <img src="../../../public_html/media/Persona_Page_Images/tesla-model-3.png" alt="Tesla Model 3"
                class="car-image">
            <div class="car-info">
                <h4>Your Perfect Match: Tesla Model 3</h4>
                <div class="car-preferences">
                    <h5>Key Preferences:</h5>
                    <ul>
                        <li>Electric powertrain for eco-conscious driving</li>
                        <li>Advanced technology and autopilot features</li>
                        <li>Minimalist interior design with premium materials</li>
                        <li>High safety ratings and innovative features</li>
                        <li>Excellent acceleration and performance</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="slider-container">
        <div class="persona-slider-section">
            <h2 class="header">Our Different Persona's</h2>

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
                </div>
            </div>
        </div>
    </div>

    <button class="animated-button open-modal-button">
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
</body>

</html>