<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\Auth;
use App\Core\CSRF;
use App\Models\Post;

class PostController extends Controller {
    private function auth(Response $res): bool { if (!Auth::check()) { $res->redirect('/admin/login'); return false; } return true; }
    private function authorizeEditor(Response $res): bool {
        if (!(Auth::hasRole('SUPER_ADMIN') || Auth::hasRole('ADMIN') || Auth::hasRole('CONTENT_MANAGER'))) { $res->setStatus(403)->send('Forbidden'); return false; }
        return true;
    }
    public function index(Request $r, Response $res): void { if(!$this->auth($res) || !$this->authorizeEditor($res))return; $this->view('admin/posts/index', ['posts'=>Post::all()]); }
    public function create(Request $r, Response $res): void { if(!$this->auth($res) || !$this->authorizeEditor($res))return; $this->view('admin/posts/create', []); }
    public function store(Request $r, Response $res): void { if(!$this->auth($res) || !$this->authorizeEditor($res))return; if(!CSRF::verify($r->input('_token'))) { $res->setStatus(422)->send('Invalid CSRF'); return; }
        Post::create([
            'title'=>$r->input('title'),
            'slug'=>$r->input('slug'),
            'brand'=>$r->input('brand'),
            'content'=>$r->input('content'),
        ]);
        $res->redirect('/admin/posts');
    }
    public function edit(Request $r, Response $res, string $id): void { if(!$this->auth($res) || !$this->authorizeEditor($res))return; $this->view('admin/posts/edit', ['post'=>Post::find((int)$id)]); }
    public function update(Request $r, Response $res, string $id): void { if(!$this->auth($res) || !$this->authorizeEditor($res))return; if(!CSRF::verify($r->input('_token'))) { $res->setStatus(422)->send('Invalid CSRF'); return; }
        Post::update((int)$id, [
            'title'=>$r->input('title'),
            'slug'=>$r->input('slug'),
            'brand'=>$r->input('brand'),
            'content'=>$r->input('content'),
        ]);
        $res->redirect('/admin/posts');
    }
    public function destroy(Request $r, Response $res, string $id): void { if(!$this->auth($res) || !$this->authorizeEditor($res))return; if(!CSRF::verify($r->input('_token'))) { $res->setStatus(422)->send('Invalid CSRF'); return; }
        Post::delete((int)$id);
        $res->redirect('/admin/posts');
    }
}
