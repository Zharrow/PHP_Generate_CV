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
if (isset($_GET["HobbyID"])) {
    $hobbyID = $_GET["HobbyID"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM hobbies WHERE HobbyID = ? AND user_id = ?");
        $stmt->execute([$hobbyID, $_SESSION["UserID"]]);

        if ($stmt->rowCount() == 1) {
            $hobby = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "No hobby found with HobbyID: $hobbyID for UserID: " . $_SESSION["UserID"] . "<br>";
            exit;
        }
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    echo "No HobbyID provided in the URL.<br>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer un Hobby</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/edit_hobby.css"> <!-- Assurez-vous que le chemin vers votre fichier CSS est correct -->
</head>
<body>
    <form action="process_edit_hobby.php" method="post" class="apple-style-form">
        <div class="back-button-container">
            <a href="javascript:history.back()" class="back-button">Retour</a>
        </div>
        <h3>Éditer le hobby</h3>
        <input type="hidden" name="HobbyID" value="<?php echo htmlspecialchars($hobby['HobbyID']); ?>">
        <div class="form-group">
            <label for="hobby">Hobby:</label>
            <input type="text" id="hobby" name="hobby" value="<?php echo htmlspecialchars($hobby['hobby']); ?>" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Sauvegarder les modifications">
        </div>
    </form>
</body>
</html>

