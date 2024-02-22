<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Hobby</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/add_hobby.css">
</head>
<body>
    <form action="process_add_hobby.php" method="post">
        <div class="back-button-container">
            <a href="javascript:history.back()" class="back-button">Retour</a>
        </div>
        <h3>Ajouter un hobby</h3>
        <div class="form-group">
            <label for="hobby">Hobby:</label>
            <input type="text" id="hobby" name="hobby" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Ajouter">
        </div>
    </form>
</body>
</html>
