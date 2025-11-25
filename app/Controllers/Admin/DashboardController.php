<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\Auth;

class DashboardController extends Controller {
    public function index(Request $r, Response $res): void {
        if (!Auth::check()) { $res->redirect('/admin/login'); return; }
        $this->view('admin/dashboard', []);
    }
}
