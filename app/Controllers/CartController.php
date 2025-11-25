<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\CSRF;
use App\Models\Product;

class CartController extends Controller {
    public function show(Request $r, Response $res): void {
        $this->view('cart/show', ['cart' => $_SESSION['cart'] ?? []]);
    }
    public function add(Request $r, Response $res): void {
        if (!CSRF::verify($r->input('_token'))) { $res->setStatus(422)->send('Invalid CSRF'); return; }
        $productId = (int) $r->input('product_id');
        $qty = max(1, (int) $r->input('qty', 1));
        $product = Product::find($productId);
        if (!$product) { $res->setStatus(404)->send('Product not found'); return; }
        $_SESSION['cart'] = $_SESSION['cart'] ?? [];
        $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + $qty;
        $res->redirect('/cart');
    }
    public function remove(Request $r, Response $res): void {
        if (!CSRF::verify($r->input('_token'))) { $res->setStatus(422)->send('Invalid CSRF'); return; }
        $productId = (int) $r->input('product_id');
        if (isset($_SESSION['cart'][$productId])) unset($_SESSION['cart'][$productId]);
        $res->redirect('/cart');
    }
}
