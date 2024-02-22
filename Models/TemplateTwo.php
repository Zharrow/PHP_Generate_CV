<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modèle Pro</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .cv-container{
            display: grid;
            grid-template-columns: repeat(12, 1fr);
        }
        .left-column{
            grid-area: 2 / 3 / 2 / 6;
            background-color : black;
            color: white;
        }
        .right-column{
            grid-area: 2 / 7 / 2 / 10;
        }

        .download-pdf-button{
            grid-area: 4 / 5 / 4 / 9;
            text-align: center;
        }
        .profile-section{
            display: flex;
            flex-direction: column;
        }
        .picture{
            <?php include_once(dirname(__FILE__) . "/../User/get_user_info.php"); ?>
            <?php foreach($users as $user) : ?>
            background-image: url('<?php echo htmlspecialchars($user["profil_picture"]); ?>');
            <?php endforeach; ?>
            height: 300px;
            border-radius: 10px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
    
    <?php include_once(dirname(__FILE__) . "/../User/get_user_info.php"); ?>
    <?php foreach($users as $user) : ?>
    <div class="cv-container">
        <div class="left-column">
            <div class="profile-section">
                <div class="picture">
                <h2><?php echo htmlspecialchars($user["firstname"]) . ' ' . htmlspecialchars($user["lastname"]); ?></h2>
                <p><?php echo htmlspecialchars($user["place"]); ?></p>
            </div>
            <div class="contact-section">
                <h3>Contact</h3>
                <p><?php echo htmlspecialchars($user["email"]); ?></p>
                <p><?php echo htmlspecialchars($user["phone"]); ?></p>
            </div>
            <div class="skills-section">
                <!-- Ajoutez vos compétences ici -->
                <h3>Compétences</h3>
                <ul>
                    <!-- Les compétences peuvent être dynamiquement ajoutées si elles sont stockées dans la base de données -->
                </ul>
            </div>
            <div class="hobbies-section">
                <h3>Hobbies</h3>
                <?php include_once(dirname(__FILE__) . "/../Hobbies/get_all_hobbies.php"); ?>
                <ul>
                    <?php foreach ($hobbies as $hobby): ?>
                        <li><?php echo htmlspecialchars($hobby['hobby']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="right-column">
            <div class="experience-section">
                <h3>Expérience Professionnelle</h3>
                <?php include_once(dirname(__FILE__) . "/../Experiences/get_all_experiences.php"); ?>
                <?php foreach ($experiences as $experience): ?>
                    <p><strong><?php echo htmlspecialchars($experience['job']); ?></strong> chez <?php echo htmlspecialchars($experience['enterprise']); ?></p>
                <?php endforeach; ?>
            </div>
            <div class="education-section">
                <h3>Formation</h3>
                <?php include_once(dirname(__FILE__) . "/../Studies/get_all_studies.php"); ?>
                <?php foreach ($studies as $study): ?>
                    <p><strong><?php echo htmlspecialchars($study['degree']); ?></strong> - <?php echo htmlspecialchars($study['institution']); ?></p>
                <?php endforeach; ?>
            </div>
            <div class="description-section">
                <h3>À Propos de Moi</h3>
                <p><?php echo htmlspecialchars($user["user_description"]); ?></p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <a href="../generate_pdf.php" class="download-pdf-button">Télécharger le CV en PDF</a>

</body>
</html>