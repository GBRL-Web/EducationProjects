<?php

include "Utilisateur.class.php";

function getRandomArrayElement($array)
{
    $randomIndex = array_rand($array);
    $randomElement = $array[$randomIndex];
    return $randomElement;
}

function randomString($len) {
    $return = "";
    for($i = 0; $i < $len; $i ++){
        $return .= chr(rand(97, 122));
    }
    return $return;
}

function getUsers($limit) 
{
   for ($i=1; $i <= $limit; $i++) { 
       $listOfUsers[] = createUser();
   }
    return $listOfUsers;
}

function createUser() {
    $nomArray = array("Sadjo","Slimane", "Valerian","Kristopher","Orelien","Ugo","Rachid","Ruba","Gabriel","Hassan","Yoann","Redouane","Tom","Moussa","Daniel","Jaffa");
    $prenomArray = array("Daffe","Chihati","Raya","Takdjerad","El Mourabit","Titi","Lengrand","Mend","Touzard","Bott","Bouheraoua","Planque","Penet","Cake","Michaels","Johnson","Dudanne","McNeil");
    $libArray = array("Chef de projet", "Directeur generale", "Directeur de projet", "Directeur des ressources humaines", "Manager");
    $nom = getRandomArrayElement($nomArray);
    $prenom = getRandomArrayElement($prenomArray);
    $mail = $nom.".".$prenom.".".randomString(4)."@jesuisriche.com";
    $telephone = 0 . rand(600000000, 799999999);
    $salaire = rand(1000, 99999);
    $login = randomString(12);;
    $password = rand(100000000, 999999999);
    $service = randomString(10);;
    $libelle = getRandomArrayElement($libArray);
    
    switch ($libelle) {
        case "Chef de projet":
            $code = "CP";
            break;
        case "Directeur generale":
        case "Directeur des ressources humaines":
        case "Directeur de projet":
            $code = "D";
            break;
        case "Manager":
            $code = "MN";
            break;
        default:            
            break;
    }
    return new User($nom, $prenom, $mail, $telephone, $salaire, $login, $password, $service, $code, $libelle);
}

foreach (getUsers(5) as $user) {
    User::showInfo($user);
}

?>