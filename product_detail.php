<?php

$conn = mysqli_connect("localhost", "a93730qb_kr", "D050105d", "a93730qb_kr");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM bmw_terms WHERE id = $product_id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    die("Продукт не найден.");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['term']); ?></title>
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
    padding: 10px 0; 
}

nav {
    display: flex;
    justify-content: center;
    background-color: #444;
}

nav a {
    color: white;
    padding: 10px 15px;
    text-decoration: none;
}

footer {
    background-color: #333;
    color: white;
    padding: 10px 0; 
    margin-top: auto; 
}

main {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center; 
    align-items: center; 
}

img {
    max-width: 100%; 
    height: auto; 
    width: 300px; 
    margin: 0 auto 20px; 
    display: block; 
}


    </style>
</head>
<body>

<header>
    <h1><?php echo htmlspecialchars($product['term']); ?></h1>
    <nav>
        <a href="index.php">Главная</a>
        <a href="shop.php">Магазин</a>
        <a href="logout.php">Выход</a>
    </nav>
</header>

<h2>Описание продукта</h2>
<img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['term']); ?>">
<p><?php echo htmlspecialchars($product['definition']); ?></p>


<a href="shop.php">Вернуться в магазин</a>

<footer>
    <p>&copy; 2024 Влад Кузнецов</p>
</footer>

</body>
</html>

<?php mysqli_close($conn); ?>
