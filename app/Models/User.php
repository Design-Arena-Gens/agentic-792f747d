<?php
namespace App\Models;
use App\Core\DB;

class User {
    public static function findByEmail(string $email): ?array { $st=DB::pdo()->prepare('SELECT * FROM users WHERE email=?'); $st->execute([$email]); $u=$st->fetch(); return $u ?: null; }
    public static function roles(int $userId): array { $st=DB::pdo()->prepare('SELECT r.name FROM roles r JOIN role_user ru ON ru.role_id=r.id WHERE ru.user_id=?'); $st->execute([$userId]); return array_column($st->fetchAll(), 'name'); }
}
