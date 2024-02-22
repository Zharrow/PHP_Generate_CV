<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if (isset($_GET["ExperienceID"])) {
    $experienceID = $_GET["ExperienceID"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM experiences WHERE ExperienceID = ? AND user_id = ?");
        $stmt->execute([$experienceID, $_SESSION["UserID"]]);

        if ($stmt->rowCount() > 0) {
            $experience = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "Aucune experience trouvée avec cet ID.";
            exit;
        }
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    echo "Aucun ID d'experience fourni.";
    exit;
}
?>
