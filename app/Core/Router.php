<?php
namespace App\Core;

class Router {
    private array $routes = [];

    public function get(string $path, array $handler): void { $this->add('GET', $path, $handler); }
    public function post(string $path, array $handler): void { $this->add('POST', $path, $handler); }

    private function add(string $method, string $path, array $handler): void {
        $this->routes[$method.$path] = ['path'=>$path,'handler'=>$handler];
    }

    public function dispatch(Request $req, Response $res): void {
        $uri = $req->path();
        $method = $req->method();

        // Exact match
        if (isset($this->routes[$method.$uri])) {
            $this->invoke($this->routes[$method.$uri]['handler'], $req, $res);
            return;
        }

        // Parameterized: /brand/product/{slug}
        foreach ($this->routes as $key => $route) {
            if (!str_starts_with($key, $method)) continue;
            $pattern = preg_replace('#\{[^/]+\}#','([^/]+)', $route['path']);
            $pattern = '#^'.str_replace('#','\#',$pattern).'$#';
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                $this->invoke($route['handler'], $req, $res, $matches);
                return;
            }
        }

        $res->setStatus(404)->send('Not Found');
    }

    private function invoke(array $handler, Request $req, Response $res, array $params=[]): void {
        [$class, $method] = $handler;
        $controller = new $class();
        $controller->$method($req, $res, ...$params);
    }
}
