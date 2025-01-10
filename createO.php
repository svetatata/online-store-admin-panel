<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Создать заказ</title>

</head>
<body>
<?php include 'menu.php'?>
<div class="container">
    <form id="orderform" action="handlerO.php" method="post">
        <input type="hidden" name="action" id="action" value="create">

        <label for="client">Клиент</label>
        <select id="client" name="client">
            <?php
            include 'conn.php';
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            $sql = "SELECT id, first_name FROM client";
            $result = $conn->query($sql);

            // Выводим каждого клиента в виде опции в списке выбора
            while ($row = $result->fetch_assoc()) {
                echo "<option value=".$row['id'].">".$row['id']." - ".$row['first_name']."</option>";
            }

            $conn->close();
            ?>
        </select>

        <label for="date">Дата</label>
        <input type="date" id="date" name="date">

        <label for="total">Стоимость</label>
        <input type="total" id="total" name="total" disabled>
        <button type="submit">Отправить</button>
    </form>
</div>
</body>
</html>