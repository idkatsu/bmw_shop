<?php
include 'db.php';

$query = "SELECT * FROM bmw_terms";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Магазин BMW</title>
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
    </nav>
</header>

<div style="flex-grow: 1;">
    <table>
        <tr>
            <th>Термин</th>
            <th>Определение</th>
            <th>Изображение</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['term']; ?></td>
                <td><?php echo $row['definition']; ?></td>
                <td><img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['term']; ?>" title="<?php echo $row['term']; ?>"></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

<footer>
    <p>&copy; 2024 Влад Кузнецов</p>
</footer>

</body>
</html>

<?php mysqli_close($conn); ?>
