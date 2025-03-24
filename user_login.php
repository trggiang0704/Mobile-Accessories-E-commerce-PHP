<?php
include 'config/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Truy vấn lấy full name
    $stmt = $conn->prepare("SELECT fullname, passwords FROM user WHERE email = ? AND deleted = 0");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($fullname, $hash);
        $stmt->fetch();

        // Kiểm tra mật khẩu
        if ($password === $hash) {  // Không dùng password_verify() nếu không mã hóa mật khẩu
            $_SESSION['user'] = $email;
            $_SESSION['fullname'] = $fullname; // Lưu fullname vào session
            header("Location: Trangchu.php");
            exit();
        }
    }

    $_SESSION['error'] = "Sai email hoặc mật khẩu!";
    header("Location: signin.php");
    exit();
}
?>
