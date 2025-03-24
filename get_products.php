<?php
require 'config/config.php';

$category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;
$min_price = isset($_POST['min_price']) ? (float)$_POST['min_price'] : 10;
$max_price = isset($_POST['max_price']) ? (float)$_POST['max_price'] : 3000;
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$search = isset($_POST['search']) ? mysqli_real_escape_string($conn, trim($_POST['search'])) : "";

$limit = 6;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM product WHERE price BETWEEN $min_price AND $max_price";
if ($category_id > 0) {
    $sql .= " AND category_id = $category_id";
}
if (!empty($search)) {
    $sql .= " AND title LIKE '%$search%'";
}
$sql .= " ORDER BY id ASC LIMIT $limit OFFSET $offset";

$query = mysqli_query($conn, $sql);

$total_products_query = "SELECT COUNT(*) AS total FROM product WHERE price BETWEEN $min_price AND $max_price";
if ($category_id > 0) {
    $total_products_query .= " AND category_id = $category_id";
}
if (!empty($search)) {
    $total_products_query .= " AND title LIKE '%$search%'";
}

$total_result = mysqli_query($conn, $total_products_query);
$total_products_row = mysqli_fetch_assoc($total_result);
$total_products = $total_products_row['total'];
$total_pages = ceil($total_products / $limit);

$output = "";
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $output .= '
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg">
                        <img src="AnhMinhHoa/' . htmlspecialchars($row['thumbnail']) . '" alt="' . htmlspecialchars($row['title']) . '" class="img-fluid">
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="ChitietSanPham.php?id_sp=' . $row['id'] . '"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="ChitietSanPham.php?id_sp=' . $row['id'] . '">' . htmlspecialchars($row['title']) . '</a></h6>
                        <h5>' . number_format($row['price'], 2) . ' $</h5>
                    </div>
                </div>
            </div>
        ';
    }
} else {
    $output = "<p class='text-center'>Không có sản phẩm nào.</p>";
}

$pagination = "";
for ($i = 1; $i <= $total_pages; $i++) {
    $pagination .= '<a href="#" class="pagination-link" data-page="' . $i . '">' . $i . '</a>';
}

echo json_encode(["products" => $output, "pagination" => $pagination]);
?>
