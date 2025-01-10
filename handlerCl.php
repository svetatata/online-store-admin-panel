<?php
include 'conn.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}

$action = $_POST['action'];

switch ($action) {
    case 'create':
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $patronymic = $_POST['patronymic'];
        $birthdate = $_POST['birthdate'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $passport = $_POST['passport'];
        
        $sql = "INSERT INTO client (last_name, first_name, patronymic, birth_date, email, address, passport)
                VALUES ('$lastname', '$firstname', '$patronymic', '$birthdate', '$email', '$address', '$passport')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
        break;
    case 'update':
        $id = $_POST['ID'];
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $patronymic = $_POST['patronymic'];
        $birthdate = $_POST['birthdate'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $passport = $_POST['passport'];

        $sql = "UPDATE client SET last_name='$lastname', first_name='$firstname', patronymic='$patronymic', birth_date='$birthdate', email='$email', address='$address', passport='$passport' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header("Location: clients.php");
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
        break;
    case 'delete':
        $id = $_POST['ID'];
        $sql = "DELETE FROM client WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header("Location: clients.php");
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
        break;
}

$conn->close();
?>
