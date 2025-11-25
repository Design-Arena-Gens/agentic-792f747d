<?php
namespace App\Models;
use App\Core\DB; use PDO;

class Product {
    public static function all(): array { return DB::pdo()->query('SELECT * FROM products ORDER BY created_at DESC')->fetchAll(); }
    public static function listByBrand(string $brand): array { $st=DB::pdo()->prepare('SELECT * FROM products WHERE brand=? ORDER BY created_at DESC'); $st->execute([$brand]); return $st->fetchAll(); }
    public static function find(int $id): ?array { $st=DB::pdo()->prepare('SELECT * FROM products WHERE id=?'); $st->execute([$id]); $r=$st->fetch(); return $r ?: null; }
    public static function findBySlug(string $slug): ?array { $st=DB::pdo()->prepare('SELECT * FROM products WHERE slug=?'); $st->execute([$slug]); $r=$st->fetch(); return $r ?: null; }
    public static function create(array $data): int { $st=DB::pdo()->prepare('INSERT INTO products(name,slug,brand,price,description,created_at) VALUES(?,?,?,?,?,NOW())'); $st->execute([$data['name'],$data['slug'],$data['brand'],$data['price'],$data['description']]); return (int)DB::pdo()->lastInsertId(); }
    public static function update(int $id, array $data): void { $st=DB::pdo()->prepare('UPDATE products SET name=?, slug=?, brand=?, price=?, description=? WHERE id=?'); $st->execute([$data['name'],$data['slug'],$data['brand'],$data['price'],$data['description'],$id]); }
    public static function delete(int $id): void { $st=DB::pdo()->prepare('DELETE FROM products WHERE id=?'); $st->execute([$id]); }
}
