<?php
include 'conn.php';

$id = $_POST['ID'];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}

$sql = "SELECT * FROM client WHERE id=$id";
$result = $conn->query($sql);
$client = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Изменение клиента</title>
</head>
<body>
    <?php include 'menu.php'?>
<div class="container">
    <form id="clientForm" action="handlerCl.php" method="post">
        <input type="hidden" name="action" value="update">
        <label for="ID">ID</label>
        <input id="ID" name="ID" value="<?php echo $client['id']; ?>">

        <label for="firstname">Имя</label>
        <input name="firstname" id="firstname" type="text" value="<?php echo $client['first_name']; ?>" required>

        <label for="lastname">Фамилия</label>
        <input name="lastname" id="lastname" type="text" value="<?php echo $client['last_name']; ?>" required>

        <label for="patronymic">Отчество</label>
        <input name="patronymic" id="patronymic" type="text" value="<?php echo $client['patronymic']; ?>">

        <label for="birthdate">Дата рождения</label>
        <input name="birthdate" id="birthdate" type="date" value="<?php echo $client['birth_date']; ?>" required>

        <label for="email">Почта</label>
        <input name="email" id="email" type="text" value="<?php echo $client['email']; ?>" required>

        <label for="address">Адрес</label>
        <input name="address" id="address" type="text" value="<?php echo $client['address']; ?>" required>

        <label for="passport">Паспорт</label>
        <input name="passport" id="passport" type="number" value="<?php echo $client['passport']; ?>" required>

        <button type="submit">Обновить</button>
    </form>

    <a class="return" href="clients.php">Вернуться к списку клиентов</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>