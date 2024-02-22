<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once "header.php"; ?>
    <?php include_once dirname(__FILE__) . "/CVs/get_all_cv.php"; ?>
    <h1 style="margin: 10% 0 10% 10%;">Vos sauvegardes de CVs</h1>
    <?php foreach($users as $user) : ?>
        <div><?php echo $user["cv_id"]; ?></div>
    <?php endforeach; ?>
    
    <?php require_once "footer.php"; ?>
</body>
</html>