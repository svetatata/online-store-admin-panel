<?php
include 'conn.php';

$id = $_POST['id'];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}

$sql = "SELECT * FROM orderr WHERE id=$id";
$result = $conn->query($sql);
$order = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Изменение заказа</title>
</head>
<body>
    <?php include 'menu.php'?>
    <div class="container">
    <form id="orderform" action="handlerO.php" method="post">
        <input type="hidden" name="action" value="update">
        <label for="id">ID</label>
        <input id="id" name="id" value="<?php echo $order['id']; ?>">

        <label for="client">Клиент</label>
        <select id="client" name="client">
            <?php
            
            $sql = "SELECT id, first_name FROM client";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                // Проверка, соответствует ли текущий клиент выбранному клиенту в заказе
                $selected = ($row['id'] == $order['client']) ? 'selected' : '';

                echo "<option value=".$row['id']." {$selected}>".$row['id']." - ".$row['first_name']."</option>";
            }
            ?>
        </select>
        

        <label for="date">Дата</label>
        <input name="date" id="date" type="date" value="<?php echo $order['date']; ?>" required>

        <label for="total">Стоимость</label>
        <input name="total" id="total" type="text" value="<?php echo $order['total']; ?>" required>

        <button type="submit">Обновить</button>
    </form>

    <a class="return" href="orders.php">Вернуться к списку заказов</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>