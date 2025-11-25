<?php
namespace App\Models;
use App\Core\DB;

class Lead {
    public static function create(string $name, string $email, string $brand): void { $st=DB::pdo()->prepare('INSERT INTO leads(name,email,brand,created_at) VALUES(?,?,?,NOW())'); $st->execute([$name,$email,$brand]); }
}
