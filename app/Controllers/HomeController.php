<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\CSRF;
use App\Models\Lead;

class HomeController extends Controller {
    public function landing(Request $req, Response $res): void {
        $this->view('landing', []);
    }
    public function captureLead(Request $req, Response $res): void {
        if (!CSRF::verify($req->input('_token'))) { $res->setStatus(422)->send('Invalid CSRF'); return; }
        $name = trim($req->input('name',''));
        $email = trim($req->input('email',''));
        $brand = trim($req->input('brand',''));
        if ($name && $email && in_array($brand, ['shnikh','cordygen'])) {
            Lead::create($name, $email, $brand);
            $res->redirect('/'.$brand);
        } else {
            $res->setStatus(422)->send('Invalid data');
        }
    }

    public function shnikhHome(Request $r, Response $res): void { $this->view('shnikh/home', ['brand'=>'shnikh']); }
    public function shnikhAbout(Request $r, Response $res): void { $this->view('shnikh/about', ['brand'=>'shnikh']); }
    public function shnikhServices(Request $r, Response $res): void { $this->view('shnikh/services', ['brand'=>'shnikh']); }
    public function shnikhRnd(Request $r, Response $res): void { $this->view('shnikh/rnd', ['brand'=>'shnikh']); }
    public function contactShnikh(Request $r, Response $res): void { $this->view('shnikh/contact', ['brand'=>'shnikh']); }

    public function cordygenHome(Request $r, Response $res): void { $this->view('cordygen/home', ['brand'=>'cordygen']); }
    public function cordygenAbout(Request $r, Response $res): void { $this->view('cordygen/about', ['brand'=>'cordygen']); }
    public function cordygenScience(Request $r, Response $res): void { $this->view('cordygen/science', ['brand'=>'cordygen']); }
    public function cordygenFaq(Request $r, Response $res): void { $this->view('cordygen/faq', ['brand'=>'cordygen']); }
    public function contactCordygen(Request $r, Response $res): void { $this->view('cordygen/contact', ['brand'=>'cordygen']); }
}
