<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

if (isset($_POST["StudyID"])) {
    $studyID = $_POST["StudyID"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $date_end = !empty($_POST["date_end"]) ? $_POST["date_end"] : NULL;

        $stmt = $conn->prepare("UPDATE studies SET institution = ?, degree = ?, domain = ?, date_start = ?, date_end = ? WHERE StudyID = ? AND user_id = ?");
        $stmt->execute([
            $_POST['institution'], 
            $_POST['degree'], 
            $_POST['domain'], 
            $_POST['date_start'], 
            $date_end, 
            $studyID, 
            $_SESSION["UserID"]
        ]);

        header("Location: ../dashboard.php");
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    echo "No StudyID provided.<br>";
}
?>
