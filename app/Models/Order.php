<?php
namespace App\Models;
use App\Core\DB;

class Order {
    public static function createFromCart(string $name, string $email, string $address, string $payment, array $cart): array {
        $pdo = DB::pdo();
        $pdo->beginTransaction();
        try {
            $orderNo = 'ORD'.time().rand(100,999);
            $total = 0; $items = [];
            foreach ($cart as $pid => $qty) {
                $p = Product::find((int)$pid); if(!$p) continue; $line = $p['price']*$qty; $total += $line; $items[] = [$p,$qty,$line];
            }
            $st=$pdo->prepare('INSERT INTO orders(order_no,name,email,address,payment_mode,status,total,created_at) VALUES(?,?,?,?,?,?,?,NOW())');
            $st->execute([$orderNo,$name,$email,$address,$payment,'pending',$total]);
            $orderId = (int)$pdo->lastInsertId();
            $st2=$pdo->prepare('INSERT INTO order_items(order_id,product_id,qty,price) VALUES(?,?,?,?)');
            foreach ($items as [$p,$qty,$line]) { $st2->execute([$orderId,$p['id'],$qty,$p['price']]); }
            $pdo->commit();
            return ['id'=>$orderId,'order_no'=>$orderNo,'total'=>$total,'status'=>'pending'];
        } catch (\Throwable $e) { $pdo->rollBack(); throw $e; }
    }
    public static function markPaidByOrderNo(string $orderNo): void { $st=DB::pdo()->prepare('UPDATE orders SET status="paid" WHERE order_no=?'); $st->execute([$orderNo]); }
    public static function findByOrderNo(string $orderNo): ?array { $st=DB::pdo()->prepare('SELECT * FROM orders WHERE order_no=?'); $st->execute([$orderNo]); $o=$st->fetch(); if(!$o)return null; $st2=DB::pdo()->prepare('SELECT oi.*, p.name FROM order_items oi JOIN products p ON p.id=oi.product_id WHERE order_id=?'); $st2->execute([$o['id']]); $o['items']=$st2->fetchAll(); return $o; }
    public static function all(): array { return DB::pdo()->query('SELECT * FROM orders ORDER BY created_at DESC')->fetchAll(); }
    public static function find(int $id): ?array { $st=DB::pdo()->prepare('SELECT * FROM orders WHERE id=?'); $st->execute([$id]); $o=$st->fetch(); if(!$o)return null; $st2=DB::pdo()->prepare('SELECT oi.*, p.name FROM order_items oi JOIN products p ON p.id=oi.product_id WHERE order_id=?'); $st2->execute([$o['id']]); $o['items']=$st2->fetchAll(); return $o; }
    public static function updateStatus(int $id, string $status): void { $st=DB::pdo()->prepare('UPDATE orders SET status=? WHERE id=?'); $st->execute([$status,$id]); }
}
