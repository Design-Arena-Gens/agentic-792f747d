<?php
namespace App\Core;
use App\Models\User;

class Auth {
    public static function user(): ?array { return $_SESSION['user'] ?? null; }
    public static function check(): bool { return (bool) self::user(); }
    public static function attempt(string $email, string $password): bool {
        $user = User::findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }
    public static function logout(): void { unset($_SESSION['user']); }
    public static function hasRole(string $role): bool {
        $u = self::user();
        if (!$u) return false;
        return in_array($role, User::roles($u['id']));
    }
}
