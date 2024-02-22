<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
require_once "header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="dashboard_container">
        <?php include "User/get_all_user.php"; ?>
        <?php foreach ($users as $user) : ?>
            <p style="margin:0;">Bienvenue <?php echo (htmlspecialchars($user["firstname"]) ? ('<span style="font-weight:600;color:#007bff">' . htmlspecialchars($user["firstname"]) . '</span>') : ""); ?> 😉 !</p>
        <?php endforeach; ?>
        <h1 style="margin:0;">Tableau de bord</h1>
        <p style="margin:2% 0;">Pilotez toutes vos données : Formations, Experiences Pro, Compétences et Hobbies</p>

        <div class="tab__bar">
            <div class="tab">
                <div class="tablinks" id="defaultOpen" onclick="openTab(event, 'Onglet1')">Etudes</div>
                <div class="tablinks" onclick="openTab(event, 'Onglet2')">Experiences</div>
                <div class="tablinks" onclick="openTab(event, 'Onglet3')">Compétences</div>
                <div class="tablinks" onclick="openTab(event, 'Onglet4')">Hobbies</div>
            </div>

            <!-- Contenu pour Onglet1 -->
            <div id="Onglet1" class="tabcontent">
                <table>
                    <thead>
                        <tr>
                            <th>Ecole</th>
                            <th>Diplôme</th>
                            <th>Domaine d'étude</th>
                            <th>Période</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "Studies/get_all_studies.php"; ?>
                        <?php foreach ($studies as $study) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($study['institution']); ?></td>
                                <td><?php echo htmlspecialchars($study['degree']); ?></td>
                                <td><?php echo htmlspecialchars($study['domain']); ?></td>
                                <td><?php echo $study['date_start'] . ' - ' . ($study['date_end'] ? $study['date_end'] : '<span style="color:green;font-weight: bolder;">Toujours en activité</span>'); ?></td>
                                <td>
                                    <a class="edit-icon" href="Studies/edit_study.php?StudyID=<?php echo $study['StudyID']; ?>"><i class="fas fa-edit"></i></a>
                                    <a href="Studies/delete_study.php?StudyID=<?php echo $study['StudyID']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette étude ?');"><i class="fas fa-trash-alt delete-icon"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a class="add-icon" href="Studies/add_study.php">Ajouter Etude</a>
            </div>

            <!-- Contenu pour Onglet2 -->
            <div id="Onglet2" class="tabcontent">
                <table>
                    <thead>
                        <tr>
                            <th>Entreprise</th>
                            <th>Poste</th>
                            <th>Description</th>
                            <th>Période</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "Experiences/get_all_experiences.php"; ?>
                        <?php foreach ($experiences as $experience) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($experience['enterprise']); ?></td>
                                <td><?php echo htmlspecialchars($experience['job']); ?></td>
                                <td><?php echo htmlspecialchars($experience['describe']); ?></td>
                                <td><?php echo $experience['date_start'] . ' - ' . ($experience['date_end'] ? $experience['date_end'] : '<span style="color:green;font-weight: bolder;">Actif</span>'); ?></td>
                                <td>
                                    <a href="Experiences/edit_experience.php?ExperienceID=<?php echo $experience['ExperienceID']; ?>"><i class="fas fa-edit edit-icon"></i></a>
                                    <a href="Experiences/delete_experience.php?ExperienceID=<?php echo $experience['ExperienceID']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette expérience ?');"><i class="fas fa-trash-alt delete-icon"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a class="add-icon" href="Experiences/add_experience.php">Ajouter Expérience</a>
            </div>

            <!-- Contenu pour Onglet3 -->
            <div id="Onglet3" class="tabcontent">
                <table>
                    <thead>
                        <tr>
                            <th>Type de compétence</th>
                            <th>Compétence</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "Skills/get_all_skills.php"; ?>
                        <?php foreach ($skills as $skill) : ?>
                            <tr>
                                <td> <?php echo htmlspecialchars($skill['type']); ?></td>
                                <td> <?php echo htmlspecialchars($skill['skill']); ?></td>
                                <td><a href="Skills/edit_skill.php?SkillID=<?php echo $skill['SkillID']; ?>"><i class="fas fa-edit edit-icon"></i></a>
                                    <a href="Skills/delete_skill.php?SkillID=<?php echo $skill['SkillID']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette compétence ?');"><i class="fas fa-trash-alt delete-icon"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a class="add-icon" href="Skills/add_skill.php">Ajouter Compétence</a>
            </div>


            <!-- Contenu pour Onglet4 -->
            <div id="Onglet4" class="tabcontent">
                <table>
                    <thead>
                        <tr>
                            <th>Hobby</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "Hobbies/get_all_hobbies.php"; ?>
                        <?php foreach ($hobbies as $hobby) : ?>
                            <tr>
                                <td> <?php echo htmlspecialchars($hobby['hobby']); ?></td>
                                <td><a href="Hobbies/edit_hobby.php?HobbyID=<?php echo $hobby['HobbyID']; ?>"><i class="fas fa-edit edit-icon"></i></a>
                                    <a href="Hobbies/delete_hobby.php?HobbyID=<?php echo $hobby['HobbyID']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce hobby ?');"><i class="fas fa-trash-alt delete-icon"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a class="add-icon" href="Hobbies/add_hobby.php">Ajouter Hobby</a>
            </div>
        </div>
    </div>

    <?php require_once "footer.php"; ?>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("defaultOpen").click();
        });
    </script>
</body>

</html>