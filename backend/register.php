<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$mysql = new mysqli("localhost", "root", "", "php-shop");

if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $mysql->real_escape_string($_POST['firstName']);
    $lastName = $mysql->real_escape_string($_POST['lastName']);
    $email = $mysql->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkEmail = $mysql->query("SELECT * FROM users WHERE email='$email'");

    if ($checkEmail->num_rows > 0) {
        echo "Пользователь с таким email уже существует.<br>";
    } else {
        $sql = "INSERT INTO users (first_name, last_name, email, password) 
                VALUES ('$firstName', '$lastName', '$email', '$password')";

        if ($mysql->query($sql) === TRUE) {
            $userId = $mysql->insert_id;

            session_start();
            $_SESSION['user'] = $userId;
            $_SESSION['first_name'] = $firstName;
            $_SESSION['last_name'] = $lastName;
            $_SESSION['email'] = $email;

            header("Location: ./profile.php");
            exit();
        } else {
            echo "Ошибка: " . $mysql->error . "<br>";
        }
    }
}

$mysql->close();
?>
