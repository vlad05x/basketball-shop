<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$mysql = new mysqli("localhost", "root", "", "php-shop");

if ($mysql->connect_error) {
    die("Помилка підключення: " . $mysql->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $mysql->real_escape_string($_POST['loginEmail']);
    $password = $_POST['loginPassword'];

    $result = $mysql->query("SELECT * FROM users WHERE email='$email'");
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email']; 
            
            header("Location: ./profile.php");
            exit();
        } else {
            echo "Невірний пароль!<br>";
        }
    } else {
        echo "Користувач не знайдений!<br>";
    }
}

$mysql->close();
?>
