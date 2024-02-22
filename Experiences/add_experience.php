<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Experience</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/add_experience.css">
</head>
<body>
    <form action="process_add_experience.php" method="post" class="apple-style-form">
        <div class="back-button-container">
            <a href="javascript:history.back()" class="back-button">Retour</a>
        </div>
        <h3>Ajouter une nouvelle expérience</h3>
        <div class="form-group">
            <label for="enterprise">Entreprise:</label>
            <input type="text" id="enterprise" name="enterprise" required>
        </div>
        <div class="form-group">
            <label for="job">Poste:</label>
            <input type="text" id="job" name="job" required>
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
            <label for="describe">Description:</label>
            <textarea id="describe" name="describe"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Ajouter">
        </div>
    </form>
</body>
</html>
