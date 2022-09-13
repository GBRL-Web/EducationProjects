<?php
include "Client.class.php";
class Account
{
    private $client;
    private $balance;
    public static $cliNum;

    public function __construct($firstN, $lastN, $cin, $tel)
    {
        $this->client = new Client($firstN, $lastN, $cin, $tel);
        $this->balance = 0;
        self::$cliNum++;
    }

    /**
     * Get the value of balance
     */ 
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set the value of balance
     *
     * @return  self
     */ 
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Set the value of client
     *
     * @return  self
     */ 
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    public function showDet()
    {
        echo "Account details:";
        echo "\n************************************";
        echo "\nAccount number: ".Account::$cliNum;
        echo "\nAccount balance: ".$this->getBalance();
        echo "\nFirst name: ".$this->client->getFirstName();
        echo "\nLast name: ".$this->client->getLastName();
        echo "\nCIN number: ".$this->client->getCin();
        echo "\nTelephone: ".$this->client->getTel();
        echo "\n************************************";
    }

    public function debAcc($sum) {
        $this->balance = $this->balance - $sum;
    }
    public function credAcc($sum) {
        $this->balance = $this->balance + $sum;
    }
}


?>