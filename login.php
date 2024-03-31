<?php
// Файл login.php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключение к БД аналогично register.php

    // Получите данные из формы
    $username = $db->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Найдите пользователя в базе данных
    $result = $db->query("SELECT * FROM users WHERE username='$username' OR email='$username'");

    if ($result->num_rows == 1) {
        // Пользователь найден
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Пароль верный
            $_SESSION['username'] = $user['username']; // Начало сессии пользователя
            header("Location: profile.php"); // Переход в профиль
        } else {
            echo "Неправильный пароль.";
        }
    } else {
        echo "Пользователь не найден.";
    }

    // Закройте подключение
    $db->close();
}
?>
