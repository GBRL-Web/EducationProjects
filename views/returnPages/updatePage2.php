<!-- Instancing PHP to use Session wide available variables -->
<?php
session_start();

// Saving POST variable in Session variable
$_SESSION["INSEE"] = $_POST["INSEE"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Referencing Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Quicksand&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../public/styles.css" rel="stylesheet">
    <title>Inserez details</title>
</head>

<body>
    <!-- Canvas for JS Script -->
    <canvas id="c" style="display: block;"></canvas>

    <!-- Form for getting new values for updating Database -->
    <form class="entry" action="/page/tp/controller/updateUser.php" method="post">
        <table class="center label-right">
            <h4>Code INSEE:</h4>

            <!-- Use the INSEE code the user chose -->
            <h4><?= $_POST["INSEE"] ?></h4>
            <tr>
                <td>
                    <label for="nom">Nom:</label>
                </td>
                <td>
                    <input type="text" id="nom" name="nom"></input>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="prenom">Prenom:</label>
                </td>
                <td>
                    <input type="text" id="prenom" name="prenom"></input>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="dateNaiss">Date de naissance:</label>
                </td>
                <td>
                    <input type="date" id="dateNaiss" name="dateNaiss"></input>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="numTel">Telephone:</label>
                </td>
                <td>
                    <input type="text" id="numTel" name="numTel"></input>
                </td>
            </tr>
            <tr>
                <br>
                <td>
                    <label for="adresse">Adresse:</label>
                </td>
                <td>
                    <input type="text" id="adresse" name="adresse"></input>
                </td>
            </tr>
        </table>
        <br>
        <input type="submit" class="button1" value="Envoyer"></input>
    </form>

    <!-- Return to Index -->
    <div class="backto">
    <h5>Retour à la page principale</h5>
    <form action="../index.html">
        <input type="submit" class="button1 bottomspace" value="Retour" />
    </form>
    </div>
    <footer><p>© 2021 Gabriel Titi</p></footer>
    
</body>
<script src="/page/tp/views/private/script.js"></script>

</html>