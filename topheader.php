<?php
session_start();
require 'config/config.php';
?>
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> Welcome to my shop</li>
                            <li>Free Shipping for all Order of $99</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right d-flex justify-content-end align-items-center">
                        <!-- User Dropdown -->
                        <div class="header__top__right__user dropdown">
                            <?php if (isset($_SESSION['fullname'])): ?>
                                <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user-circle"></i>
                                    <span class="ms-2 fw-bold text-dark"><?php echo $_SESSION['fullname']; ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                                    <li><a class="dropdown-item" href="user_detail.php"><i class="fas fa-user"></i>Thông tin cá nhân</a></li>
                                </ul>
                            <?php else: ?>
                                <a href="login.php" class="btn btn-primary">Sign In</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
