<html>

<head>
    <!-- Referencing Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Quicksand&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../views/public/styles.css" rel="stylesheet">
    <title>Voir details</title>
</head>

<body>

    <!-- Canvas for JS Script -->
    <canvas id="c" style="display: block;"></canvas>
    <h1 class="centerPage">Vous voulez voir quelle champs?</h1>

    <!-- Selection form for different columns in DB -->
    <form class="center" action="../controller/readUser.php" method="post">
        <div>
            <label>Nom
                <input type="checkbox" name="nom" id="nom">
            </label>
            <br>

            <label>Prenom
                <input type="checkbox" name="prenom" id="prenom">
            </label class="center">
            <br>

            <label>Date de naissance
                <input type="checkbox" name="dateNaiss" id="dateNaiss">
            </label>
            <br>

            <label>Numero de telephone
                <input type="checkbox" name="numTel" id="numTel">
            </label class="center">
            <br>

            <label>Code INSEE
                <input type="checkbox" name="codeInsee" id="codeInsee">
            </label>
            <br>

            <label>Adresse
                <input type="checkbox" name="adresse" id="adresse">
            </label>
            <br>
        </div>
        <input type="submit" class="button1" value="Lire DB"></input>
    </form>

    <!-- Return to Index -->
    <div class="backto">
    <h5>Retour à la page principale</h5>
    <form action="../views/index.html">
        <input type="submit" class="button1 bottomspace" value="Retour" />
    </form>
    </div>
    <footer><p>© 2021 Gabriel Titi</p></footer>
</body>

<!-- Custom JS Script for Matrix effect background -->
<script src="../views/private/script.js"></script>

</html>