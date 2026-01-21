<?php

session_start();


require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/Router.php';

require_once __DIR__ . '/../app/Controller/HomeController.php';
require_once __DIR__ . '/../app/Controller/ProductController.php';
require_once __DIR__ . '/../app/Controller/CartController.php';

require_once __DIR__ . '/../app/Repository/ProductRepository.php';

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/produits', [ProductController::class, 'index']);
$router->get('/produits/{id}', [ProductController::class, 'show']);

require __DIR__ . '/../config/routes.php';

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
