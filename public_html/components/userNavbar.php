<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
   
    <link rel="stylesheet" href="/SWE_Phase1/public_html/css/usernavbar.css">

</head>

<body>
  
    <aside class="sidebar">
        <div class="logo">
            <a href="/SWE_Phase1/public_html/index.php" class="Apex-text">
                <h2>Apex</h2>
            </a>
        </div>
        <div class="A-logo">A</div> 
        <button class="collapse-btn">
            <span class="material-symbols-outlined">arrow_forward</span>
        </button>

        <ul class="links">
            <h4>Main Menu</h4>
            <li>
                <span class="material-symbols-outlined">home</span>
                <a href="/SWE_Phase1/public_html/index.php">Home</a>
            </li>
            <li>
                <span class="material-symbols-outlined">directions_car</span>
                <a href="#">Car recommendation</a>
            </li>
            <li>
                <span class="material-symbols-outlined">swap_horiz</span>
                <a href="/SWE_Phase1/app/views/car_comparison.php">Car comparison</a>
            </li>
            <li>
                <span class="material-symbols-outlined">question_answer</span>
                <a href="/SWE_Phase1/app/views/user/chatbot_mainPage.php">Turbo</a>
            </li>
            <li>
                <span class="material-symbols-outlined">public</span>
                <a href="/SWE_Phase1/app/views/platform.php">Apex Community</a>
            </li>
            <hr>
            <h4>Account</h4>
            <li>
                <span class="material-symbols-outlined">favorite</span>
                <a href="/SWE_Phase1/app/views/user/favorites.php">Favorites</a>
            </li>
            <li>
                <img src="/SWE_Phase1/public_html/media/persona-icon.png" alt="persona-icon" />
                <a href="/SWE_Phase1/app/views/user/persona.php">Your Persona</a>
            </li>
            <li class="logout-link">
                <span class="material-symbols-outlined">logout</span>
                <a href="/SWE_Phase1/public_html/index.php">Logout</a>
            </li>
            <li class="deletion-link">
                <span class="material-symbols-outlined" style="color: red;">delete</span>
                <a class="deleteTab" href="/SWE_Phase1/app/views/user/delete_account.php">Delete Account</a>
            </li>
        </ul>
    </aside>


    <span class="overlay"></span>

    <section>
        <div id="warningPopup" class="popup hidden">
            <i class="fas fa-exclamation-circle"></i>
            <h2>Warning</h2>
            <h3>Are you sure you want to delete your account?</h3>
            <div class="buttons">
                <button id="confirm">Yes</button>
                <button id="cancel">No</button>
            </div>
        </div>
    </section>

    <script>
        //Sidebar collapsing JS
        const sidebar = document.querySelector('.sidebar');
        const collapseBtn = document.querySelector('.collapse-btn');

        const toggleSidebar = () => {
            sidebar.classList.toggle('collapsed');
        };
        collapseBtn.addEventListener('click', toggleSidebar);

        //Delete pop up JS
        document.addEventListener("DOMContentLoaded", function() {
            const deleteTab = document.querySelector(".deleteTab");
            const warningPopup = document.getElementById("warningPopup");
            const overlay = document.querySelector(".overlay");
            const cancelBtn = document.getElementById("cancel");

            deleteTab.addEventListener("click", function(event) {
                event.preventDefault();
                warningPopup.classList.remove("hidden");
                overlay.classList.add("show");
            });

            cancelBtn.addEventListener("click", function() {
                warningPopup.classList.add("hidden");
                overlay.classList.remove("show");
            });

            const confirmBtn = document.getElementById("confirm");
            confirmBtn.addEventListener("click", function() {
                alert("Account deleted!");
                warningPopup.classList.add("hidden");
                overlay.classList.remove("show");
            });
        });
    </script>
</body>

</html>