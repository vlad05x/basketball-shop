<?php
include('db.php');

// Получаем ID категории из запроса (если передан)
$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

// Формируем запрос
$query = "SELECT * FROM products";

// Если category_id задан, добавляем условие WHERE для фильтрации по категории
if ($categoryId) {
    $query .= " WHERE category_id = :category_id";
}

// Подготавливаем запрос
$stmt = $pdo->prepare($query);

// Если category_id задан, привязываем его к параметру запроса
if ($categoryId) {
    $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
}

// Выполняем запрос
$stmt->execute();

// Получаем результаты
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Проверяем, есть ли товары
if ($products) {
    echo json_encode($products);
} else {
    echo json_encode(['error' => 'No products found']);
}
?>
