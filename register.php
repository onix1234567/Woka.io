<?php
// Файл register.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключение к базе данных
    $db = new mysqli("hostname", "username", "password", "database_name");

    // Проверьте подключение
    if ($db->connect_error) {
        die("Ошибка подключения: " . $db->connect_error);
    }

    // Получите данные из формы
    $username = $db->real_escape_string($_POST['username']);
    $email = $db->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хеширование пароля

    // Проверьте, существует ли имя пользователя или email
    $checkUser = $db->query("SELECT * FROM users WHERE username='$username' OR email='$email'");

    if ($checkUser->num_rows > 0) {
        echo "Имя пользователя или email уже существует.";
    } else {
        // Добавьте пользователя в базу данных
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($db->query($query) === TRUE) {
            $_SESSION['username'] = $username; // Начало сессии пользователя
            header("Location: profile.php"); // Переход в профиль
        } else {
            echo "Ошибка: " . $query . "<br>" . $db->error;
        }
    }

    // Закройте соединение
    $db->close();
}
?>
