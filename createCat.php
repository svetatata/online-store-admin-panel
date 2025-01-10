<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Создать категорию</title>

</head>
<body>
<?php include 'menu.php'?>
<div class="container">
    <form id="catform" action="handlerCat.php" method="post">
        <input type="hidden" name="action" id="action" value="create">

        <label for="name">Название</label>
        <input type="text" id="name" name="name">
        <button type="submit">Отправить</button>
    </form>
</div>
</body>
</html>