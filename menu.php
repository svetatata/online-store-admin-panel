<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="nav">
    <div class="menu-left">
        <a href="items.php">Товары</a>
        <?php if (!isset($_SESSION['client_logged_in'])): ?>
            <a href="orders.php">Заказы</a>
            <a href="clients.php">Клиенты</a>
        <?php else: ?>
            <a href="client_history.php">История заказов</a>
        <?php endif; ?>
        <a href="cats.php">Категории</a>
    </div>
    <div class="menu-right">
        <?php if (!isset($_SESSION['client_logged_in'])): ?>
            <a href="reg.php">Регистрация</a>
            <a href="index.php">Вход</a>
        <?php else: ?>
            <a href="exit.php">Выход</a>
        <?php endif; ?>
    </div>
</nav>
