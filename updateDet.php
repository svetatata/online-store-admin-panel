<?php
include 'conn.php';

$id = $_POST['id'];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}

$sql = "SELECT * FROM detorder WHERE id=$id";
$result = $conn->query($sql);
$order = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Изменение деталей</title>
</head>
<body>
    <?php include 'menu.php'?>
    <div class="container">
    <form id="orderform" action="handlerDet.php" method="post">
        <input type="hidden" name="action" value="update">
        <label for="iddet">ID детали</label>
        <input id="iddet" name="iddet" disabled value="<?php echo $order['id']; ?>">

        <label for="order_id">Заказ</label>
        <select id="order_id" name="order_id">
            <?php
            
            $sql = "SELECT id, total FROM orderr";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                $selected = ($row['id'] == $order['order_id']) ? 'selected' : '';
                echo "<option value=".$row['id']." {$selected}>".$row['id']." - ".$row['total']."р.</option>";
            }
            ?>
        </select>
        <label for="item">Товар</label>

        <select id="item" name="item">
            <?php
            
            $sql = "SELECT id, itname, price FROM items";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                $selected = ($row['id'] == $order['item']) ? 'selected' : '';
                echo "<option value='{$row['id']}' data-price='{$row['price']}'>{$row['itname']}</option>";
            }
            ?>
        </select>

        <label for="quantity">Количество</label>
        <input type="number" id="quantity" name="quantity" min="1" required value="<?php echo $order['quantity']; ?>">
        <label for="price">Цена</label>
        <input type="number" step="0.01" id="price" name="price" readonly value="<?php echo $order['price']; ?>">

        <button type="submit">Обновить</button>
    </form>

    <a class="return" href="detorder.php?id=<?php echo $id;?>">Вернуться к деталям этого заказа</a>
    </div>

    <script>
        function updatePrice() {
        const itemSelect = document.getElementById('item');
        const selectedOption = itemSelect.options[itemSelect.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        document.getElementById('price').value = price || '';
    }
    </script>
</body>
</html>

<?php
$conn->close();
?>