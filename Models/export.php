<?php

if(isset($_POST['export'])) {
    $page = $_POST['page'];

    // Cartographie des URL de vos modèles de page à leurs chemins de fichier PDF correspondants
    $urlMap = [
        'page1' => "http://localhost/Models/TemplateA.php",
        'page2' => "http://localhost/Models/TemplateB.php",
        'page3' => "http://localhost/Models/TemplateC.php",
    ];

    $url = isset($urlMap[$page]) ? $urlMap[$page] : "http://localhost/generate-pdf-default";

    // Chemins de sortie pour les fichiers PDF générés
    $outputPathMap = [
        'page1' => 'path/to/output/TemplateA.pdf',
        'page2' => 'path/to/output/TemplateB.pdf',
        'page3' => 'path/to/output/TemplateC.pdf',
    ];

    $outputPath = isset($outputPathMap[$page]) ? $outputPathMap[$page] : 'path/to/output/TemplateDefault.pdf';

    // Assurez-vous que le chemin d'accès est correct et accessible en écriture par le script
    // Construisez la commande pour exécuter le script Puppeteer avec l'URL et le chemin de sortie
    $command = "node path/to/your/puppeteer-script.js '$url' '$outputPath'";

    // Exécutez la commande
    exec($command, $output, $return_var);

    // Vérifiez si la commande a réussi
    if ($return_var === 0) {
        // Les en-têtes pour télécharger le fichier PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($outputPath) . '"');
        header('Content-Length: ' . filesize($outputPath));

        // Lisez et envoyez le fichier PDF au navigateur
        readfile($outputPath);

        // Optionnel : supprimez le fichier PDF après l'avoir envoyé
        // unlink($outputPath);
    } else {
        echo "Une erreur s'est produite lors de la génération du PDF.";
    }
    exit;
}

?>
