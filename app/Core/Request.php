<?php
namespace App\Core;

class Request {
    public static function capture(): self { return new self; }
    public function method(): string { return $_SERVER['REQUEST_METHOD'] ?? 'GET'; }
    public function path(): string {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $q = strpos($uri, '?');
        if ($q !== false) $uri = substr($uri, 0, $q);
        return rtrim($uri, '/') ?: '/';
    }
    public function input(string $key, $default=null) { return $_POST[$key] ?? $_GET[$key] ?? $default; }
    public function json(): array { $raw = file_get_contents('php://input'); return json_decode($raw, true) ?: []; }
    public function session(): array { return $_SESSION ?? []; }
    public function brand(): ?string {
        $p = $this->path();
        if ($p === '/') return null;
        $parts = explode('/', trim($p,'/'));
        $b = $parts[0] ?? null;
        return in_array($b, ['shnikh','cordygen']) ? $b : null;
    }
}
