<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>T1 Mobile Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="public/_Layout/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="public/_Layout/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="public/_Layout/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="public/_Layout/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="public/_Layout/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="public/_Layout/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="public/_Layout/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="public/_Layout/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
    <?php include 'topheader.php'; ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a asp-controller="Home" asp-action="Index"><img src="public/_Layout/img/logot1_1.png" alt=""></a>
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
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="public/_Layout/img/hero/banner2.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Blog</h2>
                        <div class="breadcrumb__option">
                            <a asp-controller="Home" asp-action="Index">Home</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        
                        <div class="blog__sidebar__item">
                            <h4>Recent News</h4>
                            <div class="blog__sidebar__recent">
                                <a href="https://www.24h.com.vn/thoi-trang-hi-tech/nhung-tinh-nang-noi-bat-khien-iphone-16-dang-de-nang-cap-c407a1615966.html" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="public/_Layout/img/blog/sidebar/sth1.jpg" alt="">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>Những tính năng nổi bật khiến iPhone 16 đáng để nâng cấp<br /> </h6>
                                        <span>Nov 08, 2024</span>
                                    </div>
                                </a>
                                <a href="https://www.24h.com.vn/thoi-trang-hi-tech/realme-gt-7-pro-ra-mat-voi-cau-hinh-khoe-pin-6500-mah-c407a1616296.html" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="public/_Layout/img/blog/sidebar/sth2.jpg" alt="">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>Realme GT 7 Pro ra mắt với cấu hình khỏe, pin 6.500 mAh<br /> </h6>
                                        <span>Nov 08, 2024</span>
                                    </div>
                                </a>
                                <a href="https://www.24h.com.vn/thoi-trang-hi-tech/snapdragon-8-elite-dang-khien-samsung-lo-lang-vi-dieu-nay-c407a1615673.html" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="public/_Layout/img/blog/sidebar/sth3.jpg" alt="">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>Snapdragon 8 Elite đang khiến Samsung lo lắng vì điều này<br /></h6>
                                        <span>Nov 08, 2024</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
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
                        <div class="col-lg-6 col-md-6 col-sm-6">
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
                        <div class="col-lg-6 col-md-6 col-sm-6">
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
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="public/_Layout/img/blog/blog_4.jpg" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> Nov 10, 2024</li>
                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                    </ul>
                                    <h5><a href="https://www.24h.com.vn/thoi-trang-hi-tech/tin-vui-cho-nhung-ifan-doi-iphone-17-series-c407a1615278.html">Tin vui cho những iFan đợi iPhone 17 Series</a></h5>
                                    <p>
                                        Báo cáo mới nhất cho hay, iPhone 17 Series của năm sau sẽ sử dụng chip Wi-Fi 7 của chính Apple.
                                    </p>
                                    <a href="https://www.24h.com.vn/thoi-trang-hi-tech/tin-vui-cho-nhung-ifan-doi-iphone-17-series-c407a1615278.html" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="public/_Layout/img/blog/blog_5.jpg" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> Nov 10, 2024</li>
                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                    </ul>
                                    <h5><a href="https://www.nguoiduatin.vn/apple-chap-nhan-sua-chua-mien-phi-cho-loi-tren-mot-mau-iphone-204240211163043998.htm">Apple chấp nhận sửa chữa miễn phí cho lỗi trên một mẫu iPhone</a></h5>
                                    <p>
                                        Apple vừa công bố chương trình dịch vụ sửa chữa miễn phí dành cho một số mẫu iPhone 14 Plus gặp sự cố với camera sau.
                                    </p>
                                    <a href="https://www.nguoiduatin.vn/apple-chap-nhan-sua-chua-mien-phi-cho-loi-tren-mot-mau-iphone-204240211163043998.htm" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="public/_Layout/img/blog/blog_6.jpg" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> Nov 10, 2024</li>
                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                    </ul>
                                    <h5><a href="https://www.24h.com.vn/thoi-trang-hi-tech/xiaomi-lang-nghe-nguoi-dung-iphone-nhieu-hon-chinh-apple-c407a1615161.html">Xiaomi lắng nghe người dùng iPhone nhiều hơn chính Apple</a></h5>
                                    <p>
                                        Xiaomi vừa công bố quyết định loại bỏ tùy chọn RAM 8 GB trên các mẫu smartphone cao cấp, điều mà chính các fan Nhà Táo luôn mong muốn.
                                    </p>
                                    <a href="https://www.24h.com.vn/thoi-trang-hi-tech/xiaomi-lang-nghe-nguoi-dung-iphone-nhieu-hon-chinh-apple-c407a1615161.html" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="product__pagination blog__pagination">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
    <!-- Footer Section Begin -->
    <?php include 'footer.php'; ?>
    <!-- Footer Section End -->
    <!-- Js Plugins -->
    <script src="public/_Layout/js/jquery-3.3.1.min.js"></script>
    <script src="public/_Layout/js/bootstrap.min.js"></script>
    <script src="public/_Layout/js/jquery.nice-select.min.js"></script>
    <script src="public/_Layout/js/jquery-ui.min.js"></script>
    <script src="public/_Layout/js/jquery.slicknav.js"></script>
    <script src="public/_Layout/js/mixitup.min.js"></script>
    <script src="public/_Layout/js/owl.carousel.min.js"></script>
    <script src="public/_Layout/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>