<?php
include('db.php');

$query = "SELECT * FROM products";
$stmt = $pdo->query($query);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($products) {
    echo json_encode($products);
} else {
    echo json_encode(['error' => 'No products found']);
}