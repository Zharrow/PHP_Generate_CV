<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

if (isset($_GET["UserID"])) {
    $userID = $_GET["UserID"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM users WHERE UserID = ?");
        $stmt->execute([$_SESSION["UserID"]]);


        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "No User found with UserID: $userID for UserID: " . $_SESSION["UserID"] . "<br>";
            exit;
        }
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    echo "No UserID provided in the URL.<br>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer votre profil</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/edit_user.css">
</head>
<body>
    <form action="process_edit_user.php" method="post" enctype="multipart/form-data">
        <h3>Modifier votre profil</h3>
        <input type="hidden" name="UserID" value="<?php echo $user['UserID']; ?>">
        Photo: <input type="file" name="profil_picture" value="<?php echo $user['profil_picture']; ?>"><br><br><br>
        Nom: <input type="text" name="lastname" value="<?php echo $user['lastname']; ?>" required><br>
        Prenom: <input type="text" name="firstname" value="<?php echo $user['firstname']; ?>" required><br>
        Adresse E-mail: <input type="text" name="email" value="<?php echo $user['email']; ?>" required><br>
        Numéro de téléphone: <input type="text" name="phone" value="<?php echo $user['phone']; ?>" required><br>
        Adresse: <textarea type="text" name="place"><?php echo $user['place']; ?></textarea><br>
        Decrivez-vous: <textarea name="user_description"><?php echo $user['user_description']; ?></textarea><br>
        <input type="submit" value="Sauvegarder les modifications">
    </form>
</body>
</html>

