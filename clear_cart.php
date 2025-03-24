<?php
session_start();
unset($_SESSION['cart']);
header("Location: shopingcart.php");
exit();
?>
