<?php

if(isset($_POST['save'])) {
    $page = $_POST['page'];

    $urlMap = [
        'page1' => "http://localhost/Models/TemplateA.php",
        'page2' => "http://localhost/Models/TemplateB.php",
        'page3' => "http://localhost/Models/TemplateC.php",
    ];

    $url = isset($urlMap[$page]) ? $urlMap[$page] : "http://localhost/generate-pdf-default";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $pdfContent = curl_exec($ch);
    curl_close($ch);

    $filePathMap = [
        'page1' => '../Saves/TemplateA.pdf',
        'page2' => '../Saves/TemplateB.pdf',
        'page3' => '../Saves/TemplateC.pdf',
    ];

    $filePath = isset($filePathMap[$page]) ? $filePathMap[$page] : '../Saves/TemplateDefault.pdf';

    file_put_contents($filePath, $pdfContent);
    
    header('Location: /../saves.php');

}

?>