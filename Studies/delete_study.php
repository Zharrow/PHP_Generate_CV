<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

// Utilisez $_GET["StudyID"] pour obtenir l'ID de l'étude à supprimer
if (isset($_GET["StudyID"])) {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation de la requête de suppression
        $stmt = $conn->prepare("DELETE FROM studies WHERE StudyID = ? AND user_id = ?");

        // Exécution de la requête en passant l'ID de l'étude et l'ID de l'utilisateur
        $stmt->execute([$_GET["StudyID"], $_SESSION["UserID"]]);

        // Redirection vers le tableau de bord
        header("Location: ../dashboard.php");
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    // Si l'ID de l'étude n'est pas fourni, rediriger vers le tableau de bord
    header("Location: ../dashboard.php");
}
?>
