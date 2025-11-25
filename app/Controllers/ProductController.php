<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Product;

class ProductController extends Controller {
    public function listShnikh(Request $r, Response $res): void {
        $products = Product::listByBrand('shnikh');
        $this->view('shnikh/products', ['brand'=>'shnikh','products'=>$products]);
    }
    public function listCordygen(Request $r, Response $res): void {
        $products = Product::listByBrand('cordygen');
        $this->view('cordygen/products', ['brand'=>'cordygen','products'=>$products]);
    }
    public function detailCordygen(Request $r, Response $res, string $slug): void {
        $product = Product::findBySlug($slug);
        if (!$product || $product['brand'] !== 'cordygen') { $res->setStatus(404)->send('Not found'); return; }
        $this->view('cordygen/product_detail', ['brand'=>'cordygen','product'=>$product]);
    }
}
