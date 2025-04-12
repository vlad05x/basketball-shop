<?php
include('db.php');

$query = "SELECT * FROM categories";
$stmt = $pdo->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($categories);
?>
