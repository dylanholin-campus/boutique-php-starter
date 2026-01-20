<?php
// public/index.php

require __DIR__ . '/../app/Router.php';
require __DIR__ . '/../app/Controller/HomeController.php';

$router = new Router();

// Route / -> HomeController::index()
$router->get('/', [HomeController::class, 'index']);

// (Optionnel) Route /produits juste pour éviter un 404 si tu cliques le lien
$router->get('/produits', [HomeController::class, 'index']);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($uri, $method);
