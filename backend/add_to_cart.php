<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php-shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);
$product_id = $data['product_id'];

$product_check_query = "SELECT id FROM products WHERE id = ?";
$stmt = $conn->prepare($product_check_query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $insert_query = "INSERT INTO cart (product_id, quantity) VALUES (?, 1)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("i", $product_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => 'Товар успішно додано до кошика.']);
    } else {
        echo json_encode(['error' => 'Помилка при додаванні товару до кошика.']);
    }
} else {
    echo json_encode(['error' => 'Товар не знайдено.']);
}

$stmt->close();
$conn->close();

