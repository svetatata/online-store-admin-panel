<?php
session_start();
include 'conn.php';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn -> connect_error){
    die("Проверьте подключение".$conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $sql = "SELECT id FROM client WHERE email = '$email'";
    // $sql = "SELECT id, role FROM client WHERE email = '$email'";
    $result->query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        // $role = $row['role'];

        $_SESSION['client_logged_in'] = true;
        $_SESSION['client_id'] = $id;
        // $_SESSION['role'] = $role;

        header("Location: items.php");
        exit;
    } else {
        echo "Неправильный email.";
    }

    $conn->close();
}
?>
