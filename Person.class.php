<?php

class Person{
    protected $id;
    protected $fName;
    protected $lName;
    protected $mail;
    protected $tel;
    protected $salary;
    
    public function __construct(string $fName, string $lName, string $mail, string $tel, float $salary)
    {
        $this->id++;
        $this->fName = $fName ;
        $this->lName = $lName ;
        $this->mail = $mail ;
        $this->tel = $tel ;
        $this->salary= $salary;
    }

    public static function calcSalary($pr, $sal) : float 
    {
        $res = $pr * $sal + $sal;
        return $res;
    }


}
?>