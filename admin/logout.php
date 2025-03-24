<?php
session_start();
session_destroy(); // Hủy toàn bộ session
header("Location: signin.php"); // Chuyển hướng về trang đăng nhập
exit();
?>
