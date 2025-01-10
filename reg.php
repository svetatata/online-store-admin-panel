<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Работа с клиентами</title>
</head>
<body>
<?php include 'menu.php'?>
<div class="container">
    <form id="clientform" action="handlerCl.php" method="post">
        <input type="hidden" name="action" value="create">
        <input name="ID" id="ID" type="hidden">

        <label for="firstname">Имя</label>
        <input name="firstname" id="firstname" type="text" required>

        <label for="lastname">Фамилия</label>
        <input name="lastname" id="lastname" type="text" required>

        <label for="patronymic">Отчество *</label>
        <input name="patronymic" id="patronymic" type="text">

        <label for="birthdate">Дата рождения</label>
        <input name="birthdate" id="birthdate" type="date" required>

        <label for="email">Почта</label>
        <input name="email" id="email" type="text" required>

        <label for="address">Адрес *</label>
        <input name="address" id="address" type="text" required>

        <label for="passport">Паспорт *</label>
        <input name="passport" id="passport" type="number" required>
        <button type="submit">Отправить</button>
    </form>
    </div>
</body>
</html>