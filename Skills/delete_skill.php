<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

// Vérification de la présence de l'ID de l'étude dans l'URL
if (isset($_GET["SkillID"])) {
    // Connexion à la base de données
    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation de la requête de suppression
        $stmt = $conn->prepare("DELETE FROM skills WHERE SkillID = ? AND user_id = ?");

        // Exécution de la requête
        $stmt->execute([$_GET["SkillID"], $_SESSION["UserID"]]);

        // Redirection vers le tableau de bord
        header("Location: ../dashboard.php");
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    // Si l'ID n'est pas fourni, rediriger vers le tableau de bord
    header("Location: ../dashboard.php");
}
?>
