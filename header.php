<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/header.css">
</head>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    echo '
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <div class="nav">
            <div class="hamburger">
                <i class="fas fa-light fa-caret-down"></i>
            </div>
            <div class="close-btn" style="display: none;">
                <i class="fas fa-times"></i>
            </div>
            <a href="/"><img width=40 src="src/logo.svg" alt="logo" class="logo"></a>
            <a href="/">Accueil</a>
            <a href="dashboard.php">Tableau de bord</a>
            <a href="models.php">Modèles de CVs</a>
            <a href="profil.php">Profil</a>
            <a href="logout.php">Déconnexion</a>
        </div>
        
        <script>
        document.addEventListener("DOMContentLoaded", function () {
            const hamburger = document.querySelector(".hamburger");
            const closeBtn = document.querySelector(".close-btn");
            const nav = document.querySelector(".nav");

            hamburger.addEventListener("click", function () {
                nav.classList.add("active");
                closeBtn.style.display = "block"; // Afficher le bouton de fermeture
            });

            closeBtn.addEventListener("click", function () {
                nav.classList.remove("active");
                closeBtn.style.display = "none"; // Masquer le bouton de fermeture
            });
        });
        </script>';
} else {
    echo '
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <div class="nav">
            <div class="hamburger">
                <i class="fas fa-light fa-caret-down"></i>
            </div>
            <div class="close-btn" style="display: none;">
                <i class="fas fa-times"></i>
            </div>
            <img width=40 src="src/logo.svg" alt="logo" class="logo">
            <a class="connect" href="login.php">Connexion</a>
            <a class="register" href="register.php">Inscription</a>
        </div>

        <script>
        document.addEventListener("DOMContentLoaded", function () {
            const hamburger = document.querySelector(".hamburger");
            const closeBtn = document.querySelector(".close-btn");
            const nav = document.querySelector(".nav");

            hamburger.addEventListener("click", function () {
                nav.classList.add("active");
                closeBtn.style.display = "block"; // Afficher le bouton de fermeture
            });

            closeBtn.addEventListener("click", function () {
                nav.classList.remove("active");
                closeBtn.style.display = "none"; // Masquer le bouton de fermeture
            });
        });
        </script>';
}
?>

</html>