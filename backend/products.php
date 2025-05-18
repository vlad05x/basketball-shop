<?php
require_once 'db.php';

$categoryId = $_GET['category_id'] ?? null;
$search = $_GET['search'] ?? '';

$sql = "SELECT * FROM products WHERE 1=1";

$params = [];

if (!empty($categoryId)) {
    $sql .= " AND category_id = ?";
    $params[] = $categoryId;
}

if (!empty($search)) {
    $sql .= " AND (title LIKE ? OR description LIKE ?)";
    $searchParam = "%" . $search . "%";
    $params[] = $searchParam;
    $params[] = $searchParam;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($products);
?>
