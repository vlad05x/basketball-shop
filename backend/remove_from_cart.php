<?php
// Подключаемся к базе данных
require_once 'db.php'; // Проверьте, чтобы этот файл содержал данные для подключения к базе данных

// Получаем данные из POST-запроса
$data = json_decode(file_get_contents("php://input"));
$cart_id = $data->cart_id;

// Проверка на корректность данных
if (!isset($cart_id) || !is_numeric($cart_id)) {
    echo json_encode(['success' => false, 'error' => 'Некорректный идентификатор товара']);
    exit;
}

// SQL-запрос на удаление товара из корзины
$query = "DELETE FROM cart WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->bindParam(1, $cart_id, PDO::PARAM_INT);

if ($stmt->execute()) {
    // Успешное удаление
    echo json_encode(['success' => true]);
} else {
    // Ошибка удаления
    echo json_encode(['success' => false, 'error' => 'Ошибка при удалении товара']);
}
?>
