<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Layout</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="TemplateOne.css">
    <script src="template_student.js"></script>
</head>
<body>

    <!-- USER -->
    <?php include "../User/get_all_user.php"; ?>
    <?php foreach($users as $user) : ?>
    <div class="photo" style="background-image: url('<?php echo htmlspecialchars($user["profil_picture"]); ?>');"></div>

    <div class="nom-prenom">
        <div><?php echo htmlspecialchars($user["lastname"]) . ' ' . htmlspecialchars($user["firstname"]);?></div>
        <div><?php echo (htmlspecialchars($user["place"]) ? htmlspecialchars($user["place"]) : ""); ?></div>
        <div><?php echo (htmlspecialchars($user["user_description"]) ? htmlspecialchars($user["user_description"]) : ""); ?></div>
    </div>

    <div class="contact">
        <div><?php echo htmlspecialchars($user["phone"]); ?></div>
        <div><?php echo htmlspecialchars($user["email"]); ?></div>
    </div>
    <?php endforeach;?>
    

    <!-- STUDIES -->
    <div class="formation">
        <h2>Formations</h2>
        <?php include "../Studies/get_all_studies.php"; ?>
        <select id="studyDropdown" name="studyDropdown">
            <option value="">Sélectionnez une formation</option>
            <?php foreach ($studies as $study): ?>
                <option value="
                    <?php echo $study['StudyID']; ?>">
                    <?php echo $study['degree']; ?> chez 
                    <?php echo $study['institution']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="button" id="addStudy">Ajouter</button>
    <div id="selectedStudies"></div>
    </div>
    

    <!-- EXPERIENCES -->
    <div class="experience">
        <h2>Expériences</h2>
        <?php include "../Experiences/get_all_experiences.php"; ?>
        <select id="experienceDropdown" name="experienceDropdown">
            <option value="">Sélectionnez une expérience</option>
            <?php foreach ($experiences as $experience): ?>
                <option value="
                    <?php echo $experience['ExperienceID']; ?>">
                    <?php echo $experience['job']; ?> chez 
                    <?php echo $experience['enterprise']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="button" id="addExperience">Ajouter</button>
    <div id="selectedExperiences"></div>
    </div>

    <!-- HOBBIES -->
    <div class="hobbies">
    <h2>Hobbies</h2>
    <?php include "../Hobbies/get_all_hobbies.php"; ?>
    <select id="hobbyDropdown" name="hobbyDropdown">
            <option value="">Sélectionnez une expérience</option>
            <?php foreach ($hobbies as $hobby): ?>
                <option value="
                    <?php echo $hobby['HobbyID']; ?>">
                    <?php echo $hobby['hobby']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="button" id="addHobby">Ajouter</button>
    <div id="selectedHobbies"></div>
    </div>
    
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    let studiesCount = 0;

    document.getElementById("addStudy").addEventListener("click", function() {
        if (studiesCount < 3) {
            const selectedStudy = document.getElementById("studyDropdown");
            const studyText = selectedStudy.options[selectedStudy.selectedIndex].text;
            const studyValue = selectedStudy.value;

            if (studyValue) {
                const div = document.createElement("div");
                div.textContent = studyText;

                const removeButton = document.createElement("button");
                removeButton.textContent = "Supprimer";
                removeButton.addEventListener("click", function() {
                    div.remove();
                    studiesCount--;
                });

                div.appendChild(removeButton);
                document.getElementById("selectedStudies").appendChild(div);

                studiesCount++;
            }
        } else {
            alert("Vous ne pouvez ajouter que 3 formations/études.");
        }
    });
});



document.addEventListener('DOMContentLoaded', (event) => {
    let experiencesCount = 0;

    document.getElementById("addExperience").addEventListener("click", function() {
        if (experiencesCount < 3) {
            const selectedExperience = document.getElementById("experienceDropdown");
            const experienceText = selectedExperience.options[selectedExperience.selectedIndex].text;
            const experienceValue = selectedExperience.value;

            if (experienceValue) {
                const div = document.createElement("div");
                div.textContent = experienceText;

                const removeButton = document.createElement("button");
                removeButton.textContent = "Supprimer";
                removeButton.addEventListener("click", function() {
                    div.remove();
                    experiencesCount--;
                });

                div.appendChild(removeButton);
                document.getElementById("selectedExperiences").appendChild(div);

                experiencesCount++;
            }
        } else {
            alert("Vous ne pouvez ajouter que 3 expériences.");
        }
    });

    let hobbiesCount = 0;

    document.getElementById("addHobby").addEventListener("click", function() {
        if (hobbiesCount < 3) {
            const selectedHobby = document.getElementById("hobbyDropdown");
            const hobbyText = selectedHobby.options[selectedHobby.selectedIndex].text;
            const hobbyValue = selectedHobby.value;

            if (hobbyValue) {
                const div = document.createElement("div");
                div.textContent = hobbyText;

                const removeButton = document.createElement("button");
                removeButton.textContent = "Supprimer";
                removeButton.addEventListener("click", function() {
                    div.remove();
                    hobbiesCount--;
                });

                div.appendChild(removeButton);
                document.getElementById("selectedHobbies").appendChild(div);

                hobbiesCount++;
            }
        } else {
            alert("Vous ne pouvez ajouter que 3 hobbies.");
        }
    });
});
</script>

</body>
</html>

