<?php

/**
 * Script to clean up products:
 * - Check each product's image URL
 * - Delete products with no image or broken/inaccessible images
 * - Keep only the 10 products with valid images
 */

$host = '127.0.0.1';
$db   = 'sepatukuid';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

function checkImageUrl($url) {
    if (empty($url)) return false;
    if (!filter_var($url, FILTER_VALIDATE_URL)) return false;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 8);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $httpCode === 200;
}

// Get all products
$stmt = $pdo->query("SELECT id, name, image, slug FROM products ORDER BY id");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "=== CHECKING " . count($products) . " PRODUCTS ===\n\n";

$valid = [];
$invalid = [];

foreach ($products as $product) {
    $imageField = $product['image'];

    // Determine full URL
    if (empty($imageField)) {
        $isValid = false;
        echo "[NO IMAGE ] ID:{$product['id']} | {$product['name']}\n";
    } elseif (str_starts_with($imageField, 'http')) {
        // External URL - check if accessible
        $isValid = checkImageUrl($imageField);
        $status = $isValid ? '[  VALID  ]' : '[ BROKEN  ]';
        echo "$status ID:{$product['id']} | {$product['name']} | $imageField\n";
    } else {
        // Local storage path - check if file exists
        $localPath = __DIR__ . '/storage/app/public/' . $imageField;
        $isValid = file_exists($localPath);
        $status = $isValid ? '[  VALID  ]' : '[ BROKEN  ]';
        echo "$status ID:{$product['id']} | {$product['name']} | LOCAL: $imageField\n";
    }

    if ($isValid) {
        $valid[] = $product;
    } else {
        $invalid[] = $product;
    }
}

echo "\n=== SUMMARY ===\n";
echo "Valid images:   " . count($valid) . "\n";
echo "Broken/No image: " . count($invalid) . "\n";

// Keep max 10 valid products, delete the rest
$toKeep = array_slice($valid, 0, 10);
$keepIds = array_column($toKeep, 'id');
$invalidIds = array_column($invalid, 'id');

// Also mark extra valid products beyond 10 for deletion
$extraValid = array_slice($valid, 10);
$extraIds = array_column($extraValid, 'id');

$allToDelete = array_merge($invalidIds, $extraIds);

echo "\n=== PRODUCTS TO KEEP (" . count($toKeep) . ") ===\n";
foreach ($toKeep as $p) {
    echo "  ID:{$p['id']} | {$p['name']}\n";
}

echo "\n=== PRODUCTS TO DELETE (" . count($allToDelete) . ") ===\n";
foreach ($invalid as $p) {
    echo "  ID:{$p['id']} | {$p['name']} (BROKEN/NO IMAGE)\n";
}
foreach ($extraValid as $p) {
    echo "  ID:{$p['id']} | {$p['name']} (EXTRA - BEYOND 10)\n";
}

if (empty($allToDelete)) {
    echo "\nNothing to delete.\n";
    exit;
}

// Perform deletion - handle related tables first
echo "\n=== DELETING... ===\n";

// Disable FK checks temporarily
$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

$placeholders = implode(',', array_fill(0, count($allToDelete), '?'));

// Delete related data first
$tables = ['order_items', 'cart_items', 'wishlist_items', 'product_sizes', 'product_images', 'reviews', 'wishlist'];
foreach ($tables as $table) {
    try {
        // Check if table exists
        $check = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($check->rowCount() > 0) {
            $del = $pdo->prepare("DELETE FROM $table WHERE product_id IN ($placeholders)");
            $del->execute($allToDelete);
            echo "Cleaned $table: " . $del->rowCount() . " rows\n";
        }
    } catch (Exception $e) {
        echo "Skipped $table: " . $e->getMessage() . "\n";
    }
}

// Delete the products
$del = $pdo->prepare("DELETE FROM products WHERE id IN ($placeholders)");
$del->execute($allToDelete);
echo "\nDeleted " . $del->rowCount() . " products from products table.\n";

// Re-enable FK checks
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

echo "\n=== DONE! Remaining products: ===\n";
$remaining = $pdo->query("SELECT id, name FROM products ORDER BY id");
while ($row = $remaining->fetch(PDO::FETCH_ASSOC)) {
    echo "  ID:{$row['id']} | {$row['name']}\n";
}
echo "\nTotal remaining: " . $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn() . "\n";
