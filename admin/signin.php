<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - Bootstrap Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-md-6 col-lg-5">
                    <div class="bg-light rounded p-4">
                        <h3 class="mb-3 text-center">Sign In</h3>

                        <!-- Hiển thị thông báo lỗi -->
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                        <?php endif; ?>

                        <form action="login.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                                <label>Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                <label>Password</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Sign In</button>
                        </form>

                        <p class="text-center mt-3">Don't have an Account? <a href="register.php">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
