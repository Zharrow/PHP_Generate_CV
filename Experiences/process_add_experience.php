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

    $date_end = !empty($_POST["date_end"]) ? $_POST["date_end"] : NULL;

    $stmt = $conn->prepare("INSERT INTO experiences (user_id, enterprise, job, `describe`, date_start, date_end) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION["UserID"], 
        $_POST["enterprise"], 
        $_POST["job"], 
        $_POST["describe"], 
        $_POST["date_start"], 
        $date_end
    ]);

    header("Location: ../dashboard.php");
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
