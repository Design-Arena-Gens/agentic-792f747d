<?php
namespace App\Core;

class Session {
    public static function start(string $secret): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_name('dualbrand');
            session_start();
            if (!isset($_SESSION['_started'])) {
                $_SESSION['_started'] = time();
                $_SESSION['_secret'] = $secret;
            }
        }
    }
}
