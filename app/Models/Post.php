<?php
namespace App\Models;
use App\Core\DB; use PDO;

class Post {
    public static function all(): array { return DB::pdo()->query('SELECT * FROM posts ORDER BY created_at DESC')->fetchAll(); }
    public static function listByBrand(string $brand): array { $st=DB::pdo()->prepare('SELECT * FROM posts WHERE brand=? ORDER BY created_at DESC'); $st->execute([$brand]); return $st->fetchAll(); }
    public static function find(int $id): ?array { $st=DB::pdo()->prepare('SELECT * FROM posts WHERE id=?'); $st->execute([$id]); $r=$st->fetch(); return $r ?: null; }
    public static function findBySlug(string $slug): ?array { $st=DB::pdo()->prepare('SELECT * FROM posts WHERE slug=?'); $st->execute([$slug]); $r=$st->fetch(); return $r ?: null; }
    public static function create(array $d): int { $st=DB::pdo()->prepare('INSERT INTO posts(title,slug,brand,content,created_at) VALUES(?,?,?,?,NOW())'); $st->execute([$d['title'],$d['slug'],$d['brand'],$d['content']]); return (int)DB::pdo()->lastInsertId(); }
    public static function update(int $id, array $d): void { $st=DB::pdo()->prepare('UPDATE posts SET title=?, slug=?, brand=?, content=? WHERE id=?'); $st->execute([$d['title'],$d['slug'],$d['brand'],$d['content'],$id]); }
    public static function delete(int $id): void { $st=DB::pdo()->prepare('DELETE FROM posts WHERE id=?'); $st->execute([$id]); }
}
