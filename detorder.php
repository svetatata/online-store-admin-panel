<?php
include 'conn.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}
$successMessage = isset($_GET['success']) && $_GET['success'] == 'true';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Детали заказа</title>
</head>
<body>
    <?php include 'menu.php' ?>
    <div class="container">
<?php


    if (isset($_GET['id'])) {
        $orderid = $_GET['id'];
        $sql = "SELECT * FROM detorder WHERE `order` = $orderid";
    
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            ?>
            <table>
                <thead>
                    <tr>
                        <th>ID детали заказа</th>
                        <th>ID Заказа</th>
                        <th>ID Товара</th>
                        <th>Количество</th>
                        <th>Цена</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td><?=$row['order']?></td>
                            <td><?=$row['item']?></td>
                            <td><?=$row['quantity']?></td>
                            <td><?=$row['price']?></td>
                            <td>
                                <form action="handlerDet.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?=$row['id']?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit">Удалить</button>
                                </form>
                                <form action="updateDet.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?=$row['id']?>">
                                    <input type="hidden" name="action" value="update">
                                    <button type="submit">Изменить</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    echo "</tbody></table>";
                } else {
                    echo "Нет данных";
                }
            } else {
                echo "ID заказа не указан.";
            }
            if (isset($_GET['id'])) {
                echo "ID заказа: " . $_GET['id']; 
            }
?>
<button name="action" value="create" type="button"><a href="createDet.php?id=<?=$orderid?>">Добавить деталь заказа</a></button><br>
<a class="return" href="orders.php">Вернуться к списку закзаов</a>
</div>
<script>
     <?php if ($successMessage): ?>
        alert("Деталь заказа успешно добавлена!");
        <?php endif; ?>
</script>
</body>
</html>
<?php
$conn->close();
?>
