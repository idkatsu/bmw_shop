<?php

$servername = "localhost"; 
$username = "a93730qb_kr";
$password = "D050105d"; 
$dbname = "a93730qb_kr"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

   
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div>Пользователь с таким именем уже существует.</div>";
    } else {
      
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, SHA1(?))");
        $stmt->bind_param("ss", $input_username, $input_password);

        if ($stmt->execute()) {
            
            header("Location: index.php");
            exit();
        } else {
            echo "<div>Ошибка при регистрации: " . $stmt->error . "</div>";
        }
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация в магазине BMW</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        header {
            background-color: #333;
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #444;
        }
        nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s;
        }
        nav a:hover {
            background-color: #555;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 10px 0;
            margin-top: auto;
            position: relative; 
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
        }
        main {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center; 
            align-items: center; 
            padding: 20px; 
        }
        h2 {
            margin-top: 0; 
        }
        ul {
            list-style-type: none;
            padding: 0; 
        }
        li {
            background-color: #eaeaea; 
            margin: 10px 0;
            padding: 10px; 
            border-radius: 5px; 
            width: 80%; 
            max-width: 600px; 
        }
        .auth-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .auth-form input {
            margin-bottom: 10px;
            padding: 10px;
            width: 200px; 
        }
        .register-button, .login-button {
            margin-top: 10px; 
            padding: 10px 20px; 
            background-color: #4CAF50; 
            color: white; 
            border: none;
            border-radius: 5px; 
            cursor: pointer; 
        }
        .register-button:hover, .login-button:hover {
            background-color: #45a049; 
        }
    </style>
</head>
<body>
    <header>
        <h1>Регистрация в магазине BMW</h1>
    </header>
    <main>
        <div class="auth-form">
            <form action="" method="post">
                <label for="username">Имя пользователя:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" class="register-button" value="Зарегистрироваться">
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Влад Кузнецов</p>
    </footer>
</body>
</html>
