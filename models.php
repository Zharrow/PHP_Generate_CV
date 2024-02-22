<?php require_once "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modèle de CVs</title>
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        body, html{
            min-height: 200vh;
            width: 100%;
        }
        .container_models{
            display: flex;
            justify-content: center;
            justify-items: center;
            align-items: center;
            gap: 2%;
            margin: 4%;
        }
        .model{
            width: 40em;
            height: 60vh;
        }
        .templateStudent{
            width: 100%;
            height : 100%;
            background-image: url('src/cv.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            box-shadow: 4px 4px 20px #b5b5b5;
            /* border: .5px solid black; */
        }
        .model_one:hover{
            animation: rotateLeft 1s ease-in-out;
            animation-fill-mode: forwards;      
        }
        .model_two:hover{
            animation: rotateRight 1s ease-in-out;
            animation-fill-mode: forwards; 
        }
        @keyframes rotateLeft{
            from {
                transform: rotate(0deg);
                scale: 1;
            } to {
                transform: rotate(-1deg);
                scale: 1.1;
            }
        }
        @keyframes rotateRight{
            from {
                transform: rotate(0deg);
                scale: 1;
            } to {
                transform: rotate(1deg);
                scale: 1.1;
            }
        }
        h2{
            margin-bottom: 2em;
        }
        .title{
            right: 0;
        }
    </style>
</head>
<body>
    <div class="container_models">

        <div class="model">
            <a href="Models/TemplateA.php">
                <div class="">Template A</div>
            </a>
        </div>

        <div class="model">
            <a href="Models/TemplateB.php">
                <div class="">Template B</div>
            </a>
        </div>
    </div>
</body>
</html>