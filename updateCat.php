<?php
include 'conn.php';

$id = $_POST['ID'];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}

$sql = "SELECT * FROM cats WHERE id=$id";
$result = $conn->query($sql);
$cat = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>изменить категорию</title>

</head>
<body>
<?php include 'menu.php'?>
<div class="container">
    <form id="catform" action="handlerCat.php" method="post">
        <input type="hidden" name="action" id="action" value="update">


        <label for="id">ID</label>
        <input type="number" id="id" name="id" value="<?php echo $cat['id']; ?>">
        <label for="name">Название</label>
        <input type="text" id="name" name="name" value="<?php echo $cat['name']; ?>">
        <button type="submit">Отправить</button>
    </form>
</div>
</body>
</html>
<?php
$conn->close();

?>