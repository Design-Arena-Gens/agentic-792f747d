<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Post;

class BlogController extends Controller {
    public function listShnikh(Request $r, Response $res): void {
        $posts = Post::listByBrand('shnikh');
        $this->view('shnikh/blog', ['brand'=>'shnikh','posts'=>$posts]);
    }
    public function detailShnikh(Request $r, Response $res, string $slug): void {
        $post = Post::findBySlug($slug);
        if (!$post || $post['brand'] !== 'shnikh') { $res->setStatus(404)->send('Not found'); return; }
        $this->view('shnikh/blog_detail', ['brand'=>'shnikh','post'=>$post]);
    }
    public function listCordygen(Request $r, Response $res): void {
        $posts = Post::listByBrand('cordygen');
        $this->view('cordygen/blog', ['brand'=>'cordygen','posts'=>$posts]);
    }
    public function detailCordygen(Request $r, Response $res, string $slug): void {
        $post = Post::findBySlug($slug);
        if (!$post || $post['brand'] !== 'cordygen') { $res->setStatus(404)->send('Not found'); return; }
        $this->view('cordygen/blog_detail', ['brand'=>'cordygen','post'=>$post]);
    }
}
