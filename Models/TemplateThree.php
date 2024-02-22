<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modèle de CV 3</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="TemplateThree.css">
</head>
<body>
    <div class="cv-header">
        <?php include "../User/get_user_info.php"; ?>
        <?php foreach($users as $user) : ?>
        <img src="<?php echo htmlspecialchars($user["profil_picture"]); ?>" alt="Photo de profil" class="profile-pic">
        <h1><?php echo htmlspecialchars($user["firstname"]) . ' ' . htmlspecialchars($user["lastname"]); ?></h1>
        <p><?php echo htmlspecialchars($user["place"]); ?></p>
        <?php endforeach; ?>
    </div>

    <div class="cv-body">
        <div class="timeline">
            <h2>Expérience</h2>
            <?php include "../Experiences/get_all_experiences.php"; ?>
            <?php foreach ($experiences as $experience): ?>
            <div class="timeline-item">
                <h3><?php echo htmlspecialchars($experience['job']); ?> chez <?php echo htmlspecialchars($experience['enterprise']); ?></h3>
                <p><?php echo htmlspecialchars($experience['date_start']); ?> - <?php echo htmlspecialchars($experience['date_end'] ? $experience['date_end'] : 'Actif'); ?></p>
            </div>
            <?php endforeach; ?>

            <h2>Formation</h2>
            <?php include "../Studies/get_all_studies.php"; ?>
            <?php foreach ($studies as $study): ?>
            <div class="timeline-item">
                <h3><?php echo htmlspecialchars($study['degree']); ?></h3>
                <p><?php echo htmlspecialchars($study['institution']); ?>, <?php echo htmlspecialchars($study['date_start']); ?> - <?php echo htmlspecialchars($study['date_end'] ? $study['date_end'] : 'Actif'); ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="sidebar">
            <div class="skills-section">
                <h2>Compétences</h2>
                <!-- Dynamically load skills here -->
            </div>

            <div class="hobbies-section">
                <h2>Hobbies</h2>
                <?php include "../Hobbies/get_all_hobbies.php"; ?>
                <ul>
                    <?php foreach ($hobbies as $hobby): ?>
                    <li><?php echo htmlspecialchars($hobby['hobby']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
