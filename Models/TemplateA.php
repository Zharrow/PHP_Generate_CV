<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modèle de CV 4</title>
    <link rel="stylesheet" href="TemplateFour.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f8f7;
            margin: 0 10%;
        }
        .cv-header {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }
        .info h1 {
            margin: 0;
        }
        .skills, .experience, .education, .hobbies {
            margin-bottom: 30px;
        }
        .job, .degree {
            margin-bottom: 20px;
        }
        h2 {
            color: #007aff;
            border-bottom: 2px solid #007aff;
            display: inline-block;
            margin-bottom: 20px;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        li:before {
            content: '•';
            margin-right: 5px;
            color: #007aff;
        }
        .picture {
            <?php include_once dirname(__FILE__) . "/../User/get_all_user.php"; ?>
            <?php foreach($users as $user) : ?>
                background-image: url('<?php echo htmlspecialchars($user["profil_picture"]); ?>');
            <?php endforeach; ?>
            width: 160px;
            height: 160px;
            border: 2px solid #111;
            color: #111;
            border-radius: 50%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            margin-right: 2%;
        }
    </style>
</head>

<body>
    <div class="cv-header">
        <?php foreach ($users as $user) : ?>
            <div class="picture"></div>
            <div class="info">
                <h1><?php echo htmlspecialchars($user["firstname"]) . ' ' . htmlspecialchars($user["lastname"]); ?></h1>
                <p><?php echo htmlspecialchars($user["email"]); ?></p>
                <p><?php echo htmlspecialchars($user["phone"]); ?></p>
                <p><?php echo $user["place"] ? $user["place"] : '<span style="color:red;">Ajoutez une adresse <a href="../profil.php" style="text-decoration:underline;"> sur votre profil</a></span>' ?></p>
                <p><?php echo $user["user_description"] ? $user["user_description"] : '<span style="color:red;">Ajoutez une description <a href="../profil.php" style="text-decoration:underline;"> sur votre profil</a></span>' ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="skills">
        <h2>Compétences</h2>
    </div>

    <div class="experience">
        <h2>Expérience Professionnelle</h2>
        <?php include "../Experiences/get_all_experiences.php"; ?>
        <?php foreach ($experiences as $experience) : ?>
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
        <?php foreach ($studies as $study) : ?>
            <div class="degree">
                <h3><?php echo htmlspecialchars($study['degree']); ?></h3>
                <p><?php echo htmlspecialchars($study['institution']); ?> | <?php echo htmlspecialchars($study['date_start']); ?> - <?php echo htmlspecialchars($study['date_end'] ? $study['date_end'] : 'En cours'); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="hobbies">
        <h2>Hobbies</h2>
    </div>

    <form action="export.php" method="post">
        <input type="hidden" name="export" value="generate_pdf">
        <input type="hidden" name="page" value="page1">
        <button type="submit">Exporter en PDF</button>
    </form>




</body>

</html>