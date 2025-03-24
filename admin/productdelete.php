<?php
include '../config/config.php'; // Kết nối database

// Kiểm tra xem có tham số id được truyền không
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Không tìm thấy sản phẩm để xóa.");
}

$id = (int)$_GET['id'];

// Lấy thông tin sản phẩm để xóa ảnh nếu có
$product_sql = "SELECT thumbnail FROM product WHERE id = $id";
$product_result = $conn->query($product_sql);
if ($product_result->num_rows == 0) {
    die("Sản phẩm không tồn tại.");
}
$product = $product_result->fetch_assoc();

// Xóa ảnh sản phẩm khỏi thư mục uploads nếu tồn tại
if (!empty($product['thumbnail']) && file_exists("../uploads/" . $product['thumbnail'])) {
    unlink("../uploads/" . $product['thumbnail']);
}

// Xóa sản phẩm khỏi database
$delete_sql = "DELETE FROM product WHERE id = $id";
if ($conn->query($delete_sql) === TRUE) {
    echo "<script>alert('Xóa sản phẩm thành công!'); window.location.href='productlist.php';</script>";
} else {
    echo "Lỗi khi xóa sản phẩm: " . $conn->error;
}

$conn->close();
?>
