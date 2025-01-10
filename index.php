<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Вход</title>
</head>
<body>
<?php include 'menu.php' ?>
<div class="container">
    <form id="login-form" action="handlerLogin.php" method="post">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        
        <button type="submit">Войти</button>
    </form>
</div>
</body>
</html>
