<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="icon" type="image/png" href="src/logo.svg" />
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/index.css">
</head>

<body>
    <?php
    require_once "header.php";
    ?>
    <main>
        <section class="presentation">
        <p style="font-weight:300;font-style: italic;margin:1% 0;">Dès maintenant un Curriculum Vitae sensationnel</p>
            <div class="title">
                <p>Créez votre CV </p>
                <p>
                    <span class="word"> facilement</span>
                    <span class="word"> rapidement</span>
                    <span class="word"> gratuitement</span>
                </p>
            </div>
            <p style="text-align: center;margin: 0 10%;font-weight: 400;">
                Notre outil de génération de CV est très performant. Vous aurez la possiblité de
                <span style="color:#49cc90;font-weight:700;font-style: italic;">créez</span> -
                <span style="color:#fca130;font-weight:700;font-style: italic;">éditer</span> -
                <span style="color:#f93e3e;font-weight:700;font-style: italic;">supprimer</span>
                toutes vos informations en quelques clics. <span style="font-weight:600;font-style: italic;">Un gain de temps</span> considérable !
                Ensuite vous pourrez <span style="font-weight:600;font-style: italic;">choisir un modèle de CV</span>
                qui vous correspond et vos informations seront directement intégrées.
                Puis <span style="font-weight:600;font-style: italic;">téléchargez</span> le directement sur votre ordinateur.
            </p>
            <a href="dashboard.php">🚀 Je veux créer mon CV</a>
        </section>

        <div class="hr"></div>

        <h2 style="text-align: center;">Fonctionnalités</h2>
        <section class="fonctionnalites">
            <div class="fonctionnalite">
                <img src="src/resume.png" alt="">
                <h3>Créer</h3>
                <p>Depuis votre tableau de bord, pilotez vos informations comme un capitaine dirige son navire. <span style="color:#007aff;font-weight:700;font-style: italic;">Créez</span> votre <span style="color:#007aff;font-weight:700;">CV en ligne</span> en <span>quelques minutes.</span></p>
            </div>
            <div class="fonctionnalite">
                <img src="src/editing.png" alt="">
                <h3>Modifier</h3>
                <p>Notre site est conçu pour vous permettre de modifier simultanement plusieurs de vos CVs en même temps, sans avoir besoin de les modifier un par un.</p>
            </div>
            <div class="fonctionnalite">
                <img src="src/download.png" alt="">
                <h3>Télécharger</h3>
                <p>Vous aurez ensuite la possiblité de téléchargez votre CV en format PDF. Ainsi, vous êtes certain d'obtenir votre prochain entretien, car nos CVs changeront votre vie !</p>
            </div>

    </main>

    <?php require_once "footer.php"; ?>

    <script>
        var words = document.getElementsByClassName('word');
        var wordArray = [];
        var currentWord = 0;

        words[currentWord].style.opacity = 1;
        for (var i = 0; i < words.length; i++) {
            splitLetters(words[i]);
        }

        function changeWord() {
            var cw = wordArray[currentWord];
            var nw = currentWord == words.length - 1 ? wordArray[0] : wordArray[currentWord + 1];
            for (var i = 0; i < cw.length; i++) {
                animateLetterOut(cw, i);
            }

            for (var i = 0; i < nw.length; i++) {
                nw[i].className = 'letter behind';
                nw[0].parentElement.style.opacity = 1;
                animateLetterIn(nw, i);
            }

            currentWord = (currentWord == wordArray.length - 1) ? 0 : currentWord + 1;
        }

        function animateLetterOut(cw, i) {
            setTimeout(function() {
                cw[i].className = 'letter out';
            }, i * 80);
        }

        function animateLetterIn(nw, i) {
            setTimeout(function() {
                nw[i].className = 'letter in';
            }, 340 + (i * 80));
        }

        function splitLetters(word) {
            var content = word.innerHTML;
            word.innerHTML = '';
            var letters = [];
            for (var i = 0; i < content.length; i++) {
                var letter = document.createElement('span');
                letter.className = 'letter';
                letter.innerHTML = content.charAt(i);
                word.appendChild(letter);
                letters.push(letter);
            }

            wordArray.push(letters);
        }

        changeWord();
        setInterval(changeWord, 2000);
    </script>
</body>

</html>