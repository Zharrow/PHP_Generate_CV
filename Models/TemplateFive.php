<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modèle de CV 5</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="TemplateFive.css">
</head>
<body>
    <div class="banner">
        <!-- Image de fond ou couleur unie -->
    </div>

    <div class="container">
        <?php include "../User/get_user_info.php"; ?>
        <?php foreach($users as $user) : ?>
        <section class="about-me">
            <h1><?php echo htmlspecialchars($user["firstname"]) . ' ' . htmlspecialchars($user["lastname"]); ?></h1>
            <p><?php echo htmlspecialchars($user["user_description"]); ?></p>
        </section>
        <?php endforeach; ?>

        <section class="experience">
            <h2>Expérience Professionnelle</h2>
            <?php include "../Experiences/get_all_experiences.php"; ?>
            <?php foreach ($experiences as $experience): ?>
            <div>
                <h3><?php echo htmlspecialchars($experience['job']); ?></h3>
                <p><?php echo htmlspecialchars($experience['enterprise']); ?> | <?php echo htmlspecialchars($experience['start_date']); ?> - <?php echo htmlspecialchars($experience['end_date']); ?></p>
            </div>
            <?php endforeach; ?>
        </section>

        <section class="education">
            <h2>Formation</h2>
            <?php include "../Studies/get_all_studies.php"; ?>
            <?php foreach ($studies as $study): ?>
            <div>
                <h3><?php echo htmlspecialchars($study['degree']); ?></h3>
                <p><?php echo htmlspecialchars($study['institution']); ?> | <?php echo htmlspecialchars($study['start_date']); ?> - <?php echo htmlspecialchars($study['end_date']); ?></p>
            </div>
            <?php endforeach; ?>
        </section>

        <section class="skills">
            <h2>Compétences</h2>
            <!-- Liste ou icônes des compétences -->
        </section>

        <section class="hobbies">
            <h2>Hobbies</h2>
            <!-- Liste ou icônes des hobbies -->
        </section>

        <?php 
        
        $url = "http://localhost:3306/generate-pdf";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $pdfContent = curl_exec($ch);
        curl_close($ch);

        $filePath = '../SavesPdf/filename.pdf';

        function file_put_contents($filePath, $pdfContent) {
            $file = fopen($filePath, 'w');
            fwrite($file, $pdfContent);
            fclose($file);
        }

        echo '<button onclick="file_put_contents($filePath, $pdfContent)">Télécharger</button>';
   
        ?>

    </div>
</body>
</html>
