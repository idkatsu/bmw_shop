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


    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = SHA1(?)");
    $stmt->bind_param("ss", $input_username, $input_password);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['username'] = $input_username; 
       
        header("Location: shop.php");
        exit(); 
    } else {
        echo "Неверный логин или пароль.";
    }

    $stmt->close();
}

$conn->close();
?>
