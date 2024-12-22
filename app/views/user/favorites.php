<?php
require_once __DIR__ . '/../../../middleware/user_auth.php';
user_auth("Favorites");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public_html/css/favorites.css">
    <link rel="stylesheet" href="../../../public_html/css/car_card.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../../../public_html/js/favorites.js" defer></script>
    <title>Favorite Cars</title>
</head>


<body>
    <?php include '../../../public_html/components/userNavbar.php'; ?>
    <div class="fav_cars">
        <h1>Favorite Cars</h1>
        <div class="carCardsContainer_lp">
            <?php include __DIR__ . '/../../../public_html/components/car_card.php'; ?>
        </div>

    </div>
</body>