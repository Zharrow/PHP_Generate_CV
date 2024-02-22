<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

try {
    $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    $place = !empty($_GET["place"]) ? $_GET["place"] : "";
    $user_description = !empty($_GET["user_description"]) ? $_GET["user_description"] : "";

    $stmt = $conn->prepare("SELECT * FROM users WHERE UserID = ?");
    $stmt->execute([$_SESSION["UserID"]]);
    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erreur: " . $e->getMessage());
}
?>
