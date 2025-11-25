<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\Auth;
use App\Core\CSRF;
use App\Models\Order;

class OrderController extends Controller {
    private function auth(Response $res): bool { if (!Auth::check()) { $res->redirect('/admin/login'); return false; } return true; }
    public function index(Request $r, Response $res): void { if(!$this->auth($res))return; $this->view('admin/orders/index', ['orders'=>Order::all()]); }
    public function show(Request $r, Response $res, string $id): void { if(!$this->auth($res))return; $this->view('admin/orders/show', ['order'=>Order::find((int)$id)]); }
    public function updateStatus(Request $r, Response $res, string $id): void { if(!$this->auth($res))return; if(!CSRF::verify($r->input('_token'))) { $res->setStatus(422)->send('Invalid CSRF'); return; }
        Order::updateStatus((int)$id, $r->input('status','pending'));
        $res->redirect('/admin/orders/'.$id);
    }
}
