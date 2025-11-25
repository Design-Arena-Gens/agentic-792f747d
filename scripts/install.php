<?php
$root = dirname(__DIR__);
$env = parse_ini_file($root.'/.env');
$dsn = sprintf('mysql:host=%s;port=%s;charset=utf8mb4', $env['DB_HOST'] ?? '127.0.0.1', $env['DB_PORT'] ?? '3306');
try {
    $pdo = new PDO($dsn, $env['DB_USER'] ?? 'root', $env['DB_PASS'] ?? '', [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    $pdo->exec('CREATE DATABASE IF NOT EXISTS `'.($env['DB_NAME'] ?? 'dualbrand').'` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    $pdo->exec('USE `'.($env['DB_NAME'] ?? 'dualbrand').'`');
    $sql = file_get_contents($root.'/database/schema.sql');
    $pdo->exec($sql);
    echo "Database installed.\n";
} catch (Throwable $e) { echo "Error: ".$e->getMessage()."\n"; exit(1);} 
