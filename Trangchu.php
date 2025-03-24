<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>T1 Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <header class="header">
        <?php include 'topheader.php'; ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="Trangchu.php"><img src="Layout/img/logot1_1.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li ><a href="Trangchu.php">Home</a></li>
                            <li ><a href="sanpham.php">Shop</a></li>
                            <li><a href="blog.php">Blog</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                        <div class="header__cart">
                            <ul>
                                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                                <li><a href="shopingcart.php"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form asp-controller="Home" asp-action="Search">
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>0866100704</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="Layout/img/hero/banner1.jpg">
                        <div class="hero__text">
                            <span>T1 Shop</span>
                            <h2>We've<br />ALL U NEED</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="sanpham.php" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="Layout/img/categories/product-1.jpg">
                            <h5><a href="sanpham.php">Iphone 16 pro max</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="Layout/img/categories/product-2.jpg">
                            <h5><a href="sanpham.php">Ss Galaxy Z Fold6</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="Layout/img/categories/product-3.jpg">
                            <h5><a href="sanpham.php">Loa JBL partybox</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="Layout/img/categories/product-4.jpg">
                            <h5><a href="sanpham.php">Airpod 4 pro</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="Layout/img/categories/product-5.jpg">
                            <h5><a href="sanpham.php">Sạc dự phòng</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Section Begin -->
    <?php
    require 'config/config.php'; // Kết nối database

    // Số sản phẩm trên mỗi trang
    $productsPerPage = 8;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $categoryFilter = isset($_GET['category']) ? $_GET['category'] : '*';
    $start = ($page - 1) * $productsPerPage;

    // Lấy danh sách danh mục
    $sql = "SELECT id, name FROM category";
    $result = $conn->query($sql);
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    // Điều kiện lọc theo danh mục nếu có
    $categoryCondition = "";
    if ($categoryFilter !== '*') {
        $categoryCondition = "WHERE c.name = '" . $conn->real_escape_string($categoryFilter) . "'";
    }

    // Truy vấn lấy sản phẩm theo phân trang
    $sql = "SELECT p.id, p.title, p.price, p.thumbnail, c.name AS category
            FROM product p
            INNER JOIN category c ON p.category_id = c.id
            $categoryCondition
            LIMIT $start, $productsPerPage";
    $result = $conn->query($sql);
    $products = $result->fetch_all(MYSQLI_ASSOC);

    // Truy vấn số lượng tổng sản phẩm
    $sqlTotal = "SELECT COUNT(*) AS total FROM product p INNER JOIN category c ON p.category_id = c.id $categoryCondition";
    $totalResult = $conn->query($sqlTotal);
    $totalProducts = $totalResult->fetch_assoc()['total'];
    $totalPages = ceil($totalProducts / $productsPerPage);
    ?>

    <style>
    .pagination {
        text-align: center;
        margin-top: 20px;
    }
    .pagination ul {
        list-style: none;
        padding: 0;
        display: flex;
        justify-content: center;
        gap: 10px;
    }
    .pagination ul li {
        display: inline;
    }
    .pagination ul li a {
        text-decoration: none;
        padding: 8px 12px;
        border: 1px solid #ddd;
        color: #333;
        border-radius: 5px;
        transition: 0.3s;
    }
    .pagination ul li a:hover, .pagination ul li.active a {
        background-color:#007bff;
        color: white;
        border-color: #007bff;
    }

    /* Cập nhật CSS cho danh mục */
    .featured__controls ul li a{
        display: inline-block;
        margin: 0 10px;
        cursor: pointer;
        color: rgb(0, 0, 0);
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 5px;
        transition: background 0.3s;
    }
    .featured__controls ul li:hover, .featured__controls ul li.active {
        background:rgb(209, 203, 203);
        color: rgb(0, 0, 0);
    }
    </style>

