<?php

class ProductController
{
    public function index(): void
    {
        $repo = new ProductRepository();
        $products = $repo->findAll();

        view('product/index', [
            'title' => 'Liste des produits',
            'products' => $products,
        ]);
    }

    public function show(array $params = []): void
    {
        if (!isset($params['id']) || $params['id'] === '') {
            redirect('/produits');
        }

        $id = (int) $params['id'];

        $repo = new ProductRepository();
        $product = $repo->find($id);

        if ($product === null) {
            http_response_code(404);
            view('errors/404', ['title' => 'Page non trouvée']);
            return;
        }

        view('home/show', [
            'title' => $product['name'] ?? 'Détail produit',
            'product' => $product,
        ]);
    }
}
