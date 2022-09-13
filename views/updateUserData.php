<?php
include_once "../modele/Personne.class.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Insertion of google fonts. Referencing -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Quicksand&display=swap" rel="stylesheet">

    <!-- Inserting own CSS style for customization -->
    <link href="../views/public/styles.css" rel="stylesheet">
    <title>Mettre a jour</title>
</head>

<body>
    <!-- Insertion of canvas where JS script can be run [matrix effects] -->
    <canvas id="c" style="display: block;"></canvas>

    <!-- Creation of Form table -->
    <form class="center">
        <h2>Le contenu de tableau TP_Personne:</h2>

        <!-- Custom table for column names. -->
        <?php
        $names = ["Nom", "Prenom", "Date de naissance", "Telephone", "Code INSEE", "Adresse"];

        // Getting values from Database
        $table = Personne::readAllData();
        $ids = Personne::getInseeSql(); ?>

        <!-- For each loop, making a new table and filling in the details based on results from DB -->
        <?php foreach ($table as $key => $index) : ?>
            <table class="center">
                <?php foreach ($names as $name) { ?>
                    <th><?= $name ?></th>
                <?php } ?>
                <tr>
                    <?php
                    foreach ($index as $value) { ?>
                        <td><?= $value ?></td>
                    <?php } ?>
                </tr>
            </table>
        <?php endforeach; ?>
    </form>

    <!-- New form for getting the identifier for Updating the table and redirecting to data insertion page -->
    <form class="entry" action="../views/returnPages/updatePage2.php" method="post">
        <div>
            <h2>Veuillez sélectionner l’INSEE que vous souhaitez modifier</h2>
            <select name="INSEE">
                <?php foreach ($ids as $index) : ?>
                    <option value="<?= $index ?>"><?= $index ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        <input type="submit" class="button1" value="Modifier"></input>
    </form>

    <!-- Return to Index -->
    <div class="backto">
    <h5>Retour à la page principale</h5>
    <form action="../views/index.html">
        <input type="submit" class="button1" value="Retour" />
    </form>
    </div>
    <footer><p>© 2021 Gabriel Titi</p></footer>
</body>

<!-- Custom JS Script for Matrix effect background -->
<script src="../views/private/script.js"></script>

</html>