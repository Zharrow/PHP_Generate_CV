<?php
// Assurez-vous que la session est démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

// Récupérez les données de l'étude à partir de l'ID passé dans l'URL
if (isset($_GET["SkillID"])) {
    $skillID = $_GET["SkillID"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM skills WHERE SkillID = ? AND user_id = ?");
        $stmt->execute([$skillID, $_SESSION["UserID"]]);

        if ($stmt->rowCount() == 1) {
            $skill = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "No skill found with SkillID: $skillID for UserID: " . $_SESSION["UserID"] . "<br>";
            exit;
        }
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    echo "No SkillID provided in the URL.<br>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer une Compétence</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/edit_skill.css"> <!-- Assurez-vous que le chemin vers votre fichier CSS est correct -->
</head>
<body>
    <form action="process_edit_skill.php" method="post" class="apple-style-form">
        <div class="back-button-container">
            <a href="javascript:history.back()" class="back-button">Retour</a>
        </div>
        <h3>Éditer une Compétence</h3>
        <input type="hidden" name="SkillID" value="<?php echo htmlspecialchars($skill["SkillID"]); ?>">
        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($skill["type"]); ?>" required>
        </div>
        <div class="form-group">
            <label for="skill">Compétence:</label>
            <input type="text" id="skill" name="skill" value="<?php echo htmlspecialchars($skill["skill"]); ?>" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Sauvegarder les modifications">
        </div>
    </form>
</body>
</html>

