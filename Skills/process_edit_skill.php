<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

// Vérifiez si les données du formulaire ont été soumises
if (isset($_POST["SkillID"])) {
    $skillID = $_POST["SkillID"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparez la requête de mise à jour
        $stmt = $conn->prepare("UPDATE skills SET `type` = ?, skill = ? WHERE SkillID = ? AND user_id = ?");
        $stmt->execute([
            $_POST['type'],
            $_POST['skill'],
            $_SESSION["UserID"]
        ]);

        // Redirigez vers le tableau de bord après la mise à jour
        header("Location: ../dashboard.php");
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    echo "No SkillID provided.<br>";
}
?>
