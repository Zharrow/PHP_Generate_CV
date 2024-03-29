<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

if (isset($_POST["ExperienceID"])) {
    $experienceID = $_POST["ExperienceID"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $date_end = !empty($_POST["date_end"]) ? $_POST["date_end"] : NULL;

        $stmt = $conn->prepare("UPDATE experiences SET enterprise = ?, job = ?, `describe` = ?, date_start = ?, date_end = ? WHERE ExperienceID = ? AND user_id = ?");
        $stmt->execute([
            $_POST['enterprise'],
            $_POST['job'], 
            $_POST['describe'], 
            $_POST['date_start'], 
            $date_end, 
            $experienceID, 
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
