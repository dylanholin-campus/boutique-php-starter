<?php

class BankAccount
{
    private $balance;

    public function __construct()
    {
        $this->balance = 0;
    }

    public function deposit($amount)
    {
        if ($amount <= 0) {
            echo "Erreur : le montant doit être positif.\n";
            return;
        }
        $this->balance = $this->balance + $amount;
        echo "Dépôt de $amount effectué.\n";
    }

    public function withdraw($amount)
    {
        if ($amount <= 0) {
            echo "Erreur : le montant doit être positif.\n";
            return;
        }
        if ($amount > $this->balance) {
            echo "Erreur : solde insuffisant.\n";
            return;
        }
        $this->balance = $this->balance - $amount;
        echo "Retrait de $amount effectué.\n";
    }

    public function getBalance()
    {
        return $this->balance;
    }
}

$compte = new BankAccount();
$compte->deposit(100);
$compte->withdraw(30);
echo 'Solde actuel : ' . $compte->getBalance() . "\n";
$compte->withdraw(80); // Cette opération ne fonctionne pas ( volontairement )
