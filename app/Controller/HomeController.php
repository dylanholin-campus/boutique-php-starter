<?php
// app/Controller/HomeController.php
class HomeController
{
    public function index(): void
    {
        $title = "Bienvenue sur ma boutique";
        require __DIR__ . '/../../views/home/index.php';
    }
}
