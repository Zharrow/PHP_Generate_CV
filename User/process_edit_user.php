<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}
if (isset($_POST["UserID"])) {
    $userID = $_POST["UserID"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=generatecv", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT profil_picture, user_description FROM users WHERE UserID = ?");
        $stmt->execute([$userID]);
        $currentUser = $stmt->fetch(PDO::FETCH_ASSOC);

        $place = !empty($_POST["place"]) ? $_POST["place"] : NULL;
        $user_description = !empty($_POST["user_description"]) ? $_POST["user_description"] : $currentUser['user_description'];

        if (isset($_FILES["profil_picture"]) && $_FILES["profil_picture"]["error"] == 0) {
            $ext = pathinfo($_FILES["profil_picture"]["name"], PATHINFO_EXTENSION);
            $newfilename = uniqid() . "." . $ext;
            move_uploaded_file($_FILES["profil_picture"]["tmp_name"], "../Uploads/" . $newfilename);
            $profil_picture = "../Uploads/" . $newfilename;
        } else {
            $profil_picture = $currentUser['profil_picture'];
        }

        $stmt = $conn->prepare("UPDATE users SET lastname = ?, firstname = ?, email = ?, phone = ?, place = ?, user_description = ?, profil_picture = ? WHERE UserID = ?");
        $stmt->execute([
            $_POST['lastname'], 
            $_POST['firstname'], 
            $_POST['email'], 
            $_POST['phone'], 
            $place,
            $user_description,
            $profil_picture,
            $userID
        ]);

        header("Location: ../profil.php");
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    echo "No UserID provided.<br>";
}
?>
