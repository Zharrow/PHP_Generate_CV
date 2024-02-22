<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';
    $dbname = 'generatecv';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['pwd'];

        $stmt = $conn->prepare("SELECT UserID, lastname, firstname, email, phone, pwd FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() == 1) {
            if ($row = $stmt->fetch()) {
                $id = $row["UserID"];
                $lastname = $row["lastname"];
                $firstname = $row["firstname"];
                $phone = $row["phone"];
                $hashed_password = $row["pwd"];

                if (password_verify($password, $hashed_password)) {
                    session_start();

                    $_SESSION["loggedin"] = true;
                    $_SESSION["UserID"] = $id;
                    $_SESSION["email"] = $email;

                    header("location: dashboard.php");
                } else {
                    echo "<p style='color:red;'>Le mot de passe que vous avez entré n'est pas valide.</p>";
                }
            }
        } else {
            echo "Aucun compte trouvé avec cet email.";
        }
    } catch(PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }

    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <form action="login.php" method="post">
    <div class="back-button-container">
        <a href="/" class="back-button">Retour</a>
    </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="password-field">
            <label for="pwd">Mot de passe:</label>
            <input type="password" id="pwd" name="pwd" required>
            <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility()"></i>
        </div>
        <div>Vous n'avez pas de compte? <a href="register.php">Cliquez ici</a></div>
        <div>
            <input type="submit" value="Se connecter">
        </div>
    </form>
    
    <script>
    function togglePasswordVisibility() {
        var pwdField = document.getElementById("pwd");
        var toggleIcon = document.querySelector(".toggle-password");
        if (pwdField.type === "password") {
            pwdField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            pwdField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
    </script>

</body>
</html>

