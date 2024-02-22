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
if (isset($_GET["ExperienceID"])) {
    $experienceID = $_GET["ExperienceID"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM experiences WHERE ExperienceID = ? AND user_id = ?");
        $stmt->execute([$experienceID, $_SESSION["UserID"]]);

        if ($stmt->rowCount() == 1) {
            $experience = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "No experience found with ExperienceID: $experienceID for UserID: " . $_SESSION["UserID"] . "<br>";
            exit;
        }
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    echo "No ExperienceID provided in the URL.<br>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer une Experience</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/edit_experience.css"> <!-- Assurez-vous que le chemin vers votre fichier CSS est correct -->
</head>
<body>
    <form action="process_edit_experience.php" method="post" class="apple-style-form">
        <div class="back-button-container">
            <a href="javascript:history.back()" class="back-button">Retour</a>
        </div>
        <h3>Éditer une Expérience</h3>
        <input type="hidden" name="ExperienceID" value="<?php echo htmlspecialchars($experience["ExperienceID"]); ?>">
        <div class="form-group">
            <label for="enterprise">Entreprise:</label>
            <input type="text" id="enterprise" name="enterprise" value="<?php echo htmlspecialchars($experience["enterprise"]); ?>" required>
        </div>
        <div class="form-group">
            <label for="job">Poste:</label>
            <input type="text" id="job" name="job" value="<?php echo htmlspecialchars($experience["job"]); ?>" required>
        </div>
        <div class="form-group">
            <label for="date_start">Date de début:</label>
            <input type="date" id="date_start" name="date_start" value="<?php echo htmlspecialchars($experience["date_start"]); ?>" required>
        </div>
        <div class="form-group">
            <label for="date_end">Date de fin:</label>
            <input type="date" id="date_end" name="date_end" value="<?php echo htmlspecialchars($experience["date_end"]); ?>">
        </div>
        <div class="form-group">
            <label for="describe">Description:</label>
            <textarea id="describe" name="describe"><?php echo htmlspecialchars($experience["describe"]); ?></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Sauvegarder les modifications">
        </div>
    </form>
</body>
</html>

