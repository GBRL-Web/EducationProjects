<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Inserting Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Quicksand&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../views/public/styles.css" rel="stylesheet">
    <title>Supprimer utilisateur</title>
</head>

<body>

    <!-- Canvas for JS Script -->
    <canvas id="c" style="display: block;"></canvas>

    <!-- Selection form -->
    <form class="entry" action="../controller/deleteUser.php" method="post">
        <div>
            <h2>Veuillez sélectionner l’INSEE que vous souhaitez supprimer</h2>
            <select name="INSEE">

                <!-- Instancing PHP to use class functions to get INSEE code list -->
                <?php
                require_once "../modele/Personne.class.php";
                $ide = Personne::getInseeSql(); ?>

                <!-- Foreach loop to insert each found code as Option in list -->
                <?php foreach ($ide as $index) : ?>
                    <option value="<?= $index ?>"><?= $index ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        <input type="submit" class="button1" value="Supprimer"></input>
    </form>

    <!-- Return to Index -->
    <div class="backto">
    <h5>Retour à la page principale</h5>
    <form action="../views/index.html">
        <input type="submit" class="button1 bottomspace" value="Retour" />
    </form>
    </div>
    <footer>© 2021 Gabriel Titi</footer>

    <!-- Custom JS Script for Matrix effect background -->
    <script src="../views/private/script.js"></script>
</body>

</html>