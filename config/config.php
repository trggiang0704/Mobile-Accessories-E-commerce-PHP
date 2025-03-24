<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "qlycuahangdientu"; // Thay tên database của bạn

// Kết nối MySQL
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
