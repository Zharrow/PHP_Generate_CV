<?php
// Assurez-vous que la session est démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Vérifiez si l'ID de l'étude est passé dans l'URL
if (isset($_GET["SkillID"])) {
    $skillID = $_GET["SkillID"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparez la requête pour récupérer uniquement l'étude concernée
        $stmt = $conn->prepare("SELECT * FROM skills WHERE SkillID = ? AND user_id = ?");
        $stmt->execute([$skillID, $_SESSION["UserID"]]);

        // Vérifiez si une étude a été trouvée
        if ($stmt->rowCount() > 0) {
            // Récupérez les données de l'étude
            $skill = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            // Gérez le cas où aucune étude n'est trouvée
            echo "Aucune compétences trouvée avec cet ID.";
            exit;
        }
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    echo "Aucun ID de compétence fourni.";
    exit;
}
?>
