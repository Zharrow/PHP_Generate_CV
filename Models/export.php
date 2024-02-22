<?php

if(isset($_POST['export'])) {
    $page = $_POST['page'];

    $urlMap = [
        'page1' => "http://localhost/Models/TemplateA.php",
        'page2' => "http://localhost/Models/TemplateB.php",
    ];

    $url = isset($urlMap[$page]) ? $urlMap[$page] : "localhost/generate-pdf-default";

    $outputPathMap = [
        'page1' => __DIR__ . '../Saves/TemplateA.pdf',
        'page2' => __DIR__ . '../Saves/TemplateB.pdf',
    ];    

    $outputPath = isset($outputPathMap[$page]) ? $outputPathMap[$page] : '../Saves/TemplateDefault.pdf';

    $command = "node .\generate-pdf.js " . escapeshellarg($url) . " " . escapeshellarg($outputPath);

    exec($command, $output, $return_var);

    if ($return_var === 0) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($outputPath) . '"');
        header('Content-Length: ' . filesize($outputPath));

        readfile($outputPath);

    } else {
        echo "Une erreur s'est produite lors de la génération du PDF.";
        echo "<pre>"; print_r($output); echo "</pre>";
    }
    exit;
}

?>