<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="<?= ($categoryFilter == '*') ? 'active' : '' ?>">
                            <a href="?category=*">All</a>
                        </li>
                        <?php foreach ($categories as $cat): ?>
                            <li class="<?= ($categoryFilter == $cat['name']) ? 'active' : '' ?>">
                                <a href="?category=<?= urlencode($cat['name']) ?>"> <?= htmlspecialchars($cat['name']) ?> </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mix <?= str_replace(" ", "-", strtolower($product['category'])) ?>">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" style="background-image: url('AnhMinhHoa/<?= htmlspecialchars($product['thumbnail']) ?>');">
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                <h6>
                                    <a href="ChitietSanPham.php?id_sp=<?php echo $row['id']; ?>">
                                        <?= htmlspecialchars($product['title']) ?>
                                    </a>
                                </h6>
                                    <h5> <?= number_format($product['price'], 2) . "$" ?> </h5>
                                </div>
                            </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
        
        <!-- Phân trang -->
        <div class="pagination">
            <?php if ($totalPages > 1): ?>
                <ul>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="<?= ($i == $page) ? 'active' : '' ?>">
                            <a href="?category=<?= urlencode($categoryFilter) ?>&page=<?= $i ?>"> <?= $i ?> </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function loadProducts(category, page) {
            $.ajax({
                url: 'fetchproduct.php',
                type: 'GET',
                data: { category: category, page: page },
                dataType: 'json',
                success: function (data) {
                    let productHtml = "";
                    if (data.products.length > 0) {
                        data.products.forEach(product => {
                            productHtml += `
                                <div class="col-lg-3 col-md-4 col-sm-6 mix ${product.category.replace(/\s+/g, '-').toLowerCase()}">
                                    <div class="featured__item">
                                        <div class="featured__item__pic set-bg" style="background-image: url('AnhMinhHoa/${product.thumbnail}');">
                                            <ul class="featured__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="featured__item__text">
                                            <h6><a href="sanpham.php">${product.title}</a></h6>                                            
                                            <h5>${parseFloat(product.price).toFixed(2)}$</h5>
                                        </div>
                                    </div>
                                </div>`;
                        });
                    } else {
                        productHtml = "<p>No products found.</p>";
                    }

                    $('.featured__filter').html(productHtml);

                    // Cập nhật phân trang
                    let paginationHtml = "<ul>";
                    for (let i = 1; i <= data.totalPages; i++) {
                        paginationHtml += `<li class="${i == page ? 'active' : ''}">
                            <a href="?category=${category}&page=${i}" class="pagination-link" data-page="${i}" data-category="${category}">${i}</a>
                        </li>`;
                    }
                    paginationHtml += "</ul>";
                    $('.pagination').html(paginationHtml);
                }
            });
        }

        // Khi click vào danh mục
        $('.featured__controls ul li a').click(function (e) {
            let href = $(this).attr('href');
            let urlParams = new URLSearchParams(href.split('?')[1]);
            let category = urlParams.get('category');

            if (category) {
                e.preventDefault(); // Chặn chỉ khi AJAX đang chạy
                loadProducts(category, 1);
                $('.featured__controls ul li').removeClass('active');
                $(this).parent().addClass('active');
            }
        });

        // Khi click vào phân trang
        $(document).on('click', '.pagination-link', function (e) {
            let page = $(this).data('page');
            let category = $(this).data('category');

            if (page && category) {
                e.preventDefault(); // Chặn chỉ khi AJAX chạy
                loadProducts(category, page);
            }
        });

        // Tải sản phẩm ban đầu nếu không có tham số trên URL
        let urlParams = new URLSearchParams(window.location.search);
        let initialCategory = urlParams.get('category') || '*';
        let initialPage = urlParams.get('page') || 1;
        loadProducts(initialCategory, initialPage);
    });
</script>


    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="public/_Layout/img/banner/banner-1.jpg" alt="" width="570" height="270">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="public/_Layout/img/banner/banner-2.jpg" alt="" width="570" height="270">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="public/_Layout/img/blog/blog_2.jpg" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> Nov 10, 2024</li>
                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                    </ul>
                                    <h5><a href="https://cellphones.com.vn/sforum/iphone-16-pro-max-camera-selfie-dep-nhat">iPhone 16 Pro Max là smartphone có camera chụp ảnh selfie đẹp nhất hiện nay</a></h5>
                                    <p>
                                        IPhone 16 Pro Max đã vượt qua Google Pixel 9 Pro XL, trở thành smartphone có camera selfie đẹp nhất thế giới với khả năng phơi sáng và độ chi tiết ấn tượng.
                                    </p>
                                    <a href="https://cellphones.com.vn/sforum/iphone-16-pro-max-camera-selfie-dep-nhat" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="public/_Layout/img/blog/blog_3.jpg" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> Nov 10, 2024</li>
                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                    </ul>
                                    <h5><a href="https://fptshop.com.vn/tin-tuc/tin-moi/thi-phan-smartphone-samsung-bat-ngo-vuot-mat-apple-ngay-tai-my-130053">Samsung bất ngờ vượt mặt Apple trong quý 3</a></h5>
                                    <p>
                                        Theo thống kê mới nhất, Samsung vừa vượt qua Apple trên thị trường điện thoại thông minh trong quý 3.
                                    </p>
                                    <a href="https://fptshop.com.vn/tin-tuc/tin-moi/thi-phan-smartphone-samsung-bat-ngo-vuot-mat-apple-ngay-tai-my-130053" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="public/_Layout/img/blog/blog_1.jpg" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> Nov 10, 2024</li>
                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                    </ul>
                                    <h5><a href="https://www.24h.com.vn/thoi-trang-hi-tech/samsung-tiep-tuc-nha-hang-cho-sieu-pham-nam-sau-c407a1615745.html">Samsung tiếp tục "nhá hàng" cho siêu phẩm năm sau</a></h5>
                                    <p>
                                        Theo sau Apple và nhiều "ông lớn" công nghệ khác, Samsung sẽ giới thiệu kính thực tế hỗn hợp trong năm tới.
                                    </p>
                                    <a href="https://www.24h.com.vn/thoi-trang-hi-tech/samsung-tiep-tuc-nha-hang-cho-sieu-pham-nam-sau-c407a1615745.html" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
     
    <?php include 'footer.php'; ?>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
