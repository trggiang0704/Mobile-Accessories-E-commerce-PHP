<?php
include 'topheader.php';
include 'config/config.php'; // Kết nối database

// Kiểm tra xem email có trong session không
if (isset($_SESSION['user'])) {
    $email = $_SESSION['user']; // Lấy email từ session
} elseif (isset($_GET['user'])) {
    $email = $_GET['user']; // Lấy email từ URL (nếu có)
} else {
    die("Lỗi: Bạn chưa đăng nhập! <a href='login.php'>Đăng nhập ngay</a>");
}

// Truy vấn thông tin user dựa trên email
$sql = "SELECT fullname, email, phone_number, address, role_id, created_at 
        FROM user
        WHERE email = '$email' AND deleted = 0";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);
if (!$user) {
    die("Không tìm thấy thông tin người dùng!");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
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
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .profile-container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); }
        .profile-container h2 { text-align: center; }
        .profile-container p { margin: 10px 0; }
        .profile-container strong { color: #333; }
    </style>
</head>
<body>
    <header class="header">
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
    <div class="profile-container">
        <h2>Thông tin cá nhân</h2>
        <p><strong>👤 Họ và tên:</strong> <?php echo htmlspecialchars($user['fullname']); ?></p>
        <p><strong>📧 Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>📞 Số điện thoại:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
        <p><strong>🏠 Địa chỉ:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
        <p><strong>🛠 Vai trò:</strong> <?php echo ($user['role_id'] == 1) ? 'Quản trị viên' : 'Người dùng'; ?></p>
        <p><strong>📅 Ngày tham gia:</strong> <?php echo date("d/m/Y", strtotime($user['created_at'])); ?></p>
    </div>
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
