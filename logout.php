<?php
session_start();
session_destroy(); // Xóa tất cả session
header("Location: Trangchu.php");
exit();
?>
