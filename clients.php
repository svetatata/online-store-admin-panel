<?php
include 'conn.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}

$sql = "SELECT * FROM client";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Список клиентов</title>
</head>
<body>
    <?php include 'menu.php'?>
    <div class="container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Дата рождения</th>
                <th>Почта</th>
                <th>Адрес</th>
                <th>Паспорт</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['last_name']."</td>
                            <td>".$row['first_name']."</td>
                            <td>".$row['patronymic']."</td>
                            <td>".$row['birth_date']."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['address']."</td>
                            <td>".$row['passport']."</td>
                            <td>
                                <form action='handlerCl.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='ID' value='{$row['id']}'>
                                    <input type='hidden' name='action' value='delete'>
                                    <button type='submit'>Удалить</button>
                                </form>
                                <form action='updateCl.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='ID' value='{$row['id']}'>
                                    <button type='submit'>Изменить</button>
                                </form>
                                <form action='historyClient.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='ID' value='{$row['id']}'>
                                    <button type='submit'>История</button>
                                </form>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Нет данных</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <button name="action" value="create" type="button"><a href="reg.php">Добавить нового клиента</a></button>
    </div>
</body>
</html>

<?php
$conn->close();
?>