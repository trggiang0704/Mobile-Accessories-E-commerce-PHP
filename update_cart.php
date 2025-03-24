<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"]) && isset($_POST["quantity"])) {
    $product_id = $_POST["product_id"];
    $quantity = max(1, (int)$_POST["quantity"]);

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] = $quantity;
            break;
        }
    }
}

header("Location: shopingcart.php");
exit();
?>
