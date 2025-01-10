<?php
include 'conn.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}

$sql = "SELECT orderr.id, orderr.client, client.first_name, orderr.date, orderr.total  
FROM orderr
JOIN client ON client.id = orderr.client";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Список заказов</title>
</head>
<body>
    <?php include 'menu.php'?>
    <div class="container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Клиент</th>
                <th>Имя клиента</th>
                <th>Дата</th>
                <th>Стоимость</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                    ?>
                    <tr>
                            <td><?=$row['id']?></td>
                            <td><?=$row['client']?></td>
                            <td><?=$row['first_name']?></td>
                            <td><?=$row['date']?></td>
                            <td><?=$row['total']?> р.</td>
                            <td>
                                <form action="detorder.php" method="get" style="display:inline;">
                                    <input type="hidden" name="id" value="<?=$row['id']?>">
                                    <button id="det" type="submit">Детали</button>
                                </form>
                                <form action='handlerO.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='id' value='<?=$row['id']?>'>
                                    <input type='hidden' name='action' value='delete'>
                                    <button type='submit'>Удалить</button>
                                </form>
                                <form action='updateO.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='id' value='<?=$row['id']?>'>
                                    <input type='hidden' name='action' value='update'>
                                    <button type='submit'>Изменить</button>
                                </form>
                                
                            </td>
                        </tr>

                        <?php
                }
            } else {

                ?>
                <tr><td colspan='9'>Нет данных</td></tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <button name="action" value="create" type="button"><a href="createO.php">Добавить новый заказ</a></button>
    </div>
</body>
</html>

<?php
$conn->close();
?>