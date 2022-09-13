<!-- Instance PHP for use of session wide variables -->
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Reference Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Quicksand&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../public/styles.css" rel="stylesheet">
    <title><?= $_SESSION["title"] ?></title>

</head>

<body>
    <!-- Canvas for JS Script -->
    <canvas id="c" style="display: block;"></canvas>

    <!-- Show an ending message in function of success or failiure -->
    <?php
    echo "<h1 class='centerPage " . $_SESSION["class"] . "'>" . $_SESSION["value"] . "</h1>";
    ?>

    <!-- Return to Index -->
    
    <h5>Retour à la page principale</h5>
    <form action="../index.html">
        <input type="submit" class="button1 bottomspace" value="Retour" />
    </form>
   
    <footer><p>© 2021 Gabriel Titi</p></footer>
    <!-- Custom JS Script for Matrix effect background -->
    <script src="../private/script.js"></script>
</body>

</html>