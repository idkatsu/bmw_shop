<?php
session_start();
include 'db.php';
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_SESSION['shopping_cart'])) {
    $_SESSION['shopping_cart'] = [];
}
$query = "SELECT * FROM bmw_terms";
$result = mysqli_query($conn, $query);
if (isset($_POST['add_to_cart'])) {
    $car_id = $_POST['car_id'];
    if (!in_array($car_id, $_SESSION['shopping_cart'])) {
        $_SESSION['shopping_cart'][] = $car_id;
    }
}
if (isset($_POST['remove_from_cart'])) {
    $car_id = $_POST['car_id'];
    if (($key = array_search($car_id, $_SESSION['shopping_cart'])) !== false) {
        unset($_SESSION['shopping_cart'][$key]);
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Магазин - BMW</title>
    <style>
       html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
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
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }
        nav a:hover {
            background-color: #555;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 10px 0;
            margin-top: auto;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
            background-color: white;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
<header>
    <h1>Магазин BMW</h1>
    <nav>
        <a href="index.php">Главная</a>
        <a href="shop.php">Магазин</a>
        <a href="feedback.html">Обратная связь</a>
        <a href="logout.php">Выход</a>
    </nav>
</header>
<div style="flex-grow: 1;">
    <h2>Доступные автомобили</h2>
    <table>
        <tr>
            <th>Модель</th>
            <th>Описание</th>
            <th>Изображение</th>
            <th>Действие</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['term']); ?></td>
                <td><?php echo htmlspecialchars($row['definition']); ?></td>
                <td><img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['term']); ?>" title="<?php echo htmlspecialchars($row['term']); ?>"></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="car_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="add_to_cart">Добавить в список покупок</button>
                    </form>
                    <a class="detail-btn" href="product_detail.php?id=<?php echo $row['id']; ?>">Подробнее</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Ваш список покупок</h2>
    <table>
        <tr>
            <th>Модель</th>
            <th>Действие</th>
        </tr>
        <?php if (empty($_SESSION['shopping_cart'])): ?>
            <tr><td colspan="2">Ваш список покупок пуст.</td></tr>
        <?php else: ?>
            <?php foreach ($_SESSION['shopping_cart'] as $car_id): ?>
                <?php
                // Получаем информацию о машине по ID
                $query = "SELECT * FROM bmw_terms WHERE id = $car_id";
                $car_result = mysqli_query($conn, $query);
                $car = mysqli_fetch_assoc($car_result);
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($car['term']); ?></td>
                    <td>
                    <form method="POST" style="display:inline;">
                            <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                            <button type="submit" name="remove_from_cart">Удалить из списка покупок</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>
<footer>
    <p>&copy; 2024 Влад Кузнецов</p>
</footer>
</body>
</html>

<?php mysqli_close($conn); ?>
