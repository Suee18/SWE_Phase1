<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <link rel="stylesheet" href="../../../public_html/css/car_comparison.css">
    <link rel="stylesheet" href="../../../public_html/css/userNavbar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=New+Amsterdam&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <title>Compare Cars Now!</title>
    <script src="http://localhost/project/SWE_Phase1/SWE_Phase1/public_html/js/car_comparison.js"></script>

</head>

<body>
    <?php include '../../../public_html/components/userNavbar.php'; ?>

    <div id="comparing-cars-banner">
        <h1>Compare Cars Models</h1>
        <p>Discover and compare different car models
            to find the best one that suits your needs. <br> Our comparison
            tool provides detailed specifications,
            features, and reviews<br> to help you make an informed decision.</p>
    </div>
<div class="gradientBG">
    <div class="comparison-section">
        <div class="car-card">
            <div class="car-image">
                <img src="../../../public_html/media/Car_Comparison_Page_Images/left-comparison-car.png" alt="First Car">
            </div>
            <div class="car-details">
                <p class="car-details-title">Add first car</p>
                <form>
                <div class="form-group">
    <label for="make1">Make</label>
    <select id="make1">
        <option value="">Choose a Make</option>
    </select>
</div>
<div class="form-group">
    <label for="model1">Model</label>
    <select id="model1" disabled>
        <option value="">Choose a Model</option>
    </select>
</div>
<div class="form-group">
    <label for="year1">Year</label>
    <select id="year1" disabled>
        <option value="">Choose a Year</option>
    </select>
</div>

                </form>
            </div>
        </div>

        <div class="car-card">
            <div class="car-image">
                <img src="../../../public_html/media/Car_Comparison_Page_Images/right-comparison-car.png" alt="Second Car">
            </div>
            <div class="car-details">
                <p class="car-details-title">Add second car</p>
                <form>
                <div class="form-group">
    <label for="make2">Make</label>
    <select id="make2">
        <option value="">Choose a Make</option>
    </select>
</div>
<div class="form-group">
    <label for="model2">Model</label>
    <select id="model2" disabled>
        <option value="">Choose a Model</option>
    </select>
</div>
<div class="form-group">
    <label for="year2">Year</label>
    <select id="year2" disabled>
        <option value="">Choose a Year</option>
    </select>
</div>

                </form>
            </div>
        </div>


    </div>
    <script>
    async function handleCompare() {
    const make1 = document.getElementById("make1").value;
    const model1 = document.getElementById("model1").value;
    const year1 = document.getElementById("year1").value;
    const make2 = document.getElementById("make2").value;
    const model2 = document.getElementById("model2").value;
    const year2 = document.getElementById("year2").value;

    if (!make1 || !model1 || !year1 || !make2 || !model2 || !year2) {
        alert("Please select Make, Model, and Year for both cars.");
        return;
    }

    try {
        const carDetails1 = await fetchCarDetails(make1, model1, year1);
        const carDetails2 = await fetchCarDetails(make2, model2, year2);

        if (carDetails1 && carDetails2) {
            updateComparisonGrid(carDetails1, carDetails2);
            document.getElementById("comparison-modal").style.display = "flex"; // Show modal
        } else {
            alert("Failed to fetch car details for comparison.");
        }
    } catch (error) {
        console.error('Error during comparison:', error);
    }
}

</script>
<button id="compareBtn" class="btn" onclick="handleCompare()">Compare Cars</button>
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


    <div id="comparisonModal" class="overlay">
        <div class="modal-content">
            <button class="close-button" onclick="toggleModal()">&times;</button>
            <div class="car-comparison-section">
                <h2 class="comparisonResultsTitle">Comparison Result</h2>
                <div class="comparison-grid">
                </div>
            </div>
        </div>
    </div>
    <button class="open-modal-button">Open Modal</button>


</body>

</html>