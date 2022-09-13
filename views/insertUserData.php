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
    <link href="../views/public/styles.css" rel="stylesheet">
    <title>Inserez details</title>
</head>

<body>
    <!-- Canvas for JS Script -->
    <canvas id="c" style="display: block;"></canvas>

    <!-- Form for getting data for a new entry in Database -->
    <form class="entry" action="../controller/insertUser.php" method="post">
        <table class="center label-right">
            <tr>
                <td>
                    <label for="nom">Nom:</label>
                </td>
                <td>
                    <input type="text" id="nom" name="nom" required></input>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="prenom">Prenom:</label>
                </td>
                <td>
                    <input type="text" id="prenom" name="prenom" required></input>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="dateNaiss">Date de naissance:</label>
                </td>
                <td>
                    <input type="date" id="dateNaiss" name="dateNaiss" required></input>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="numTel">Telephone:</label>
                </td>
                <td>
                    <input type="text" id="numTel" name="numTel" minlength="10" maxlength="10" required></input>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="codeInsee">Code INSEE:</label>
                </td>
                <td>
                    <input type="number" id="codeInsee" name="codeInsee" min="11111" max="99999" required></input>
                </td>
            </tr>
            <tr>
                <br>
                <td>
                    <label for="adresse">Adresse:</label>
                </td>
                <td>
                    <input type="text" id="adresse" name="adresse" required></input>
                </td>
            </tr>
        </table>

        <input type="submit" class="button1" value="Envoyer"></input>
    </form>

    <!-- Return to Index -->
    <div class="backto">
    <h5>Retour à la page principale</h5>
    <form action="../views/index.html">
        <input type="submit" class="button1 bottomspace" value="Retour" />
    </form>
    </div>

    <footer>
        <p>© 2021 Gabriel Titi</p>
    </footer>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <!-- Custom JS Script for Matrix effect background -->
    <script src="../views/private/script.js"></script>
    
</body>

</html>