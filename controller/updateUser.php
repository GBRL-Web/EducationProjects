<?php
// Start session
session_start();

// Include Person class for input model and functions.
include "../modele/Personne.class.php";

// Update data with POST and Session data and store boolean response in variable
$status = Personne::updateData($_POST['nom'],$_POST['prenom'],$_POST['dateNaiss'],$_POST['numTel'],$_SESSION["INSEE"],$_POST['adresse']);

// If statement for redirecting to a success or fail page
if ($status) {
	// Setting session variables in function of boolean response
	$_SESSION["title"] = "Success!";
	$_SESSION["value"] = "Modification OK!";
	$_SESSION["class"] = "vert";
	header('Location: ../views/returnPages/response.php');
	exit;
} else {
	$_SESSION["title"] = "Fail!";
	$_SESSION["value"] = "Modification échoué!";
	$_SESSION["class"] = "rouge";
	header('Location: ../views/returnPages/response.php');
	exit;
}
?>