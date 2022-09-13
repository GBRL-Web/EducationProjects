<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Quicksand&display=swap" rel="stylesheet">
    <link href="../public/styles.css" rel="stylesheet">

    <title>Voir Table</title>
</head>

<body>
    <canvas id="c"></canvas>
    <h2>Le contenu de tableau TP_Personne:</h2>

    <?php
    $ide = $_SESSION['result'] ?>
    <?php foreach ($ide as $key => $index) : ?>

        <table class="center">
            <!-- Foreach loop and IF conditioning to change name from Session result to one more presentable -->
            <?php foreach ($_SESSION['resultNames'] as $name) {
                if ($name == "nom") { ?>
                    <th>Nom</th>
                <?php
                } else if ($name == "prenom") { ?>
                    <th>Prenom</th>
                <?php
                } else if ($name == "dateNaiss") { ?>
                    <th>Date de naissance</th>
                <?php
                } else if ($name == "numTel") { ?>
                    <th>Telephone</th>
                <?php
                } else if ($name == "adresse") { ?>
                    <th>Adresse</th>
                <?php
                } else if ($name == "codeInsee") { ?>
                    <th>Code INSEE</th>
            <?php
                }
            } ?>
            <tr>
                <?php
                foreach ($index as $value) { ?>
                    <td><?= $value ?></td>
                <?php } ?>
            </tr>
        </table>

    <?php endforeach ?>
    <!-- Return to Index -->
    <div class="backto">
    <h5>Retour à la page principale</h5>
    <form action="../index.html">
        <input type="submit" class="button1 bottomspace" value="Retour" />
    </form>
    </div>
    
    <footer><p>© 2021 Gabriel Titi</p></footer>
    <!-- Custom JS Script for Matrix effect background -->
    <script src="../private/script.js"></script>
</body>

</html>