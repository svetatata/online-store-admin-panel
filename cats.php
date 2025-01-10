<?php
include 'conn.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}

$sql = "SELECT * FROM cats";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Список категорий</title>
</head>
<body>
    <?php include 'menu.php'?>
    <div class="container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['name']."</td>
                            <td>
                                <form action='handlerCat.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='ID' value='{$row['id']}'>
                                    <input type='hidden' name='action' value='delete'>
                                    <button type='submit'>Удалить</button>
                                </form>
                                <form action='updateCat.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='ID' value='{$row['id']}'>
                                    <button type='submit'>Изменить</button>
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
    <button name="action" value="create" type="button"><a href="createCat.php">Добавить новую категорию</a></button>
    </div>
</body>
</html>

<?php
$conn->close();
?>