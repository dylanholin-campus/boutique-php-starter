<?php

class User
{
    public $nom;
    public $email;
    public $password;
    public $dateInscription;

    public function __construct($nom, $email, $password, $dateInscription = null)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->dateInscription = $dateInscription ?? date('Y-m-d H:i:s');
    }

    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function isNewMember()
    {
        $date = new DateTime($this->dateInscription);
        $now = new DateTime();
        $interval = $now->diff($date);
        return $interval->days < 30;
    }
}
