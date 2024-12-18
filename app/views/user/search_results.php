<?php
require_once __DIR__ . '/../../config/db_config.php';

$make = isset($_GET['make']) ? $_GET['make'] : null;
$model = isset($_GET['model']) ? $_GET['model'] : null;
$year = isset($_GET['year']) ? $_GET['year'] : null;
$query = isset($_GET['query']) ? $_GET['query'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<h1>Search Results</h1>
<?php if (count($cars) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Type</th>
                <th>Engine</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $car): ?>
                <tr>
                    <td><?php echo htmlspecialchars($car['make']); ?></td>
                    <td><?php echo htmlspecialchars($car['model']); ?></td>
                    <td><?php echo htmlspecialchars($car['year']); ?></td>
                    <td><?php echo htmlspecialchars($car['type']); ?></td>
                    <td><?php echo htmlspecialchars($car['engine']); ?></td>
                    <td><?php echo htmlspecialchars($car['description']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No results found for your search.</p>
<?php endif; ?>

<body>

</body>

</html>