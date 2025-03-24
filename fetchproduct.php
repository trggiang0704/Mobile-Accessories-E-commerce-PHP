<?php
require 'config/config.php';

$productsPerPage = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '*';
$start = ($page - 1) * $productsPerPage;

$categoryCondition = "";
if ($categoryFilter !== '*') {
    $categoryCondition = "WHERE c.name = '" . $conn->real_escape_string($categoryFilter) . "'";
}

// Lấy sản phẩm
$sql = "SELECT p.id, p.title, p.price, p.thumbnail, c.name AS category
        FROM product p
        INNER JOIN category c ON p.category_id = c.id
        $categoryCondition
        LIMIT $start, $productsPerPage";

$result = $conn->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);

// Tổng số sản phẩm
$sqlTotal = "SELECT COUNT(*) AS total FROM product p INNER JOIN category c ON p.category_id = c.id $categoryCondition";
$totalResult = $conn->query($sqlTotal);
$totalProducts = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalProducts / $productsPerPage);

// Trả về JSON
echo json_encode([
    'products' => $products,
    'totalPages' => $totalPages
]);
?>