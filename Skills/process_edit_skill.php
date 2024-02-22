<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

if (isset($_POST["SkillID"])) {
    $skillID = $_POST["SkillID"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("UPDATE skills SET `type` = ?, skill = ? WHERE SkillID = ? AND user_id = ?");
        $stmt->execute([
            $_POST['type'],
            $_POST['skill'],
            $_SESSION["UserID"]
        ]);

        header("Location: ../dashboard.php");
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    echo "No SkillID provided.<br>";
}
?>
