<?php
include 'conn.php';

$id = $_POST['ID'];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}

$sql = "SELECT * FROM items WHERE id=$id";
$result = $conn->query($sql);
$item = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Изменение товара</title>
</head>
<body>
<?php include 'menu.php'?>
    <div class="container">
    <form id="itemform" action="handlerIt.php" method="post">
        <input type="hidden" name="action" value="update">
        <label for="ID">ID</label>
        <input id="ID" name="ID" value="<?php echo $item['id']; ?>">

        <label for="itname">Название</label>
        <input name="itname" id="itname" type="text" value="<?php echo $item['itname']; ?>" required>

        <label for="price">Цена</label>
        <input name="price" id="price" type="text" value="<?php echo $item['price']; ?>" required>

        <label for="stock">Количество</label>
        <input name="stock" id="stock" type="text" value="<?php echo $item['stock']; ?>" required>

        <label for="cat">Клиент</label>
        <select id="cat" name="cat">
            <?php
            
            $sql = "SELECT id, name FROM cats";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                // Проверка, соответствует ли текущая категория выбранному тавару в заказе
                if ($row['id'] == $item['cat']) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }

                echo "<option value=".$row['id']." {$selected}>".$row['id']." - ".$row['name']."</option>";
            }
            ?>
        </select>
        <button type="submit">Обновить</button>
    </form>

    <a class="return" href="items.php">Вернуться к списку товаров</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>