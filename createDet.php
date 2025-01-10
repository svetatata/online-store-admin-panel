<?php
include 'conn.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}

$sql = "SELECT id FROM orderr";
$result = $conn->query($sql);

$items = [];
$sqlItems = "SELECT id, itname, price FROM items";
$resultItems = $conn->query($sqlItems);
while ($row = $resultItems->fetch_assoc()) {
    $items[] = $row;
}

$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : null;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Создать деталь заказа</title>
    
</head>
<body>
<?php include 'menu.php'; ?>
<div class="container">
    <form id="detorderform" action="handlerDet.php" method="post">
        <input type="hidden" name="action" value="create">

        <label for="order">Заказ</label>
        <select name="orderId" id="orderId" required>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $selected = ($orderId == $row['id']) ? 'selected' : '';  
                    echo "<option value='{$row['id']}' $selected>{$row['id']}</option>";
                }
            }
            ?>
        </select>

        <label for="item">Товар</label>
        <select id="item" name="item" required onchange="updatePrice()">
            <option value="" disabled selected>Выберите товар</option>
            <?php
            foreach ($items as $item) {
                echo "<option value='{$item['id']}' data-price='{$item['price']}'>{$item['itname']}</option>";
            }
            ?>
        </select>

        <label for="quantity">Количество</label>
        <input type="number" id="quantity" name="quantity" min="1" required>

        <label for="price">Цена</label>
        <input type="number" step="0.01" id="price" name="price" readonly>

        <button type="submit">Отправить</button>
    </form>

    <br>
    <a href="orders.php">Назад к заказам</a>
    <?php 
    // echo('<p>'.$orderId.'</p>'); 
    ?>
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
