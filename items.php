<?php
include 'conn.php';
session_start();

$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'client';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}

$sql = "SELECT items.id, items.itname, items.price, items.stock, items.cat, cats.name 
FROM items 
LEFT JOIN cats ON items.cat = cats.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Список товаров</title>
</head>
<body>
    <?php include 'menu.php'?>
    <div class="container">
    <form class="left" action="" method="post">
        <label for="role">Выберите роль:</label>
        <select name="role" id="role">
            <option value="client" <?php if ($role == 'client') echo 'selected'; ?>>Клиент</option>
            <option value="admin" <?php if ($role == 'admin') echo 'selected'; ?>>Администратор</option>
        </select>
        <button type="submit">Сменить роль</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['role'])) {
            $role = $_POST['role'];
            $_SESSION['role'] = $role;
            header("Location: items.php"); 
            exit;
        }
    }
    ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество <br>(осталось)</th>
                <th>Категория</th>
                <?php if ($role == 'admin'): ?>
                <th>Действия</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['itname']."</td>
                            <td>".$row['price']."</td>
                            <td>".$row['stock']."</td>
                            <td>".$row['name']."</td>";
                    if ($role == 'admin') {
                        echo "<td>
                                <form action='handlerIt.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='ID' value='{$row['id']}'>
                                    <input type='hidden' name='action' value='delete1'>
                                    <button class='min' type='submit'>-</button>
                                </form>
                                <form action='handlerIt.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='ID' value='{$row['id']}'>
                                    <input type='hidden' name='action' value='add1'>
                                    <button class='plus' type='submit'>+</button>
                                </form>
                                <form action='handlerIt.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='ID' value='{$row['id']}'>
                                    <input type='hidden' name='action' value='delete'>
                                    <button type='submit'>Удалить</button>
                                </form>
                                <form action='updateIt.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='ID' value='{$row['id']}'>
                                    <button type='submit'>Изменить</button>
                                </form>
                            </td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Нет данных</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php if ($role == 'admin'): ?>
    <button name="action" value="create" type="button"><a href="createIt.php">Добавить новый товар</a></button>
    <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>