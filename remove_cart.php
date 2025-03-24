<?php
session_start();

if (isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['product_id'] == $product_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}

header("Location: shopingcart.php");
exit();
?>
