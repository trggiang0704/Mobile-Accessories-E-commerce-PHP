<?php
require '../config/config.php'; // Kết nối database

// Kiểm tra kết nối database
if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Lấy dữ liệu tổng doanh thu theo tháng
$revenueData = [];
$query = "SELECT MONTH(order_date) AS month, SUM(total_money) AS revenue FROM orders GROUP BY MONTH(order_date)";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $revenueData[$row['month']] = $row['revenue'];
}

// Lấy dữ liệu số đơn hàng theo trạng thái
$orderStatusData = [];
$query = "SELECT status, COUNT(*) AS count FROM orders GROUP BY status";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $orderStatusData[$row['status']] = $row['count'];
}

// Lấy dữ liệu top 5 sản phẩm bán chạy (lấy title thay vì product_id)
$topProductsData = [];
$query = "SELECT p.title, SUM(od.num) AS total_sold 
          FROM order_details od 
          JOIN product p ON od.product_id = p.id
          GROUP BY p.title 
          ORDER BY total_sold DESC 
          LIMIT 5";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $topProductsData[$row['title']] = $row['total_sold'];
}

// Lấy dữ liệu tình trạng kho hàng theo tên sản phẩm
$stockData = [];
$query = "SELECT p.title, pd.stock_quantity 
          FROM product_detail pd 
          JOIN product p ON pd.product_id = p.id";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $stockData[$row['title']] = $row['stock_quantity'];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Thống kê doanh thu và đơn hàng</h1>
    <canvas id="revenueChart"></canvas>
    <canvas id="orderStatusChart"></canvas>
    <canvas id="topProductsChart"></canvas>
    <canvas id="stockChart"></canvas>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Dữ liệu tổng doanh thu theo tháng
            let revenueData = <?php echo json_encode($revenueData); ?>;
            let ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctxRevenue, {
                type: 'bar',
                data: {
                    labels: Object.keys(revenueData),
                    datasets: [{
                        label: 'Doanh thu theo tháng',
                        data: Object.values(revenueData),
                        backgroundColor: 'blue'
                    }]
                }
            });

            // Dữ liệu số đơn hàng theo trạng thái
            let orderStatusData = <?php echo json_encode($orderStatusData); ?>;

            // Định nghĩa màu theo trạng thái đơn hàng
            let statusColors = {
                "1": "green",       // Hoàn thành
                "0": "red",    // Chưa duyệt
            };

            // Sắp xếp trạng thái đúng thứ tự
            let sortedStatuses = Object.keys(orderStatusData).sort(); 

            // Lấy danh sách màu theo trạng thái
            let backgroundColors = sortedStatuses.map(status => statusColors[status] || "gray");

            let ctxOrderStatus = document.getElementById('orderStatusChart').getContext('2d');
            new Chart(ctxOrderStatus, {
                type: 'pie',
                data: {
                    labels: sortedStatuses.map(status => {
                        if (status === "1") return "Hoàn thành";
                        if (status === "0") return "Chưa duyệt";
                        return "Khác";
                    }),
                    datasets: [{
                        label: 'Trạng thái đơn hàng',
                        data: sortedStatuses.map(status => orderStatusData[status]),
                        backgroundColor: backgroundColors
                    }]
                }
            });

            // Dữ liệu top 5 sản phẩm bán chạy (hiển thị title)
            let topProductsData = <?php echo json_encode($topProductsData); ?>;
            let ctxTopProducts = document.getElementById('topProductsChart').getContext('2d');
            new Chart(ctxTopProducts, {
                type: 'bar',
                data: {
                    labels: Object.keys(topProductsData), // Sử dụng tên sản phẩm
                    datasets: [{
                        label: 'Top sản phẩm bán chạy',
                        data: Object.values(topProductsData),
                        backgroundColor: 'purple'
                    }]
                }
            });

            // Dữ liệu tình trạng kho hàng (hiển thị title)
            let stockData = <?php echo json_encode($stockData); ?>;
            let ctxStock = document.getElementById('stockChart').getContext('2d');
            new Chart(ctxStock, {
                type: 'bar',
                data: {
                    labels: Object.keys(stockData), // Sử dụng tên sản phẩm
                    datasets: [{
                        label: 'Số lượng tồn kho',
                        data: Object.values(stockData),
                        backgroundColor: 'orange'
                    }]
                }
            });
        });
    </script>
</body>
</html>
