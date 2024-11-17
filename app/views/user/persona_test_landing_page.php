<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=New+Amsterdam&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">

    <title>Car Recommendation App</title>
    <link rel="stylesheet" href="../../../public_html/css/persona_test_landing_page.css">
    <link rel="stylesheet" href="../../../public_html/css/userNavbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="../../../public_html/js/persona_test_landing_page.js" defer></script>
</head>

<body>

    <?php include '../../../public_html/components/userNavbar.php'; ?>
    <div class="landing-page">
        <div class="content">
            <h1>Discover Your Perfect Car Persona.</h1>
            <p>Ready to find the car that fits your lifestyle? Take our quick quiz to reveal your unique car persona and
                get personalized recommendations. Whether you're into speed, tech, eco-friendliness, or something else,
                we’ve got you covered.</p>
            <a href="persona_test.php" class="cta-button">Find My Car</a>
        </div>
        <div class="image-container">
            <img src="../../../public_html/media/Persona_Test_Images/Landing/red-car.jpg" alt="Car" />
        </div>
    </div>

    <div class="slider-container">
        <div class="persona-slider-section">
            <h2 class="header">Discover Your Car Persona</h2>

            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="persona-card">
                            <img src="../../../public_html/media/Persona_Test_Images/Landing/icons/eco-warrior-icon.png"
                                alt="Eco-Warrior Icon" class="persona-icon">
                            <h4>Eco-Warrior</h4>
                            <p class="persona-paragraph">Focuses on eco-conscious vehicles like electric & hybrid cars,
                                prioritizing sustainability and efficiency</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="persona-card">
                            <img src="../../../public_html/media/Persona_Test_Images/Landing/icons/family-first-icon.png"
                                alt="Family First Icon" class="persona-icon">
                            <h4>Family First</h4>
                            <p class="persona-paragraph">Prioritizes spacious, safe vehicles for family use, typically
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
                            <p class="persona-paragraph">Wants cutting-edge tech in the car, such as autopilot, driver
                                assistance, and smart connectivity</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="persona-card">
                            <img src="../../../public_html/media/Persona_Test_Images/Landing/icons/performance-enthusiast-icon.png"
                                alt="Performance Enthusiast Icon" class="persona-icon">
                            <h4>Performance Enthusiast</h4>
                            <p class="persona-paragraph">Prefers high-performance cars with a focus on speed, handling,
                                &
                                acceleration</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="persona-card">
                            <img src="../../../public_html/media/Persona_Test_Images/Landing/icons/budget-conscious-icon.png"
                                alt="Budget Conscious Icon" class="persona-icon">
                            <h4>Budget Conscious</h4>
                            <p class="persona-paragraph">Focuses on affordability, looking for the best value within a
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

    <div class="third-section">
        <div class="image-container">
            <img src="../../../public_html/media/Persona_Test_Images/Landing/classic-car.jpg" alt="Car" />
        </div>
        <div class="content">
            <h1>Uncover Your Ideal Car Match..</h1>
            <p>Curious about which car suits your lifestyle best? Take our short quiz to discover your unique car
                persona and receive tailored suggestions. Whether you’re drawn to performance, technology,
                sustainability, or another feature, we’ve got the perfect fit for you.</p>
            <a href="persona_test.php" class="cta-button">Find My Car</a>
        </div>
    </div>
</body>

</html>