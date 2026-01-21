<?php

class HomeController
{
    public function index(): void
    {
        $title = 'Bienvenue sur ma boutique';
        require __DIR__ . '/../../views/home/index.php';
    }
}

// “Controller” = classe qui regroupe des actions (souvent dans une architecture MVC), “action” = méthode appelée pour répondre à une route.
