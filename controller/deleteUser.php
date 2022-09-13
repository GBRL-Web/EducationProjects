<?php
session_start();
include "../modele/Personne.class.php";

$status = Personne::deletePersonne($_POST["INSEE"]);

var_dump($status);
if ($status) {
	$_SESSION["title"] = "Success!";
	$_SESSION["value"] = "Suppression OK!";
	$_SESSION["class"] = "vert";
	header('Location: ../views/returnPages/response.php');
	exit;
} else {
	$_SESSION["title"] = "Fail!";
	$_SESSION["value"] = "Suppression échoué!";
	$_SESSION["class"] = "rouge";
	header('Location: ../views/returnPages/response.php');
	exit;
}
