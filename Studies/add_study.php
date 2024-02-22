<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Etude</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/add_study.css">
</head>
<body>
    <form action="process_add_study.php" method="post" class="apple-style-form">
        <div class="back-button-container">
            <a href="javascript:history.back()" class="back-button">Retour</a>
        </div>
        <h3>Ajouter une nouvelle étude</h3>
        <div class="form-group">
            <label for="institution">Institution:</label>
            <input type="text" id="institution" name="institution" required>
        </div>
        <div class="form-group">
            <label for="degree">Degrée:</label>
            <input type="text" id="degree" name="degree" required>
        </div>
        <div class="form-group">
            <label for="domain">Domaine d'étude:</label>
            <input type="text" id="domain" name="domain" required>
        </div>
        <div class="form-group">
            <label for="date_start">Date de début:</label>
            <input type="date" id="date_start" name="date_start" required>
        </div>
        <div class="form-group">
            <label for="date_end">Date de fin:</label>
            <input type="date" id="date_end" name="date_end">
        </div>
        <div class="form-group">
            <input type="submit" value="Ajouter">
        </div>
    </form>
</body>
</html>
