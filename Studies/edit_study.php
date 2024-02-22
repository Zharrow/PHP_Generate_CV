<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

if (isset($_GET["StudyID"])) {
    $studyID = $_GET["StudyID"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM studies WHERE StudyID = ? AND user_id = ?");
        $stmt->execute([$studyID, $_SESSION["UserID"]]);

        if ($stmt->rowCount() == 1) {
            $study = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "No study found with StudyID: $studyID for UserID: " . $_SESSION["UserID"] . "<br>";
            exit;
        }
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    echo "No StudyID provided in the URL.<br>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer une Etude</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/edit_study.css">
</head>
<body>
    <form action="process_edit_study.php" method="post" class="apple-style-form">
        <div class="back-button-container">
            <a href="javascript:history.back()" class="back-button">Retour</a>
        </div>
        <h3>Éditer l'étude</h3>
        <input type="hidden" name="StudyID" value="<?php echo htmlspecialchars($study['StudyID']); ?>">
        <div class="form-group">
            <label for="institution">Institution:</label>
            <input type="text" id="institution" name="institution" value="<?php echo htmlspecialchars($study['institution']); ?>" required>
        </div>
        <div class="form-group">
            <label for="degree">Degrée:</label>
            <input type="text" id="degree" name="degree" value="<?php echo htmlspecialchars($study['degree']); ?>" required>
        </div>
        <div class="form-group">
            <label for="domain">Domaine d'étude:</label>
            <input type="text" id="domain" name="domain" value="<?php echo htmlspecialchars($study['domain']); ?>" required>
        </div>
        <div class="form-group">
            <label for="date_start">Date de début:</label>
            <input type="date" id="date_start" name="date_start" value="<?php echo htmlspecialchars($study['date_start']); ?>" required>
        </div>
        <div class="form-group">
            <label for="date_end">Date de fin:</label>
            <input type="date" id="date_end" name="date_end" value="<?php echo htmlspecialchars($study['date_end']); ?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Sauvegarder les modifications">
        </div>
    </form>
</body>
</html>

