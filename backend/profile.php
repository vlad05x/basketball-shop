<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Получаем данные пользователя из сессии
$first_name = htmlspecialchars($_SESSION['first_name']);
$last_name = htmlspecialchars($_SESSION['last_name']);
$email = htmlspecialchars($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профіль користувача</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <a href="../frontend/index.html">Повернення на головну</a>
            <h1>Привіт, <?php echo $first_name . ' ' . $last_name; ?>!</h1>
            <p>Ласкаво просимо до вашого особистого кабінету.</p>
        </div>

        <div class="profile-details">
            <h2>Інформація про користувача:</h2>
            <div class="detail">
                <strong>Ім'я:</strong> <?php echo $first_name; ?>
            </div>
            <div class="detail">
                <strong>Прізвище:</strong> <?php echo $last_name; ?>
            </div>
            <div class="detail">
                <strong>Email:</strong> <?php echo $email; ?>
            </div>
        </div>

        <div class="logout">
            <a href="logout.php">Вийти з профілю</a>
        </div>
    </div>
</body>
</html>
