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


    $stmt = $conn->prepare("INSERT INTO cv (user_id) VALUES (?)");
    $stmt->execute([
        $_SESSION["UserID"],
    ]);

    header("Location: ../dashboard.php");
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
