<?php

include 'conn.php';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn -> connect_error){
    die("Проверьте подключение".$conn->connect_error);
}

$action = $_POST['action'];

switch ($action) {
    case 'create':
        $name = $_POST['name'];

        $sql = "INSERT INTO cats (name)
        VALUES ('$name')";
        if($conn->query($sql) ===true) {
            header("Location: cats.php");
        }
        else {
            echo "Ошибка: ". $sql."<br>".$conn->error;
        }
        break;
    case 'update':
        $id = $_POST['id'];
        $name = $_POST['name'];

        $sql = "UPDATE cats 
        SET name ='$name', id = '$id' 
        WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            header("Location: cats.php");
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
        break;
    case 'delete':
        $id = $_POST['ID'];
        $sql = "DELETE FROM cats WHERE id=$id";

        if($conn->query($sql) ===true) {
            header("Location: cats.php");
        }
        else {
            echo "Ошибка: ". $sql."<br>".$conn->error;
        }
        break;
    
}

$conn->close();