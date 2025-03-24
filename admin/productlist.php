<?php
// Kết nối database
include '../config/config.php'; // File chứa thông tin kết nối database

// Số sản phẩm trên mỗi trang
$limit = 15;

// Xác định trang hiện tại (mặc định là 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Tính offset
$offset = ($page - 1) * $limit;

// Lấy từ khóa tìm kiếm
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Lấy tổng số sản phẩm
$total_sql = "SELECT COUNT(*) as total FROM product WHERE title LIKE ?";
$stmt = $conn->prepare($total_sql);
$search_param = "%$search%";
$stmt->bind_param("s", $search_param);
$stmt->execute();
$total_result = $stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];

// Tính tổng số trang
$total_pages = ceil($total_products / $limit);

// Truy vấn lấy danh sách sản phẩm có phân trang
$sql = "SELECT id, title, price, thumbnail FROM product WHERE title LIKE ? LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $search_param, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
<?php include 'header.php'; ?>

<div class="container mt-4">
    <h2 class="text-primary">Danh sách các sản phẩm</h2>
    <a href="productadd.php" class="btn btn-success mb-3">Thêm sản phẩm mới</a>
    
    <!-- Form tìm kiếm -->
    <form method="GET" action="" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Nhập tên sản phẩm..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>
    
    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá bán</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $index = 0;
                while ($row = $result->fetch_assoc()) {
                    $background = ($index % 2 == 0) ? "#ffffff" : "#d9e7ff"; // Chẵn: trắng, Lẻ: xanh
                    echo "<tr style='background: $background;'>";
                    echo "<td><img src='AnhMinhHoa/" . htmlspecialchars($row['thumbnail']) . "' width='80' height='80' class='img-thumbnail'></td>";
                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                    echo "<td>" . number_format($row['price'], 0, ',', '.') . " VNĐ</td>";
                    echo "<td>
                            <a href='productedit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a> 
                            <a href='productdetails.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>Details</a> 
                            <a href='productdelete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                    $index++;
                }
            } else {
                echo "<tr><td colspan='4' class='text-center text-danger'>Không có sản phẩm nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($page > 1) { ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo ($page - 1); ?>&search=<?php echo urlencode($search); ?>">← Trang trước</a></li>
            <?php } ?>

            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>

            <?php if ($page < $total_pages) { ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo ($page + 1); ?>&search=<?php echo urlencode($search); ?>">Trang sau →</a></li>
            <?php } ?>
        </ul>
    </nav>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
