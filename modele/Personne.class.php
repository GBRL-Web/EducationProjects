<?php

// Name the class and give type of values
class Personne
{
    private $nom;
    private $prenom;
    private $dateNaiss;
    private $numTel;
    private $codeInsee;
    private $adresse;

    public function __construct($nom, $prenom, $dateNaiss, $numTel, $codeInsee, $adresse)
    {
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setDateNaiss($dateNaiss);
        $this->setNumTel($numTel);
        $this->setCodeInsee($codeInsee);
        $this->setAdresse($adresse);
    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     */
    public function setNom($nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     */
    public function setPrenom($prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of dateNaiss
     */
    public function getDateNaiss()
    {
        return $this->dateNaiss;
    }

    /**
     * Set the value of dateNaiss
     */
    public function setDateNaiss($dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    /**
     * Get the value of numTel
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * Set the value of numTel
     */
    public function setNumTel($numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    /**
     * Get the value of codeInsee
     */
    public function getCodeInsee()
    {
        return $this->codeInsee;
    }

    /**
     * Set the value of codeInsee
     */
    public function setCodeInsee($codeInsee): self
    {
        $this->codeInsee = $codeInsee;

        return $this;
    }

    /**
     * Get the value of adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     */
    public function setAdresse($adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function createPersonne($nom, $prenom, $dateNaiss, $numTel, $codeInsee, $adresse): bool
    {
        //Chaine de connexion à la base de donnée
        $bdd = new PDO('mysql:host=localhost;dbname=tp_personne;charset=utf8mb4', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $sql = "INSERT INTO personne (nom, prenom, dateNaiss, numTel, codeInsee, adresse) VALUES (?,?,?,?,?,?)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$nom, $prenom, $dateNaiss, $numTel, $codeInsee, $adresse]);
        return true;
    }
    public static function readPersonne($keyword)
    {
        // Use a variable to instance a connection to Database
        $sqli = new mysqli("localhost", "root", "", "tp_personne");

        // Write request for Database
        $sql = "SELECT " . $keyword . " FROM personne";

        // Perform request and get object response
        $result = $sqli->query($sql);

        // Turn object into array
        while ($row = $result->fetch_row()) {
            $table[] = $row;
        }
        // Close connection
        $sqli->close();

        // Return table to page that requested the function
        return $table;
    }

    public static function getInseeSql()
    {
        // Use a variable to instance a connection to Database
        $sqli = new mysqli("localhost", "root", "", "tp_personne");

        // Write request for Database
        $sql = "SELECT codeInsee FROM `personne`";
        
        // Perform request and get object response
        $result = $sqli->query($sql);

        // Turn object into array
        while ($row = $result->fetch_row()) {
            $table[] = $row[0];
        }
        // Return table to page that requested the function 
        return $table;
    }

    public static function deletePersonne($id)
    {
        // Use a variable to instance a connection to Database
        $sqli = new mysqli("localhost", "root", "", "tp_personne");

        // Write request for Database
        $sql = "DELETE FROM personne WHERE codeInsee = '" . $id . "'";

        // Perform request and get object response
        $result = $sqli->query($sql);

        // Close connection 
        $sqli->close();

        // Return boolean to page that requested the function
        return $result;
    }

    public static function readAllData()
    {
        //Use a variable to instance a connection to Database
        $sqli = new mysqli("localhost", "root", "", "tp_personne");

        // Write request for Database
        $sql = "SELECT nom, prenom, dateNaiss, numTel, codeInsee, adresse FROM `personne`";

        // Perform request and get object response
        $result = $sqli->query($sql);

        // Turn object into array
        while ($row = $result->fetch_row()) {
            $table[] = $row;
        }

        // Return table to page that requested the function 
        return $table;
    }

    public static function updateData($nom, $prenom, $dateNaiss, $numTel, $codeInsee, $adresse)
    {

        // Use a variable to instance a connection to Database
        $sqli = new mysqli("localhost", "root", "", "tp_personne");

        // Write request for Database
        $sql = "UPDATE `personne` SET nom='" . $nom . "', prenom='" . $prenom . "', dateNaiss='" . $dateNaiss . "', numTel='" . $numTel . "', adresse='" . $adresse . "' WHERE codeInsee='" . $codeInsee . "'";

        // Perform request and get object response
        $result = $sqli->query($sql);

        // Return boolean to page that requested the function
        return $result;
    }
}
