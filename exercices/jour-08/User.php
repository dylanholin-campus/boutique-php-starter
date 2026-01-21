<?php

class User
{
    public $name;
    public $email;
    public $registrationDate; // On va stocker un objet DateTime

    public function __construct($name, $email, $date = null)
    {    // $date = null permet de rendre la date optionnelle
        $this->name = $name;
        $this->email = $email;

        if ($date) {
            $this->registrationDate = new DateTime($date);
        } else {
            $this->registrationDate = new DateTime();
        }
    }

    public function isNewMember()
    {
        $today = new DateTime();
        $interval = $today->diff($this->registrationDate);         // je calcule la différence entre aujourd'hui et l'inscription
        return $interval->days < 30;         // teste si moins de 30 jours d'écart (nouvel utilisateur)
    }
}

$user1 = new User('Thomas', 'thomas@test.fr'); // Utilisateur sans date (donc inscrit aujourd'hui)
$user2 = new User('Sarah', 'sarah@test.fr', '2025-11-01'); // Utilisateur inscrit il y a 2 mois (fixe une date ancienne)

echo $user1->name . ' est nouveau ? ' . ($user1->isNewMember() ? 'OUI' : 'NON') . '<br>';
echo $user2->name . ' est nouveau ? ' . ($user2->isNewMember() ? 'OUI' : 'NON') . '<br>';
