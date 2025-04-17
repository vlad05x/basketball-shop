<?php
include('db.php');

$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

$query = "SELECT * FROM products";

if ($categoryId) {
    $query .= " WHERE category_id = :category_id";
}

$stmt = $pdo->prepare($query);

if ($categoryId) {
    $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
}

$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($products) {
    echo json_encode($products);
} else {
    echo json_encode(['error' => 'No products found']);
}
?>

