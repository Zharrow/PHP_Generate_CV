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

        $lastname = htmlspecialchars($_POST['lastname']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            echo "Email déjà utilisé, veuillez en choisir un autre.";
        } else {
            // Insérer le nouvel utilisateur
            $stmt = $conn->prepare("INSERT INTO users (lastname, firstname, email, phone, pwd) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$lastname, $firstname, $email, $phone, $pwd]);

            header("Location: index.php");
        }
    } catch(PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}
    $conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<form action="register.php" method="post">
    <div class="back-button-container">
        <a href="/" class="back-button">Retour</a>
    </div>
    <div>
        <label for="lastname">Nom:</label>
        <input type="text" id="lastname" name="lastname" required>
    </div>
    <div>
        <label for="firstname">Prénom:</label>
        <input type="text" id="firstname" name="firstname" required>
    </div>
    <div>
        <label for="phone">Téléphone:</label>
        <input type="text" id="phone" name="phone" required>
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
    <div>Vous avez déjà un compte? <a href="login.php">Cliquez ici</a></div>
    <div>
        <input type="submit" value="S'inscrire">
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

