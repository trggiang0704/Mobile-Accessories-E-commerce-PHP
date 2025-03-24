<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] != 1) {
    header("Location: signin.php");
    exit();
}
?>
