<?php
include '../config/config.php';

// Xử lý duyệt đơn hàng
if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $conn->query("UPDATE orders SET status = 1 WHERE id = $approve_id");
    echo "<script>alert('Đơn hàng đã được duyệt!'); window.location.href='oders.php';</script>";
    exit();
}

// Lấy danh sách đơn hàng
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function confirmApproval(id) {
            if (confirm('Bạn có chắc chắn muốn duyệt đơn hàng này không?')) {
                window.location.href = '?approve_id=' + id;
            }
        }
    </script>
</head>
<body>
<?php include 'header.php'; ?>

<div class="container mt-4">
    <h2>Danh sách đơn hàng</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Ngày đặt hàng</th>
                <th>Trạng thái</th>
                <th>Tổng tiền</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td><?php echo $row['status'] == 1 ? 'Hoàn thành' : 'Đang xử lý'; ?></td>
                    <td><?php echo number_format($row['total_money'], 0, ',', '.'); ?> $</td>
                    <td>
                        <a href="oders.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Xem chi tiết</a>
                        <?php if ($row['status'] == 0) { ?>
                            <button onclick="confirmApproval(<?php echo $row['id']; ?>)" class="btn btn-success btn-sm">Duyệt đơn</button>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
// Xem chi tiết đơn hàng với thông tin sản phẩm
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $sql = "SELECT od.*, p.title AS product_name, p.thumbnail AS product_image FROM order_details od 
            JOIN product p ON od.product_id = p.id WHERE od.order_id = $order_id";
    $details_result = $conn->query($sql);
    ?>
    <div class="container mt-4">
        <h2>Chi tiết đơn hàng #<?php echo $order_id; ?></h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($detail = $details_result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $detail['id']; ?></td>
                        <td><?php echo $detail['product_name']; ?></td>
                        <td><img src="AnhMinhHoa/<?php echo $detail['product_image']; ?>" width="50"></td>
                        <td><?php echo number_format($detail['price'], 0, ',', '.'); ?> VNĐ</td>
                        <td><?php echo $detail['num']; ?></td>
                        <td><?php echo number_format($detail['total_money'], 0, ',', '.'); ?> VNĐ</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
}
$conn->close();
?>
</body>
</html>
