<?php

class CartController
{
    private function getCart(): array
    {
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        return $_SESSION['cart'];
    }

    private function saveCart(array $cart): void
    {
        $_SESSION['cart'] = $cart;
    }

    public function index(): void
    {
        $repo = new ProductRepository();
        $cart = $this->getCart();

        $items = [];
        $total = 0.0;

        foreach ($cart as $productId => $qty) {
            $product = $repo->find((int)$productId);
            if ($product === null) {
                // Produit supprimé de la DB => on le retire du panier
                continue;
            }

            $qty = max(1, (int)$qty);
            $lineTotal = ((float)$product['price']) * $qty;
            $total += $lineTotal;

            $items[] = [
                'product' => $product,
                'qty' => $qty,
                'lineTotal' => $lineTotal,
            ];
        }

        $title = 'Mon panier';
        require __DIR__ . '/../../views/cart/index.php';
    }

    public function add(): void
    {
        $id  = (int)($_POST['id'] ?? 0);
        $qty = max(1, (int)($_POST['qty'] ?? 1));

        $repo = new ProductRepository();
        if ($id <= 0 || $repo->find($id) === null) {
            flash('error', 'Produit introuvable.');
            redirect('/panier');
        }

        $cart = $this->getCart();
        $cart[$id] = ($cart[$id] ?? 0) + $qty;
        $this->saveCart($cart);

        flash('success', 'Produit ajouté au panier.');
        $back = $_SERVER['HTTP_REFERER'] ?? '/produits';
        header('Location: ' . $back);
        exit;
    }


    public function remove(): void
    {
        $id = (int)($_POST['id'] ?? 0);

        $cart = $this->getCart();
        unset($cart[$id]);
        $this->saveCart($cart);

        header('Location: /panier');
        exit;
    }

    public function update(): void
    {
        // Supporte soit 1 produit (id+qty), soit un tableau quantities[id]=qty
        $cart = $this->getCart();

        if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
            foreach ($_POST['quantities'] as $id => $qty) {
                $id = (int)$id;
                $qty = (int)$qty;

                if ($qty <= 0) {
                    unset($cart[$id]);
                } else {
                    $cart[$id] = $qty;
                }
            }
        } else {
            $id  = (int)($_POST['id'] ?? 0);
            $qty = (int)($_POST['qty'] ?? 1);

            if ($qty <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id] = $qty;
            }
        }

        $this->saveCart($cart);

        header('Location: /panier');
        exit;
    }
}
