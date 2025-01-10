<?php
include 'conn.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}

$action = $_POST['action'];

switch ($action) {
    case 'create':
        $order_id = $_POST['orderId'];
        $item = $_POST['item'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
    
        $sql = "INSERT INTO detorder (`order`, item, quantity, price) VALUES ('$order_id', '$item', '$quantity', '$price')";
        if ($conn->query($sql) === true) {
            header("Location: detorder.php?id=$order_id&success=true");
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
        break;
    case 'update':
        var_dump($_POST);
        $id = isset($_POST['iddet']) ? $_POST['iddet'] : null;

        if ($id === null) {
            die("ID не передан.");
        }
        $order_id = $_POST['order_id'];
        $item = $_POST['item'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        $sql = "UPDATE detorder 
        SET `order` = '$order_id', item = '$item', quantity ='$quantity', price = '$price' 
        WHERE id = $id";
        if($conn->query($sql) ===true) {
            header("Location: detorder.php?id=$order_id");
        }
        else {
            echo "Ошибка: ". $sql."<br>".$conn->error;
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $sqlGetOrderId = "SELECT `order` FROM detorder WHERE id = $id";
        $result = $conn->query($sqlGetOrderId);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $order_id = $row['order'];  
            $sql = "DELETE FROM detorder WHERE id = $id";
            if ($conn->query($sql) === true) {
                header("Location: detorder.php?id=$order_id");
            } else {
                echo "Ошибка: " . $sql . "<br>" . $conn->error;
            }
        }
        break;
        
}
?>
