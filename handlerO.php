<?php

include 'conn.php';

$conn = new mysqli($servername,  $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединения нет: ". $conn->connect_error);
}
$action = $_POST['action'];

switch ($action) {
    case 'create':
        $client = $_POST['client'];
        $date = $_POST['date'];
        $total = $_POST['total'];
    
        $sql = "INSERT INTO orderr (client, date, total) VALUES ('$client','$date', '$total')";
        if ($conn->query($sql) === true) {
            $lastOrderId = $conn->insert_id; // Получаем ID последнего вставленного заказа
            header("Location: createDet.php?orderId=$lastOrderId");
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
        break;
    
    case 'update':
        $id = $_POST['id'];
        $client = $_POST['client'];
        $date = $_POST['date'];
        $total = $_POST['total'];

        $sql = "UPDATE orderr 
        SET client = '$client', date = '$date', total ='$total'
        WHERE id = $id";
        if($conn->query($sql) ===true) {
            header("Location: orders.php");
        }
        else {
            echo "Ошибка: ". $sql."<br>".$conn->error;
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $sql = "DELETE FROM orderr WHERE id = $id";

        if($conn->query($sql) ===true) {
            header("Location: orders.php");
        }
        else {
            echo "Ошибка: ". $sql."<br>".$conn->error;
        }
        break;
    }