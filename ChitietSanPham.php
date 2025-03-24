<?php 
include 'topheader.php';
include 'config/config.php'; // Kết nối database
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chi tiet san pham</title>

</head>

<body>
    <?php
        // Lấy ID sản phẩm từ URL
        $id_sp = $_GET['id_sp'];

        // Lấy thông tin sản phẩm (ảnh lớn từ bảng product)
        $sql = "SELECT * FROM product WHERE id = $id_sp";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $big_image = "AnhMinhHoa/" . $row['thumbnail']; // Ảnh lớn

        // Lấy danh sách ảnh nhỏ từ bảng gallery
        $sql_gallery = "SELECT thumbnail FROM galery WHERE product_id = $id_sp LIMIT 4";
        $result_gallery = mysqli_query($conn, $sql_gallery);

        $images = [];
        while ($gallery = mysqli_fetch_assoc($result_gallery)) {
            $images[] = $gallery;
        }
    ?>
    <?php include "headerheader.php"; ?>
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <!-- Ảnh lớn -->
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="<?= $big_image ?>" alt="">
                        </div>
                        <!-- Slider ảnh nhỏ -->
                        <div class="product__details__pic__slider owl-carousel">
                            <?php foreach ($images as $image) { ?>
                                <div class="owl-item">
                                    <img data-imgbigurl="<?= $big_image ?>" 
                                        src="AnhMinhHoa/<?= $image['thumbnail'] ?>" 
                                        alt="">
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $row['title']; ?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                            <div class="product__details__price"><?php echo isset($row['price']) ? $row['price'] : 'Price not available'; ?></div>
                            <p><?php echo isset($row['description']) ? $row['description'] : 'Description not available'; ?></p>
                        <!-- Form để thêm sản phẩm vào giỏ hàng -->
                        <form action="shopingcart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $row['title']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                            <button type="submit" name="add_to_cart" class="primary-btn">ADD TO CART</button>
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="number" name="quantity" value="1" min="1">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus
                                        suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam
                                        vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,
                                        accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a
                                        pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula
                                        elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci luctus
                                        et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam
                                        vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                                        Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
                                        porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
                                        sed sit amet dui. Proin eget tortor risus.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

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
    <!-- Related Product Section End -->
    <!-- Js Plugins -->
<style>
    .product__details__pic__slider {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .product__details__pic__slider .owl-item {
        border: 2px solid transparent;
        transition: border 0.3s ease-in-out, transform 0.3s;
        cursor: pointer;
        border-radius: 8px;
        overflow: hidden;
    }

    .product__details__pic__slider .owl-item img {
        width: 100px; /* Điều chỉnh kích thước ảnh nhỏ */
        height: 100px;
        object-fit: cover;
        border-radius: 6px;
        transition: transform 0.3s ease-in-out;
    }

    .product__details__pic__slider .owl-item:hover {
        border: 2px solid #ff6600; /* Viền nổi bật khi hover */
        transform: scale(1.1);
    }

    .product__details__pic__slider .owl-item.active {
        border: 2px solid #ff6600; /* Viền nổi bật khi ảnh đang được chọn */
    }

</style>
</body>

</html>
