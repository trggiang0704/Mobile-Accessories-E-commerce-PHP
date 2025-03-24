<?php
require 'config/config.php';

// Truy vấn danh mục sản phẩm
$sqlcate = "SELECT * FROM category";
$querycate = mysqli_query($conn, $sqlcate);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>

<?php include 'topheader.php'; ?>
<?php include 'headerheader.php'; ?>

<section class="product spad">
    <div class="container">
        <div class="row">
            <!-- Sidebar: Lọc danh mục, giá và tìm kiếm -->
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <!-- Thanh tìm kiếm -->
                    <div class="sidebar__item">
                        <h4>Tìm kiếm sản phẩm</h4>
                        <input type="text" id="search-box" class="form-control" placeholder="Nhập tên sản phẩm...">
                    </div>

                    <div class="sidebar__item">
                        <h4>Danh Mục</h4>
                        <ul id="category-list">
                            <li><a href="#" class="category-link" data-id="0">Tất Cả</a></li>
                            <?php while ($row = mysqli_fetch_array($querycate)) { ?>
                                <li><a href="#" class="category-link" data-id="<?php echo $row['id']; ?>">
                                    <?php echo htmlspecialchars($row['name']); ?>
                                </a></li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="sidebar__item">
                        <h4>Giá</h4>
                        <div class="price-range-wrap">
                            <div id="slider-range"></div>
                            <div class="range-slider">
                                <input type="text" id="minamount" readonly>
                                <input type="text" id="maxamount" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danh sách sản phẩm -->
            <div class="col-lg-9 col-md-7">
                <div class="row" id="product-list">
                    <!-- Sản phẩm sẽ được load bằng AJAX -->
                </div>

                <!-- Phân trang -->
                <div class="product__pagination" id="pagination">
                    <!-- Nút phân trang sẽ được load bằng AJAX -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<script>
$(document).ready(function() {
    let currentCategory = 0;
    let minPrice = 10;
    let maxPrice = 3000;
    let searchQuery = "";

    function loadProducts(category_id = currentCategory, min_price = minPrice, max_price = maxPrice, page = 1, search = searchQuery) {
        currentCategory = category_id;
        minPrice = min_price;
        maxPrice = max_price;
        searchQuery = search;

        $.ajax({
            url: "get_products.php",
            type: "POST",
            data: { category_id: currentCategory, min_price: minPrice, max_price: maxPrice, page: page, search: searchQuery },
            success: function(response) {
                let data = JSON.parse(response);
                $("#product-list").html(data.products);
                $("#pagination").html(data.pagination);
            }
        });
    }

    // Load tất cả sản phẩm khi trang mở lần đầu
    loadProducts();

    // Khi click vào danh mục
    $(".category-link").click(function(e) {
        e.preventDefault();
        let category_id = $(this).data("id");
        loadProducts(category_id, minPrice, maxPrice);
    });

    // Lọc giá bằng jQuery UI Slider
    $("#slider-range").slider({
        range: true,
        min: 10,
        max: 3000,
        values: [10, 3000],
        slide: function(event, ui) {
            $("#minamount").val(ui.values[0] + " $");
            $("#maxamount").val(ui.values[1] + " $");
        },
        stop: function(event, ui) {
            loadProducts(currentCategory, ui.values[0], ui.values[1]);
        }
    });

    $("#minamount").val($("#slider-range").slider("values", 0) + " $");
    $("#maxamount").val($("#slider-range").slider("values", 1) + " $");

    // Xử lý phân trang AJAX
    $(document).on("click", ".pagination-link", function(e) {
        e.preventDefault();
        let page = $(this).data("page");
        loadProducts(currentCategory, minPrice, maxPrice, page);
    });

    // Xử lý tìm kiếm sản phẩm
    $("#search-box").on("keyup", function() {
        let searchValue = $(this).val();
        loadProducts(currentCategory, minPrice, maxPrice, 1, searchValue);
    });
});
</script>

</body>
</html>
