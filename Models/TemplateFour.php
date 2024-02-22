<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modèle de CV 4</title>
    <link rel="stylesheet" href="TemplateFour.css">
</head>
<body>
    <div class="cv-header">
        <?php include "../User/get_user_info.php"; ?>
        <?php foreach($users as $user) : ?>
        <img src="<?php echo htmlspecialchars($user["profil_picture"]); ?>" alt="Profil" class="profile-pic">
        <div class="info">
            <h1><?php echo htmlspecialchars($user["firstname"]) . ' ' . htmlspecialchars($user["lastname"]); ?></h1>
            <p><?php echo htmlspecialchars($user["email"]); ?> | <?php echo htmlspecialchars($user["phone"]); ?></p>
            <p><?php echo htmlspecialchars($user["place"]); ?></p>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="skills">
        <h2>Compétences</h2>
        <!-- Ici, insérez les compétences sous forme de barres de progression ou d'icônes -->
    </div>

    <div class="experience">
        <h2>Expérience Professionnelle</h2>
        <?php include "../Experiences/get_all_experiences.php"; ?>
        <?php foreach ($experiences as $experience): ?>
        <div class="job">
            <h3><?php echo htmlspecialchars($experience['job']); ?></h3>
            <p><?php echo htmlspecialchars($experience['enterprise']); ?> | <?php echo htmlspecialchars($experience['date_start']); ?> - <?php echo htmlspecialchars($experience['date_end'] ? $experience['date_end'] : 'En cours'); ?></p>
            <ul>
                <li>Détail de l'expérience</li>
            </ul>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="education">
        <h2>Formation</h2>
        <?php include "../Studies/get_all_studies.php"; ?>
        <?php foreach ($studies as $study): ?>
        <div class="degree">
            <h3><?php echo htmlspecialchars($study['degree']); ?></h3>
            <p><?php echo htmlspecialchars($study['institution']); ?> | <?php echo htmlspecialchars($study['date_start']); ?> - <?php echo htmlspecialchars($study['date_end'] ? $study['date_end'] : 'En cours'); ?></p>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="hobbies">
        <h2>Hobbies</h2>
        <!-- Ici, utilisez des icônes ou des images pour représenter les hobbies -->
    </div>

    <?php 
        
        $url = "http://localhost:3306/generate-pdf";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $pdfContent = curl_exec($ch);
        curl_close($ch);

        $filePath = '../Saves/TemplateFour.pdf';
        
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="TemplateFour.pdf"');
        header('Content-Length: ' . filesize($filePath));
        

        echo '<button onclick="file_put_contents($filePath, $pdfContent);">Sauvegarder</button>';
        echo '<button onclick="readfile($filePath);">Télécharger</button>';

        
   
        ?>
</body>
</html>
