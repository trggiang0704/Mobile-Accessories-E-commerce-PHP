<?php
include '../config/config.php'; // Kết nối database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $description = $_POST['description'];

    // Kiểm tra xem có ảnh tải lên không
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
        $thumbnail = basename($_FILES['thumbnail']['name']);
        $target_dir = "../uploads/";
        $target_file = $target_dir . $thumbnail;

        // Di chuyển file ảnh vào thư mục uploads
        move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_file);
    } else {
        $thumbnail = ""; // Nếu không có ảnh thì để trống
    }

    // Chèn dữ liệu vào database
    $sql = "INSERT INTO product (category_id, title, price, discount, thumbnail, description) 
            VALUES ('$category_id', '$title', '$price', '$discount', '$thumbnail', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm sản phẩm thành công!";
        header("Location: productlist.php"); // Chuyển hướng sau khi thêm thành công
        exit();
    } else {
        echo "Lỗi khi thêm sản phẩm: " . $conn->error;
    }

    $conn->close();
}
?>
