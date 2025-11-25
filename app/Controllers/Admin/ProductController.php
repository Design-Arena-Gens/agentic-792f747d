<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\Auth;
use App\Core\CSRF;
use App\Models\Product;

class ProductController extends Controller {
    private function auth(Response $res): bool { if (!Auth::check()) { $res->redirect('/admin/login'); return false; } return true; }
    private function authorizeManager(Response $res): bool {
        if (!(Auth::hasRole('SUPER_ADMIN') || Auth::hasRole('ADMIN'))) { $res->setStatus(403)->send('Forbidden'); return false; }
        return true;
    }
    public function index(Request $r, Response $res): void { if(!$this->auth($res) || !$this->authorizeManager($res))return; $this->view('admin/products/index', ['products'=>Product::all()]); }
    public function create(Request $r, Response $res): void { if(!$this->auth($res) || !$this->authorizeManager($res))return; $this->view('admin/products/create', []); }
    public function store(Request $r, Response $res): void {
        if(!$this->auth($res) || !$this->authorizeManager($res))return; if (!CSRF::verify($r->input('_token'))) { $res->setStatus(422)->send('Invalid CSRF'); return; }
        Product::create([
            'name'=>$r->input('name'),
            'slug'=>$r->input('slug'),
            'brand'=>$r->input('brand'),
            'price'=>(float)$r->input('price'),
            'description'=>$r->input('description'),
        ]);
        $res->redirect('/admin/products');
    }
    public function edit(Request $r, Response $res, string $id): void { if(!$this->auth($res) || !$this->authorizeManager($res))return; $this->view('admin/products/edit', ['product'=>Product::find((int)$id)]); }
    public function update(Request $r, Response $res, string $id): void {
        if(!$this->auth($res) || !$this->authorizeManager($res))return; if (!CSRF::verify($r->input('_token'))) { $res->setStatus(422)->send('Invalid CSRF'); return; }
        Product::update((int)$id, [
            'name'=>$r->input('name'),
            'slug'=>$r->input('slug'),
            'brand'=>$r->input('brand'),
            'price'=>(float)$r->input('price'),
            'description'=>$r->input('description'),
        ]);
        $res->redirect('/admin/products');
    }
    public function destroy(Request $r, Response $res, string $id): void {
        if(!$this->auth($res) || !$this->authorizeManager($res))return; if (!CSRF::verify($r->input('_token'))) { $res->setStatus(422)->send('Invalid CSRF'); return; }
        Product::delete((int)$id);
        $res->redirect('/admin/products');
    }
}
