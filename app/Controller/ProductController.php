<?php

class ProductController
{
    public function index(): void
    {
        $repo = new ProductRepository();
        $products = $repo->findAll();

        $title = 'Liste des produits';
        require __DIR__ . '/../../views/product/index.php';
    }

public function show(array $params = []): void
{
    if (!isset($params['id']) || $params['id'] === '') {
        header('Location: /produits');
        exit;
    }

    $id = (int) $params['id'];
    $repo = new ProductRepository();
    $product = $repo->find($id);

    if ($product === null) {
        http_response_code(404);
        $title = 'Page non trouvée';
        require __DIR__ . '/../../views/errors/404.php';
        return;
    }

    $title = $product['name'] ?? 'Détail produit';
    require __DIR__ . '/../../views/home/show.php';
}

}
