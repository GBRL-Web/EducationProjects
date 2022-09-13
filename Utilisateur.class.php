<?php

include "Person.class.php";
include "Profil.class.php";

class User extends Person
{
    private $login;
    private $password;
    private $service;
    private $prof;

    public function __construct(string $fName, string $lName, string $mail, string $tel, float $salary, string $login, string $password, string $service, string $code, string $profile)
    {
        parent::__construct($fName, $lName, $mail, $tel, $salary);
        $this->login = $login;
        $this->password = $password;
        $this->service = $service;
        $this->prof = new Profile($code, $profile);

    }

    public static function calcSal($code, $salary) 
    {
        switch ($code) {
            case 'MN':
                $coef = 0.1;
                break;
            case 'D':
                $coef = 0.4;
                break;
            default:
                return $salary;
                break;
        }
        return Person::calcSalary($coef, $salary);
    }

    public static function showInfo($user) 
    {
        echo "\n\nFirst name: ".$user->fName."\n";
        echo "Last name: ".$user->lName."\n";
        echo "E-mail: ".$user->mail."\n";
        echo "Telephone: ".$user->tel."\n";
        echo "Profile: ".$user->prof->getProfile()."\n";
        echo "Salary w/o the raise: $".$user->salary."\n";
        echo "Salary: $".self::calcSal($user->prof->getCode(), $user->salary)."\n";
    }
} 

?>