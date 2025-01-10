<?php
include 'conn.php';
$cl_id = $_POST['ID'];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}


$sql = "SELECT orderr.id AS id_zakaza, orderr.date AS data_zakaza, orderr.total AS stoimost_zakaza, 
items.itname AS name_tovara, detorder.quantity AS kolvo_tovara, items.price AS tsena_tovara
FROM orderr 
JOIN detorder ON orderr.id = detorder.order
JOIN items ON detorder.item = items.id
WHERE orderr.client = '$cl_id'
ORDER BY orderr.date DESC";
$result = $conn->query($sql);

$order_data = [];
while ($row = $result->fetch_assoc()) {
    $id_zakaza = $row['id_zakaza'];
    if (!isset($order_data[$id_zakaza])) {
        $order_data[$id_zakaza] = [
            'data_zakaza' => $row['data_zakaza'],
            'stoimost_zakaza' => $row['stoimost_zakaza'],
            'items' => []
        ];
    }
    $order_data[$id_zakaza]['items'][] = [
        'name_tovara' => $row['name_tovara'],
        'kolvo_tovara' => $row['kolvo_tovara'],
        'tsena_tovara' => $row['tsena_tovara']
    ];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>История заказов</title>

</head>
<body>
    <?php include 'menu.php'?>
    <div class="container">
    <table>
    <thead>
        <caption><h2>История заказов клиента <?php echo $cl_id;?></h2></caption>
            <tr>
            <th>ID заказа</th>
            <th>Дата</th>
            <th>Стоимость</th>
        </tr>
        <!-- <tr>
            <th>товар</th>
            <th>Количество</th>
            <th>Цена товара</th>
        </tr> -->
        </thead>
        <tbody>
            <?php foreach ($order_data as $id_zakaza => $order): ?>
                <tr>
                    <td><?php echo $id_zakaza; ?></td>
                    <td><?php echo $order['data_zakaza']; ?></td>
                    <td><?php echo $order['stoimost_zakaza']; ?></td>
                </tr>
                <tr>
                    <th>Товар</th>
                    <th>Количество</th>
                    <th>Цена товара</th>
                </tr>
                <?php foreach ($order['items'] as $item): ?>
                    <tr>
                        <td><?php echo $item['name_tovara']; ?></td>
                        <td><?php echo $item['kolvo_tovara']; ?></td>
                        <td><?php echo $item['tsena_tovara']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a class="return" href="clients.php">Вернуться к списку клиентов</a>
    </div>
</body>
</html>

<?php 
$conn->close();
?>