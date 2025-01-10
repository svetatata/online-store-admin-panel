<?php

include 'conn.php';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Проверьте подключение: " . $conn->connect_error);
}

$action = $_POST['action'];

switch ($action) {
    case 'create':
        $itname = $_POST['itname'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $cat = $_POST['cat'];

        $sql = "INSERT INTO items (itname, price, stock, cat)
                VALUES ('$itname', '$price', '$stock', '$cat')";
        if ($conn->query($sql) === true) {
            header("Location: items.php");
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
        break;

    case 'update':
        $id = $_POST['ID'];
        $itname = $_POST['itname'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $cat = $_POST['cat'];

        $sql = "UPDATE items 
                SET itname='$itname', price='$price', stock='$stock', cat='$cat' 
                WHERE id=$id";
        if ($conn->query($sql) === true) {
            header("Location: items.php");
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
        break;

    case 'delete':
        $id = $_POST['ID'];
        $sql = "DELETE FROM items WHERE id=$id";

        if ($conn->query($sql) === true) {
            header("Location: items.php");
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
        break;

    case 'add1':
        $id = $_POST['ID'];
        $sql = "UPDATE items 
                SET stock = stock + 1 
                WHERE id=$id";

        if ($conn->query($sql) === true) {
            header("Location: items.php");
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
        break;

    case 'delete1':
        $id = $_POST['ID'];
        $sql = "UPDATE items 
                SET stock = stock - 1 
                WHERE id=$id AND stock > 0";

        if ($conn->query($sql) === true) {
            header("Location: items.php");
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
        break;
}

$conn->close();
?>
