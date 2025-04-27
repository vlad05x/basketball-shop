<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php-shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT c.id, c.product_id, c.quantity, p.title, p.price, p.image_url 
          FROM cart c
          JOIN products p ON c.product_id = p.id";
$result = $conn->query($query);

$cart_items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
    }
    echo json_encode($cart_items);
} else {
    echo json_encode(['error' => 'Кошик порожшній.']);
}

$conn->close();

