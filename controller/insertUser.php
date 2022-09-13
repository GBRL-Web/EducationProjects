<?php
session_start();
include "../modele/Personne.class.php";

$newPers = new Personne($_POST["nom"],$_POST["prenom"],$_POST["dateNaiss"], $_POST["numTel"], $_POST["codeInsee"], $_POST["adresse"] );
$status = $newPers->createPersonne($_POST["nom"],$_POST["prenom"],$_POST["dateNaiss"], $_POST["numTel"], $_POST["codeInsee"], $_POST["adresse"] );

if($status){
	$_SESSION["title"] = "Success!";
	$_SESSION["value"] = "Insertion OK!";
	$_SESSION["class"] = "vert";
	header('Location: ../views/returnPages/response.php');
	exit;
}else
{
	$_SESSION["title"] = "Fail!";
	$_SESSION["value"] = "Insertion echoue!";
	$_SESSION["class"] = "rouge";
	header('Location: ../views/returnPages/response.php');
	exit;
}

?>