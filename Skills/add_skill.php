<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Skill</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/add_skill.css">
</head>
<body>
    <form action="process_add_skill.php" method="post" class="apple-style-form">
        <div class="back-button-container">
            <a href="javascript:history.back()" class="back-button">Retour</a>
        </div>
        <h3>Ajouter une nouvelle compétence</h3>
        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" id="type" name="type" required>
        </div>
        <div class="form-group">
            <label for="skill">Compétence:</label>
            <input type="text" id="skill" name="skill" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Ajouter">
        </div>
    </form>
</body>
</html>
