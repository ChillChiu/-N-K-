<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tra_sua_mvc";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// set charset
mysqli_set_charset($conn, "utf8mb4");
?>
