<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Создать товар</title>

</head>
<body>
<?php include 'menu.php'?>
<div class="container">
    <form id="itemform" action="handlerIt.php" method="post">
        <input type="hidden" name="action" id="action" value="create">

        <label for="itname">Название</label>
        <input type="text" id="itname" name="itname">

        <label for="price">Цена</label>
        <input type="decimal" id="price" name="price">

        <label for="stock">Количество</label>
        <input type="number" id="stock" name="stock">

        <label for="cat">Категория</label>
        <select id="cat" name="cat">
            <?php
            include 'conn.php';
            $conn = new mysqli($servername, $username, $password, $dbname);

            $sql = "SELECT id, name FROM cats";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<option value=".$row['id'].">".$row['id']." - ".$row['name']."</option>";
            }

            $conn->close();
            ?>
        </select>
        <button type="submit">Отправить</button>
    </form>
</div>
</body>
</html>