<?php
session_start(); // Bắt đầu session để lưu dữ liệu giỏ hàng
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'][] = [
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'quantity' => $quantity,
        'thumbnail' => $product_image // Đảm bảo lưu ảnh vào session
    ];    
}
?>
