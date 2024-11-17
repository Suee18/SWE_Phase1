<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public_html/css/favorites.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Favorite Cars</title>
</head>
<div class="nav">
    <?php include '../../../public_html/components/userNavbar.php'; ?>

</div>

<body>
    <div class="fav_cars">

        <div class="partsTitles_lp">
            <P class="mostRecommendedCarsTitle_lp">
                Favorite Cars </P>
        </div>

        <div class="carCardsContainer_lp">
            <?php include '../../../public_html/components/favorites_car_card.php'; ?>
        </div>



    </div>
</body>