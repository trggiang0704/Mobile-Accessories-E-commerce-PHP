<?php
include '../config/config.php'; // Kết nối database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];
    $category_id = (int)$_POST['category_id'];
    $title = trim($_POST['title']);
    $price = (float)$_POST['price'];
    $discount = (int)$_POST['discount'];
    $description = trim($_POST['description']);
    $old_thumbnail = $_POST['old_thumbnail'];

    // Xử lý upload hình ảnh mới nếu có
    if (!empty($_FILES['thumbnail']['name'])) {
        $target_dir = "../uploads/";
        $thumbnail = basename($_FILES['thumbnail']['name']);
        $target_file = $target_dir . $thumbnail;
        move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_file);
    } else {
        $thumbnail = $old_thumbnail;
    }

    // Cập nhật dữ liệu vào database
    $sql = "UPDATE product SET category_id=?, title=?, price=?, discount=?, thumbnail=?, description=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isdisii", $category_id, $title, $price, $discount, $thumbnail, $description, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật sản phẩm thành công!'); window.location.href='productlist.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi cập nhật sản phẩm!'); history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Yêu cầu không hợp lệ!'); window.location.href='productlist.php';</script>";
}
?>
