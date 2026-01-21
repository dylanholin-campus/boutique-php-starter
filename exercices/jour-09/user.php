<?php

class Address
{
    private $rue;
    private $ville;
    private $codePostal;
    private $pays;

    public function __construct($rue, $ville, $codePostal, $pays)
    {
        $this->rue = $rue;
        $this->ville = $ville;
        $this->codePostal = $codePostal;
        $this->pays = $pays;
    }

    // getters (pour lire depuis l'extérieur)
    public function getRue()
    {
        return $this->rue;
    }
    public function getVille()
    {
        return $this->ville;
    }
    public function getCodePostal()
    {
        return $this->codePostal;
    }
    public function getPays()
    {
        return $this->pays;
    }

    public function toString()
    {
        return $this->rue . ', ' . $this->codePostal . ' ' . $this->ville . ', ' . $this->pays;
    }
}

class User
{
    private $nom;
    private $email;
    private $dateInscription;
    private $adresses = [];

    public function __construct($nom, $email, $dateInscription)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->dateInscription = $dateInscription;
    }

    // getters (pour lire depuis l'extérieur)
    public function getNom()
    {
        return $this->nom;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    public function addAddress($address)
    {
        $this->adresses[] = $address;
    }

    public function getAddresses()
    {
        return $this->adresses;
    }

    public function getDefaultAddress()
    {
        if (count($this->adresses) === 0) {
            return null;
        }
        return $this->adresses[0];
    }
}

$utilisateur = new User('Bob', 'bob@example.com', '2026-01-15');

$adresseMaison = new Address('12 rue des Dragons', 'Mageville', '26000', 'France');
$adresseTravail = new Address('7 avenue des Licornes', 'Sorcière-sur-Rhône', '26100', 'France');

$utilisateur->addAddress($adresseMaison);
$utilisateur->addAddress($adresseTravail);

echo 'User: ' . $utilisateur->getNom()
    . ' (' . $utilisateur->getEmail() . ')'
    . ' inscrit le ' . $utilisateur->getDateInscription() . '<br><br>';

echo 'Toutes les adresses :<br>';
foreach ($utilisateur->getAddresses() as $adresse) {
    echo '- ' . $adresse->toString() . '<br>';
}

$adresseParDefaut = $utilisateur->getDefaultAddress();
echo '<br>Adresse par défaut :<br>';
if ($adresseParDefaut === null) {
    echo '(aucune adresse)<br>';
} else {
    echo $adresseParDefaut->toString() . '<br>';
}
