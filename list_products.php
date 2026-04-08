<?php

$host = '127.0.0.1';
$db   = 'sepatukuid';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// Get current state
$stmt = $pdo->query("SELECT id, name FROM products ORDER BY id");
echo "=== CURRENT PRODUCTS ===\n";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: {$row['id']} | {$row['name']}\n";
}
