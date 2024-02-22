<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/profil.css">
</head>
<body>
    <div class="wrapper">
    <?php include "User/get_all_user.php"; ?>
    <?php foreach ($users as $user): ?>
        <div class="container">
            <div class="wrapper_right">
                <div class="picture-container" style="background-image: url('<?php echo htmlspecialchars($user["profil_picture"]); ?>');"></div>
            </div>
            <div class="wrapper_left">
                <div class="items_profil">
                    <span class="items_title">Nom : </span>
                    <?php echo htmlspecialchars($user['lastname']); ?>
                </div>

                <div class="items_profil">
                    <span class="items_title">Prénom : </span>
                    <?php echo htmlspecialchars($user['firstname']); ?>
                </div>

                <div class="items_profil">
                    <span class="items_title">Email : </span>
                    <?php echo htmlspecialchars($user['email']); ?>
                </div>

                <div class="items_profil">
                    <span class="items_title">Téléphone : </span>
                    <?php echo htmlspecialchars($user['phone']); ?>
                </div>

                <div class="items_profil">
                    <span class="items_title">Adresse : </span>
                    <?php echo htmlspecialchars($user['place'] ? $user['place'] : "Pas encore d'adresse renseignée"); ?>
                </div>

                <div class="items_profil">
                    <span class="items_title">Phrase d'accroche : </span>
                    <?php echo htmlspecialchars($user['user_description'] ? $user['user_description'] : "Vous pouvez ajouter une phrase d'accroche / un descriptif de votre recherche pour votre CV."); ?>
                </div>

                <div class="items_profil edit-link-container">
                <a href='User/edit_user.php?UserID=<?php echo $user["UserID"]; ?>' class="edit-link">Modifier son profil</a>
            </div>
            </div>
        </div>
        
    <?php endforeach; ?>
    </div>

    <?php require_once "footer.php"; ?>
</body>
</html>