<?php
session_start();
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Tìm user theo email
    $stmt = $conn->prepare("SELECT passwords, role_id FROM user WHERE email = ? AND deleted = 0");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_password, $role_id);
        $stmt->fetch();

        // So sánh mật khẩu thô (KHÔNG sử dụng password_verify)
        if ($password === $db_password && $role_id == 1) {
            $_SESSION['user'] = $email;
            $_SESSION['role'] = $role_id;
            header("Location: index.php");
            exit();
        }
    }

    // Nếu đăng nhập thất bại
    $_SESSION['error'] = "Sai email, mật khẩu hoặc bạn không có quyền truy cập!";
    header("Location: signin.php");
    exit();
}
?>
