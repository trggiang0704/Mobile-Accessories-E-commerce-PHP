<?php
include '../config/config.php'; // Kết nối database

// Kiểm tra xem có tham số id được truyền không
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Không tìm thấy sản phẩm.");
}

$id = (int)$_GET['id'];

// Lấy danh sách danh mục
$categories_sql = "SELECT id, name FROM category";
$categories_result = $conn->query($categories_sql);

// Lấy thông tin sản phẩm từ database
$product_sql = "SELECT * FROM product WHERE id = $id";
$product_result = $conn->query($product_sql);
if ($product_result->num_rows == 0) {
    die("Sản phẩm không tồn tại.");
}
$product = $product_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2 class="text-primary">Chỉnh sửa sản phẩm</h2>
        <form action="process_edit_product.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

            <label for="category">Danh mục sản phẩm:</label>
            <select name="category_id" required class="form-control">
                <option value="">-- Chọn danh mục --</option>
                <?php while ($row = $categories_result->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $product['category_id']) ? 'selected' : ''; ?>>
                        <?php echo $row['name']; ?>
                    </option>
                <?php } ?>
            </select>

            <label for="title">Tên sản phẩm:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($product['title']); ?>" required class="form-control">

            <label for="price">Giá bán:</label>
            <input type="number" name="price" value="<?php echo $product['price']; ?>" required class="form-control">

            <label for="discount">Giảm giá (%):</label>
            <input type="number" name="discount" value="<?php echo $product['discount']; ?>" class="form-control">

            <label for="thumbnail">Hình ảnh sản phẩm:</label>
            <input type="file" name="thumbnail" accept="image/*" class="form-control">
            <img src="AnhMinhHoa/<?php echo $product['thumbnail']; ?>" width="100" class="mt-2">
            <input type="hidden" name="old_thumbnail" value="<?php echo $product['thumbnail']; ?>">

            <label for="description">Mô tả sản phẩm:</label>
            <textarea name="description" rows="4" class="form-control"><?php echo htmlspecialchars($product['description']); ?></textarea>

            <button type="submit" class="btn btn-success mt-3">Cập nhật sản phẩm</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include 'footer.php'; ?>

</body>
</html>

<?php $conn->close(); ?>
