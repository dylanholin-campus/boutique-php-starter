<?php

class User
{
    private $nom;
    private $email;

    public function __construct($nom, $email)
    {
        $this->nom = $nom;
        $this->email = $email;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function getEmail()
    {
        return $this->email;
    }
}

class Product
{
    private $nom;
    private $prix;

    public function __construct($nom, $prix)
    {
        $this->nom = $nom;
        $this->prix = (float)$prix;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function getPrix()
    {
        return $this->prix;
    }
}

class CartItem
{
    private $product;
    public $quantite;

    public function __construct($product, $quantite)
    {
        $this->product = $product;
        $this->quantite = max(0, (int)$quantite);
    }

    public function getProduct()
    {
        return $this->product;
    }
    public function getTotal()
    {
        return $this->product->getPrix() * $this->quantite;
    }
}

class Cart
{
    private $items = [];

    public function add($product, $quantite = 1)
    {
        $nomProduit = $product->getNom();
        $quantite = max(0, (int)$quantite);
        if ($quantite === 0) {
            return;
        }

        if (isset($this->items[$nomProduit])) {
            $this->items[$nomProduit]->quantite += $quantite;
        } else {
            $this->items[$nomProduit] = new CartItem($product, $quantite);
        }
    }

    public function remove($nomProduit)
    {
        if (isset($this->items[$nomProduit])) {
            unset($this->items[$nomProduit]);
        }
    }

    public function update($nomProduit, $nouvelleQuantite)
    {
        $nouvelleQuantite = max(0, (int)$nouvelleQuantite);
        if (!isset($this->items[$nomProduit])) {
            return;
        }

        if ($nouvelleQuantite === 0) {
            $this->remove($nomProduit);
            return;
        }

        $this->items[$nomProduit]->quantite = $nouvelleQuantite;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }
        return $total;
    }

    public function count()
    {
        return count($this->items);
    }

    public function clear()
    {
        $this->items = [];
    }

    public function getItems()
    {
        return $this->items;
    }
}

class Order
{
    private $id;
    private $user;
    private $items;  // tableau de CartItem (copie du panier)
    private $date;
    private $statut;

    public function __construct($id, $user, $cart)
    {
        $this->id = $id;
        $this->user = $user;
        $this->items = $cart->getItems();  // on copie les items du panier
        $this->date = date('Y-m-d H:i:s');
        $this->statut = 'en_attente';
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }
        return $total;
    }

    public function getItemCount()
    {
        $nombre = 0;
        foreach ($this->items as $item) {
            $nombre += $item->quantite;
        }
        return $nombre;
    }

    public function setStatut($nouveauStatut)
    {
        $this->statut = $nouveauStatut;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getItems()
    {
        return $this->items;
    }
}

function afficherPanier($panier, $titre)
{
    echo '<strong>' . $titre . '</strong><br>';
    echo "Nombre d'articles différents : " . $panier->count() . '<br>';
    echo 'Total panier : ' . number_format($panier->getTotal(), 2) . ' €<br>';

    if ($panier->count() === 0) {
        echo '(panier vide)<br><br>';
        return;
    }

    foreach ($panier->getItems() as $nomProduit => $item) {
        echo '- ' . $nomProduit
            . ' | prix: ' . number_format($item->getProduct()->getPrix(), 2) . ' €'
            . ' | quantité: ' . $item->quantite
            . ' | sous-total: ' . number_format($item->getTotal(), 2) . ' €<br>';
    }

    echo '<br>';
}


$utilisateur = new User('Bob', 'bob@example.com');

$oeufDragon = new Product('Oeuf de dragon', 12.50);
$poussiereLicorne = new Product('Poussière de licorne', 4.20);
$plumePhenix = new Product('Plume de phénix', 7.90);

$panierMagique = new Cart();

$panierMagique->add($oeufDragon, 2);
$panierMagique->add($poussiereLicorne, 3);
$panierMagique->add($plumePhenix, 1);

afficherPanier($panierMagique, 'Panier avant commande');

$commande = new Order(1, $utilisateur, $panierMagique); /* Création de la commande à partir du Cart et du User */

echo '<strong>Commande #' . $commande->getId() . '</strong><br>';
echo 'Client : ' . $commande->getUser()->getNom() . ' (' . $commande->getUser()->getEmail() . ')<br>';
echo 'Date : ' . $commande->getDate() . '<br>';
echo 'Statut : ' . $commande->getStatut() . '<br>';
echo "Nombre total d'articles : " . $commande->getItemCount() . '<br>';
echo 'Total commande : ' . number_format($commande->getTotal(), 2) . ' €<br><br>';

$commande->setStatut('payee');
echo 'Nouveau statut de la commande : ' . $commande->getStatut() . '<br>';
