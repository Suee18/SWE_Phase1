<?php
require_once __DIR__ . '/../../config/db_config.php';
require_once __DIR__ . '/../../../controllers/SearchController.php';
require_once __DIR__ . '/../../../controllers/FavoritesController.php';
include_once __DIR__ . '/../../../controllers/UserControllers.php';
SessionManager::startSession();

$make = isset($_GET['make']) ? $_GET['make'] : null;
$model = isset($_GET['model']) ? $_GET['model'] : null;
$year = isset($_GET['year']) ? $_GET['year'] : null;
$query = isset($_GET['query']) ? $_GET['query'] : null;

$cars = [];

$user = SessionManager::getUser() ? SessionManager::getUser()->id : 0;

if ($make && $model && $year) {
    // Call the searchResults function directly for specific car
    $cars = searchResults($make, $model, $year);
} elseif ($query) {
    // Call the searchDropList function for general search query
    $cars = searchDropList($query);
}

$favoritesController = new FavoritesController($conn);

foreach ($cars as &$car) {
    $car['isFavorite'] = $favoritesController->checkIfFavoriteExists($car['ID'], $user);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../SWE_Phase1/public_html/css/search.css">
    <title>Search Results</title>
    <script>
        function toggleFavorite(checkbox, carId) {
            const userId = <?php echo $user; ?>;
            if (userId === 0) {
                checkbox.checked = !checkbox.checked;
                return;
            }

            const action = checkbox.checked ? 'add' : 'remove';

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../../../controllers/FavoritesController.php', true);

            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        console.log(response.message);
                    } else {
                        alert('An error occurred. Please try again.');
                        checkbox.checked = !checkbox.checked;
                    }
                }
            };
            xhr.send('carId=' + carId + '&userId=' + userId + '&action=' + action);
        }
    </script>
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
                    <div class="info-left">
                        <h3><?php echo htmlspecialchars($car['make']) . ' ' . htmlspecialchars($car['model']); ?></h3>
                        <p>Year: <?php echo htmlspecialchars($car['year']); ?></p>
                        <img src="../../../public_html/media/Car_Comparison_Page_Images/<?php echo $car['image']; ?>"
                            alt="<?php echo $car['make'] . ' ' . $car['model']; ?>">
                    </div>

                    <?php if ($user): ?>
                        <div class="con-like">
                            <input class="like" type="checkbox" title="like" onchange="toggleFavorite(this, <?php echo $car['ID']; ?>)"
                                <?php echo $car['isFavorite'] ? 'checked' : ''; ?>
                                <?php echo $car['isFavorite'] ? 'checked' : ''; ?>>
                            <div class="checkmark">
                                <svg xmlns="http://www.w3.org/2000/svg" class="outline" viewBox="0 0 24 24">
                                    <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="filled" viewBox="0 0 24 24">
                                    <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"></path>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" class="celebrate">
                                    <polygon class="poly" points="10,10 20,20"></polygon>
                                    <polygon class="poly" points="10,50 20,50"></polygon>
                                    <polygon class="poly" points="20,80 30,70"></polygon>
                                    <polygon class="poly" points="90,10 80,20"></polygon>
                                    <polygon class="poly" points="90,50 80,50"></polygon>
                                    <polygon class="poly" points="80,80 70,70"></polygon>
                                </svg>
                            </div>
                        </div>
                    <?php endif; ?>

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
            <?php endforeach; ?>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>

</body>

</html>