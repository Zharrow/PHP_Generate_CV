<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

if (isset($_POST["HobbyID"])) {
    $hobbyID = $_POST["HobbyID"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("UPDATE hobbies SET hobby = ? WHERE HobbyID = ? AND user_id = ?");
        $stmt->execute([$_POST['hobby'], $hobbyID, $_SESSION["UserID"]]);

        header("Location: ../dashboard.php");
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    echo "No HobbyID provided.<br>";
}
?>
