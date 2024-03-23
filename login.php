<?php
// Подключение к базе данных
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "dbname";
$conn = new mysqli($servername, $username, $password, $dbname);

// Получение данных из формы
$email = $_POST['email'];
$password = $_POST['password'];

// Поиск пользователя в базе данных
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

// Проверка успешного входа
if ($result->num_rows > 0) {
  echo "Вход выполнен успешно";
} else {
  echo "Ошибка входа";
}

$conn->close();
?>