<?php
require_once __DIR__ . '/../../config/db_config.php';
require_once __DIR__ . '/../../../controllers/SearchController.php'; // Include the controller

$make = isset($_GET['make']) ? $_GET['make'] : null;
$model = isset($_GET['model']) ? $_GET['model'] : null;
$year = isset($_GET['year']) ? $_GET['year'] : null;
$query = isset($_GET['query']) ? $_GET['query'] : null;

// Initialize an empty array for cars
$cars = [];

if ($make && $model && $year) {
    // Call the searchResults function directly for specific car
    $cars = searchResults($make, $model, $year);
} elseif ($query) {
    // Call the searchDropList function for general search query
    $cars = searchDropList($query);
}

// At this point, $cars contains the search results
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../SWE_Phase1/public_html/css/search.css">
    <title>Search Results</title>
</head>

<body>

    <?php include "../../../public_html/components/userNavbar.php" ?>

    <div class="filter-container">
        <form action="search_results.php" method="get">
            <input type="text" name="query" placeholder="Search by Make, Model, or Year"
                value="<?php echo htmlspecialchars($query); ?>" />
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="search-results-container">
        <h1>Search Results</h1>

        <?php if (count($cars) > 0): ?>
            <?php foreach ($cars as $car): ?>
                <div class="result-card">
                    <!-- Car Info (Make, Model, Year) and Image Section -->
                    <div class="info-left">
                        <h3><?php echo htmlspecialchars($car['make']) . ' ' . htmlspecialchars($car['model']); ?></h3>
                        <p>Year: <?php echo htmlspecialchars($car['year']); ?></p>
                        <img src="../../../public_html/media/Car_Comparison_Page_Images/<?php echo $car['image']; ?>"
                            alt="<?php echo $car['make'] . ' ' . $car['model']; ?>">
                    </div>

                    <!-- Car Details (Type, Engine, Price, Horse Power, Description) Section -->
                    <div class="info-right">
                        <div class="grid-item">
                            <strong>Type</strong>
                            <p><?php echo htmlspecialchars($car['type']); ?></p>
                        </div>
                        <div class="grid-item">
                            <strong>Engine</strong>
                            <p><?php echo htmlspecialchars($car['Engine']); ?></p>
                        </div>
                        <div class="grid-item">
                            <strong>Price</strong>
                            <p><?php echo htmlspecialchars($car['price']); ?> USD</p>
                        </div>
                        <div class="grid-item">
                            <strong>Horse Power</strong>
                            <p><?php echo htmlspecialchars($car['horsePower']); ?> HP</p>
                        </div>
                        <div class="grid-item">
                            <strong>Cylinders</strong>
                            <p><?php echo htmlspecialchars($car['cylinders']); ?></p>
                        </div>
                        <div class="grid-item">
                            <strong>Description</strong>
                            <p><?php echo htmlspecialchars($car['description']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
    </div>


</body>

</html>