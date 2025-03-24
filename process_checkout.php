<?php
session_start();
include 'config/config.php'; // Kết nối database

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['cart'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $total_money = $_POST['total_money'];
    $order_date = date('Y-m-d H:i:s');

    // Thêm vào bảng `orders`
    $sql = "INSERT INTO orders (fullname, email, phone_number, address, total_money, order_date, status) 
            VALUES ('$fullname', '$email', '$phone_number', '$address', '$total_money', '$order_date', 0)";
    if (mysqli_query($conn, $sql)) {
        $order_id = mysqli_insert_id($conn);

        // Lưu từng sản phẩm vào `order_detail`
        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['product_id'];
            $price = $item['product_price'];
            $num = $item['quantity'];
            $subtotal = $price * $num;

            $sql_detail = "INSERT INTO order_details (order_id, product_id, price, num, total_money) 
                           VALUES ('$order_id', '$product_id', '$price', '$num', '$subtotal')";
            mysqli_query($conn, $sql_detail);
        }

        // Xóa giỏ hàng sau khi đặt hàng
        unset($_SESSION['cart']);
        $success = true;
    } else {
        $error_message = "Lỗi đặt hàng: " . mysqli_error($conn);
    }
} else {
    $error_message = "Giỏ hàng trống hoặc có lỗi xảy ra.";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .success-icon {
            font-size: 50px;
            color: #28a745;
        }
        .error-icon {
            font-size: 50px;
            color: #dc3545;
        }
        h2 {
            margin-top: 10px;
            color: #333;
        }
        p {
            color: #666;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <?php if (isset($success) && $success): ?>
        <i class="fa fa-check-circle success-icon"></i>
        <h2>Đặt hàng thành công!</h2>
        <p>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ liên hệ với bạn sớm nhất có thể.</p>
    <?php else: ?>
        <i class="fa fa-times-circle error-icon"></i>
        <h2>Đặt hàng thất bại</h2>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <a href="Trangchu.php" class="btn">Quay lại trang chủ</a>
</div>

</body>
</html>