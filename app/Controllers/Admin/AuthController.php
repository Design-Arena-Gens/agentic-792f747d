<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\Auth;
use App\Core\CSRF;

class AuthController extends Controller {
    public function loginForm(Request $r, Response $res): void { $this->view('admin/login', []); }
    public function login(Request $r, Response $res): void {
        if (!CSRF::verify($r->input('_token'))) { $res->setStatus(422)->send('Invalid CSRF'); return; }
        if (Auth::attempt($r->input('email',''), $r->input('password',''))) {
            $res->redirect('/admin');
        } else {
            $this->view('admin/login', ['error'=>'Invalid credentials']);
        }
    }
    public function logout(Request $r, Response $res): void { \App\Core\Auth::logout(); $res->redirect('/admin/login'); }
}
