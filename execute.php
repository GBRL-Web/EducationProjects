<?php

include "Account.class.php";
$n = 1;

// function newAcc($m) {
//     echo "\nEntrez prenom:";
//     $fName = trim(fgets(STDIN));
//     echo "\nEntrez nom:";
//     $lName = trim(fgets(STDIN));
//     echo "\nEntrez le CIN:";
//     $cin = trim(fgets(STDIN));
//     echo "\nEntrez telephone:";
//     $tel = trim(fgets(STDIN));
//     ${"cmpt$m"} = new Account($fName, $lName, $cin, $tel);
//     echo "Compte cree en success!";
//     return ${"cmpt$m"};
// }

while (true) {

    echo "\n1 <- Creer compte.";
    echo "\n2 <- Debiter compte.";
    echo "\n3 <- Crediter compte.";
    echo "\n4 <- Transferer montant entre comptes.";
    echo "\n5 <- Voir details de compte.";
    echo "\nAutre <- Quitter.";
    echo "\nEntrez une commande:";
    $rep = trim(fgets(STDIN));
    if ($rep == "1") {
        echo "\nEntrez prenom:";
        $fName = trim(fgets(STDIN));
        echo "\nEntrez nom:";
        $lName = trim(fgets(STDIN));
        echo "\nEntrez le CIN:";
        $cin = trim(fgets(STDIN));
        echo "\nEntrez telephone:";
        $tel = trim(fgets(STDIN));
        ${"cmpt$n"} = new Account($fName, $lName, $cin, $tel);
        echo "Compte cree en success!";
        $n++;        
    } else if ($rep == "2") {
        echo "\nChoisir un compte[ ";
        for ($i=1; $i < $n; $i++) { 
           echo $i." ";
        } echo "]: ";
        $nrComp = trim(fgets(STDIN));
        echo "\nEntrez montant a debiter: ";
        $deb = trim(fgets(STDIN));
        ${"cmpt$nrComp"}->debAcc($deb);
    } else if ($rep == "3") {
        echo "\nChoisir un compte [ ";
        for ($i=1; $i < $n; $i++) { 
           echo $i." ";
        } echo "]: ";
        $nrComp = trim(fgets(STDIN));
        echo "\nEntrez montant a crediter: ";
        $cred = trim(fgets(STDIN));
        ${"cmpt$nrComp"}->credAcc($cred);
    } else if ($rep == "4") {
        echo "\nChoisir un compte a debiter [ ";
        for ($i=1; $i < $n; $i++) { 
            echo $i." ";
        } echo "]: ";
        $nrComp1 = trim(fgets(STDIN));
        echo "\nChoisir un compte a crediter:[ ";
        for ($i=1; $i < $n; $i++) { 
            echo $i." ";
        } echo "]: ";
        $nrComp2 = trim(fgets(STDIN));
        echo "\nEntrez montant a debiter: ";
        $deb = trim(fgets(STDIN));
        ${"cmpt$nrComp1"}->debAcc($deb);
        ${"cmpt$nrComp2"}->credAcc($deb);
    } else if ($rep == "5") {
        echo "\nChoisir un compte a verifier[ ";
        for ($i=1; $i < $n; $i++) { 
            echo $i." ";
        } echo "]: ";
        $nrComp = trim(fgets(STDIN));
        ${"cmpt$nrComp"}->showDet();
    } else {
        break;
    }
}

?>