<?php
namespace App\Core;

class CSRF {
    public static function token(): string {
        if (!isset($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(16));
        }
        return $_SESSION['_csrf'];
    }
    public static function verify(?string $token): bool {
        return isset($_SESSION['_csrf']) && hash_equals($_SESSION['_csrf'], (string)$token);
    }
}
