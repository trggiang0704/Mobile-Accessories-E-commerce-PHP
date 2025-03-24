<?php
include '../config/config.php'; // Kết nối database

// Kiểm tra xem có tham số id được truyền không
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Không tìm thấy sản phẩm.");
}

$id = (int)$_GET['id'];

// Truy vấn lấy thông tin sản phẩm từ bảng product
$product_sql = "SELECT * FROM product WHERE id = $id";
$product_result = $conn->query($product_sql);
if ($product_result->num_rows == 0) {
    die("Sản phẩm không tồn tại.");
}
$product = $product_result->fetch_assoc();

// Truy vấn lấy thông tin chi tiết từ bảng product_details
$details_sql = "SELECT * FROM product_detail WHERE product_id = $id";
$details_result = $conn->query($details_sql);
$details = ($details_result->num_rows > 0) ? $details_result->fetch_assoc() : [];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2 class="text-primary">Chi tiết sản phẩm</h2>
        <table class="table table-bordered">
            <tr><th>Tên sản phẩm</th><td><?php echo htmlspecialchars($product['title']); ?></td></tr>
            <tr><th>Hình ảnh</th><td><img src="AnhMinhHoa/<?php echo $details['image'] ?? 'no-image.png'; ?>" width="200"></td></tr>
            <tr><th>Giá bán</th><td><?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</td></tr>
            <tr><th>Giảm giá</th><td><?php echo $product['discount']; ?>%</td></tr>
            <tr><th>Mô tả</th><td><?php echo nl2br(htmlspecialchars($product['description'])); ?></td></tr>
            <tr><th>Màu sắc</th><td><?php echo $details['color'] ?? 'Không có thông tin'; ?></td></tr>
            <tr><th>Số lượng tồn kho</th><td><?php echo $details['stock_quantity'] ?? 'Không có thông tin'; ?></td></tr>
            <tr><th>Kích thước màn hình</th><td><?php echo $details['screen_size'] ?? 'Không có thông tin'; ?></td></tr>
            <tr><th>Loại màn hình</th><td><?php echo $details['screen_type'] ?? 'Không có thông tin'; ?></td></tr>
            <tr><th>RAM</th><td><?php echo $details['ram'] ?? 'Không có thông tin'; ?></td></tr>
            <tr><th>Bộ nhớ</th><td><?php echo $details['storage'] ?? 'Không có thông tin'; ?></td></tr>
            <tr><th>Chipset</th><td><?php echo $details['chipset'] ?? 'Không có thông tin'; ?></td></tr>
            <tr><th>Dung lượng pin</th><td><?php echo $details['battery_capacity'] ?? 'Không có thông tin'; ?></td></tr>
            <tr><th>Thời gian bảo hành</th><td><?php echo $details['warranty_period'] ?? 'Không có thông tin'; ?></td></tr>
        </table>
        <a href="productlist.php" class="btn btn-secondary">Quay lại danh sách</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include 'footer.php'; ?>

</body>
</html>

<?php $conn->close(); ?>