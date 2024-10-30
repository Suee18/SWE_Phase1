<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <link rel="stylesheet" href="../../public_html/css/car_comparison.css">
    <link rel="stylesheet" href="../../public_html/css/global_styles.css">
    <link rel="stylesheet" href="../../public_html/css/nav_bar.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=New+Amsterdam&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <title>Compare Cars Now!</title>
    <script src="../../public_html/js/car_comparison.js"></script>

</head>

<body>
    <?php include '../../public_html/components/nav_bar.php'; ?>

    <div id="comparing-cars-banner">
        <h1>Compare Cars Models</h1>
        <p>Discover and compare different car models
            to find the best one that suits your needs. <br> Our comparison
            tool provides detailed specifications,
            features, and reviews to help you make an informed decision.</p>
    </div>

    <div class="comparison-section">
        <div class="car-card">
            <div class="car-image">
                <img src="../../public_html/media/Car_Comparison_Page_Images/left-comparison-car.png" alt="First Car">
            </div>
            <div class="car-details">
                <h2 class="car-details-title">Add first car</h2>
                <form>
                    <div class="form-group">
                        <label for="make1">Make</label>
                        <select id="make1">
                            <option>Choose a make</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="model1">Model</label>
                        <select id="model1">
                            <option>Choose a model</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year1">Year</label>
                        <select id="year1">
                            <option>Choose a year</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="car-card">
            <div class="car-image">
                <img src="../../public_html/media/Car_Comparison_Page_Images/right-comparison-car.png" alt="Second Car">
            </div>
            <div class="car-details">
                <h2>Add second car</h2>
                <form>
                    <div class="form-group">
                        <label for="make2">Make</label>
                        <select id="make2">
                            <option>Choose a make</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="model2">Model</label>
                        <select id="model2">
                            <option>Choose a model</option>
                            <!-- Add more car models here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year2">Year</label>
                        <select id="year2">
                            <option>Choose a year</option>
                            <!-- Add more years here -->
                        </select>
                    </div>
                </form>
            </div>
        </div>


    </div>

    <button class="animated-button open-modal-button">
        <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
            <path
                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
            </path>
        </svg>
        <span class="text">Compare Now</span>
        <span class="circle"></span>
        <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
            <path
                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
            </path>
        </svg>
    </button>


    <div class="car-comparison-section">
        <h2>Quick Look</h2>
        <div class="comparison-grid">
            <div class="feature-item"></div>
            <div class="car-column">
                <h3>Car 1</h3>
            </div>
            <div class="car-column">
                <h3>Car 2</h3>
            </div>

            <div class="feature-item">
                <img src="../../public_html/media/Car_Comparison_Page_Images/car_comparison_icons/fuel_type.png"
                    alt="Engine Fuel Type Icon" class="icon">
                <p>Engine Fuel Type</p>
            </div>
            <div class="car-column">
                <p>Gasoline</p>
            </div>
            <div class="car-column">
                <p>Diesel</p>
            </div>

            <div class="feature-item">
                <img src="../../public_html/media/Car_Comparison_Page_Images/car_comparison_icons/horse_power.png"
                    alt="Engine HP Icon" class="icon">
                <p>Engine HP</p>
            </div>
            <div class="car-column">
                <p>250 HP</p>
            </div>
            <div class="car-column">
                <p>300 HP</p>
            </div>

            <div class="feature-item">
                <img src="../../public_html/media/Car_Comparison_Page_Images/car_comparison_icons/engine_cylinders.png"
                    alt="Engine Cylinders Icon" class="icon">
                <p>Engine Cylinders</p>
            </div>
            <div class="car-column">
                <p>4 Cylinders</p>
            </div>
            <div class="car-column">
                <p>6 Cylinders</p>
            </div>

            <div class="feature-item">
                <img src="../../public_html/media/Car_Comparison_Page_Images/car_comparison_icons/transmission_type.png"
                    alt="Transmission Type Icon" class="icon">
                <p>Transmission Type</p>
            </div>
            <div class="car-column">
                <p>Automatic</p>
            </div>
            <div class="car-column">
                <p>Manual</p>
            </div>

            <div class="feature-item">
                <img src="../../public_html/media/Car_Comparison_Page_Images/car_comparison_icons/wheels.png"
                    alt="Driven Wheels Icon" class="icon">
                <p>Driven Wheels</p>
            </div>
            <div class="car-column">
                <p>Front Wheel Drive</p>
            </div>
            <div class="car-column">
                <p>All Wheel Drive</p>
            </div>

            <div class="feature-item">
                <img src="../../public_html/media/Car_Comparison_Page_Images/car_comparison_icons/car_doors.png"
                    alt="No. of Doors Icon" class="icon">
                <p>No. of Doors</p>
            </div>
            <div class="car-column">
                <p>4</p>
            </div>
            <div class="car-column">
                <p>2</p>
            </div>

            <div class="feature-item">
                <img src="../../public_html/media/Car_Comparison_Page_Images/car_comparison_icons/market_category.png"
                    alt="Market Category Icon" class="icon">
                <p>Market Category</p>
            </div>
            <div class="car-column">
                <p>Luxury, Performance</p>
            </div>
            <div class="car-column">
                <p>Economy, Compact</p>
            </div>

            <div class="feature-item">
                <img src="../../public_html/media/Car_Comparison_Page_Images/car_comparison_icons/vehicle_size.png"
                    alt="Vehicle Size Icon" class="icon">
                <p>Vehicle Size</p>
            </div>
            <div class="car-column">
                <p>Midsize</p>
            </div>
            <div class="car-column">
                <p>Compact</p>
            </div>

            <div class="feature-item">
                <img src="../../public_html/media/Car_Comparison_Page_Images/car_comparison_icons/vehicle_style.png"
                    alt="Vehicle Style Icon" class="icon">
                <p>Vehicle Style</p>
            </div>
            <div class="car-column">
                <p>Sedan</p>
            </div>
            <div class="car-column">
                <p>SUV</p>
            </div>

            <div class="feature-item">
                <img src="../../public_html/media/Car_Comparison_Page_Images/car_comparison_icons/msrp.png"
                    alt="MSRP Icon" class="icon">
                <p>MSRP</p>
            </div>
            <div class="car-column">
                <p>$40,000</p>
            </div>
            <div class="car-column">
                <p>$35,000</p>
            </div>
        </div>
    </div>

    <!-- <div id="comparison-modal">
        <span class="close-button">&times;</span>
        <h3 class="modal-header">Check Out The Specs</h3>

        <div class="comparison-slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="spec-card">
                            <h4>Engine Fuel Type</h4>
                            <p class="spec-value">Gasoline</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="spec-card">
                            <h4>Engine HP</h4>
                            <p class="spec-value">250 HP</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="spec-card">
                            <h4>Engine Cylinders</h4>
                            <p class="spec-value">6 Cylinders</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="spec-card">
                            <h4>Transmission Type</h4>
                            <p class="spec-value">Automatic</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="spec-card">
                            <h4>Driven Wheels</h4>
                            <p class="spec-value">AWD</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="spec-card">
                            <h4>No. Of Doors</h4>
                            <p class="spec-value">4 Doors</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="spec-card">
                            <h4>Market Category</h4>
                            <p class="spec-value">SUV</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="spec-card">
                            <h4>Vehicle Size</h4>
                            <p class="spec-value">Mid-size</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="spec-card">
                            <h4>Vehicle Style</h4>
                            <p class="spec-value">Crossover</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="spec-card">
                            <h4>MSRP</h4>
                            <p class="spec-value">$35,000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


</body>

</html>