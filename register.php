<?php
// Подключение к базе данных
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "dbname";
$conn = new mysqli($servername, $username, $password, $dbname);

// Получение данных из формы
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Добавление пользователя в базу данных
$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
if ($conn->query($sql) === TRUE) {
  echo "Регистрация успешна";
} else {
  echo "Ошибка регистрации";
}

$conn->close();
?>