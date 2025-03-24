<?php
include '../config/config.php';

// Truy vấn danh mục sản phẩm
$sql = "SELECT id, name FROM category";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm mới</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
<?php include 'header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-primary text-center">Thêm sản phẩm mới</h2>

        <div class="card shadow-sm p-4 bg-white">
            <form action="process_add_product.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Danh mục sản phẩm:</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm:</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Giá bán:</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Giảm giá (%):</label>
                        <input type="number" name="discount" class="form-control" value="0">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình ảnh sản phẩm:</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả sản phẩm:</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Thêm sản phẩm</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
