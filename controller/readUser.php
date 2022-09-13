<?php
session_start();
include "../modele/Personne.class.php";

if ($_POST == false) {
	$_SESSION["title"] = "Fail!";
	$_SESSION["value"] = "Il faut choisir au moins 1 champ!";
	$_SESSION["class"] = "rouge";
	header('Location: ../views/returnPages/response.php');
	exit;
} else {
	foreach ($_POST as $key => $entry) {
		$tab[] = $key;
	}
}


$string = implode(", ", $tab);
$resultat = Personne::readPersonne($string);
$_SESSION['resultNames'] = $tab;
$_SESSION['result'] = $resultat;

if ($resultat !== NULL) {
	$_SESSION["title"] = "Success!";
	$_SESSION["value"] = "Insertion OK!";
	$_SESSION["class"] = "vert";
	header('Location: ../views/returnPages/readtable.php');
	exit;
} else {
	$_SESSION["title"] = "Fail!";
	$_SESSION["value"] = "Insertion echoue!";
	$_SESSION["class"] = "rouge";
	header('Location: ../views/returnPages/response.php');
	exit;
}
