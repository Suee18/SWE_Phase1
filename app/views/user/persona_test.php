<?php
include '../../../controllers/persona_test.php';
require_once '../../../app/config/db_config.php';


try {
    // Create a database connection and instantiate the controller
    $controller = new PersonasController($conn);
    // Access questions dynamically
    $questions = $controller->questions; 
} catch (Exception $e) {
    die("Error loading questions: " . htmlspecialchars($e->getMessage()));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="icon" href="../../../public_html/media/persona-icon.png" alt="persona-icon" />
    <title>Personality Test</title>
    <link rel="stylesheet" href="../../../public_html/css/persona_test.css">
    <link rel="stylesheet" href="../../../public_html/css/global_styles.css">
    <link rel="stylesheet" href="../../../public_html/css/userNavbar.css">
</head>

<body>
    <?php include '../../../public_html/components/userNavbar.php'; ?>

    <div class="background-images"></div>

    <form method="POST" action="../../../controllers/persona_test.php">
        <div class="swiper">
            <div class="swiper-wrapper">

                <?php
                foreach ($questions as $questionId => $questionData) : ?>
                    <!-- Individual Question Slide -->
                    <div class="swiper-slide">
                        <div class="question-container">
                            <h1 class="question-number">Question <?= $questionId; ?></h1>
                            <p class="question-text"><?= htmlspecialchars($questionData['question']); ?></p>
                            <div class="options-container-five">
                                <?php
                                $answers = $questionData['answers'];
                                $firstHalf = array_slice($answers, 0, ceil(count($answers) / 2), true);
                                $secondHalf = array_slice($answers, ceil(count($answers) / 2), null, true);
                                ?>

                                <!-- First Half of Answers -->
                                <div class="first-options-five">
                                    <?php foreach ($firstHalf as $optionKey => $answerData) : ?>
                                        <label class="option">
                                            <input type="radio" name="answers[<?= $questionId; ?>]" value="<?= $optionKey; ?>" required>
                                            <img src="<?= htmlspecialchars($answerData['icon']); ?>" alt="Option Icon <?= $optionKey; ?>">
                                            <p><?= htmlspecialchars($answerData['text']); ?></p>
                                        </label>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Second Half of Answers -->
                                <div class="second-options-five">
                                    <?php foreach ($secondHalf as $optionKey => $answerData) : ?>
                                        <label class="option">
                                            <input type="radio" name="answers[<?= $questionId; ?>]" value="<?= $optionKey; ?>">
                                            <img src="<?= htmlspecialchars($answerData['icon']); ?>" alt="Option Icon <?= $optionKey; ?>">
                                            <p><?= htmlspecialchars($answerData['text']); ?></p>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Final Slide -->
                <div class="swiper-slide last-slide">
                    <button type="submit" class="mybutton">Find My Persona no bug button</button>
                </div>

                
            </div>

            <!-- Swiper Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </form>

    <div class="progress-bar-container">
        <div class="progress-bar"></div>
    </div>

    <script src="../../../public_html/js/persona_test.js"></script>
</body>

</html>
