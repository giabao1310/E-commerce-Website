<?php
    include_once './admin/config/CheckLogin.php';
    include_once './admin/CheckFirstTimeLogin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/home.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./style.css">
    <title>Thông tin người dùng</title>
</head>

<body>
    <div id="root"></div>
    <section id="header" class="container">
        <a href="index.php">
            <img src="./images/Silver coin_free-file (1).png" alt="" class="main-logo" />
        </a>
        <i class="fa-solid fa-bars nav-open" onclick="myFunction()"></i>
        <div class="box">
            <div class="navbar">
                <ul class="navbar-list">
                    <li class="navbar-item">
                        <a class="item-link" href="index.php">
                            Trang chủ
                        </a>
                        <div class="line"></div>
                    </li>
                    <li class="navbar-item">
                        <a class="item-link" href="product.php">
                            Mua thẻ điện thoại
                        </a>
                        <div class="line"></div>
                    </li>
                    <li class="navbar-item">
                        <a class="item-link" href="transfer.php">
                            Chuyển tiền - Nhận tiền
                        </a>
                        <a class="item-link-child" href="withdraw.php">
                            Rút tiền
                        </a>
                        <div class="line"></div>
                    </li>
                    <li class="navbar-item">
                        <a class="item-link" href="#footer">
                            Liên hệ
                        </a>
                        <div class="line"></div>
                    </li>

                </ul>
            </div>

            <div id="user">
                <a class="user-link" href="#" id="user">
                    <img class="user-logo" src="./images/user1.jpg" alt="" />
                    <i class="fa-solid fa-caret-down"></i>
                </a>
                <ul class="user-subnav">
                    <?php include './admin/ShowAdminPanel.php'; ?>
                </ul>
            </div>

        </div>

    </section>


    <section id="infor" class="container">
        <h3 class="info-content">Thông tin người dùng</h3>
        <div class="info-box">
            <img src="./images/user1.jpg" alt="" class="info-img">
            <!-- Thông tin người dùng -->
            <div class="user-info">
                <div class="user-name">
                    <h3>Tên tài khoản: </h3>
                    <p id="fullname">Nguyễn Văn A</p>
                </div>
                <div class="user-phone">
                    <h3>Số điện thoại: </h3>
                    <p id="phonenumber">0909099099</p>
                </div>
                <div class="user-mail">
                    <h3>Email: </h3>
                    <p id="email">none@gmail.com</p>
                </div>
                <div class="user-birth">
                    <h3>Ngày sinh: </h3>
                    <p id="birthday">01/01/2002</p>
                </div>
            </div>
            <!-- Thông tin xác nhận tài khoản -->
            <div class="user-verify">
                <div class="user-balance">
                    <h3>Số dư tài khoản: </h3>
                    <p id="balance">0.000đ</p>
                </div>
                <div class="user-confirm">
                    <h3>Tình trạng xác minh: </h3>
                    <p id="state">Đã xác minh</p>
                    <i class="fa-solid" id="icon-state"></i>
                </div>

            </div>
        </div>
    </section>

    <footer id="footer" class="container">
        <div class="footer-box">
            <div class="col">
                <img src="./images/logo-footer.png" alt="" class="logo" />
                <h4>Liên hệ</h4>
                <p><strong>Địa chỉ::</strong> 19 Đ.Nguyễn Hữu Thọ, Tân Hưng, Quận 7, Thành phố Hồ Chí Minh</p>
                <p><strong>Điện thoại:</strong> +84 999 9999 999 // (+84) 888 8888 888</p>
                <p><strong>Giờ làm việc:</strong> 6:30 ~ 21:00, Thứ Hai - Thứ Bảy</p>
                <div class="follow">
                    <h4>Theo dõi chúng tôi trên các trang mạng xã hội:</h4>
                    <div class="icon">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-youtube"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <h4>Về chúng tôi</h4>
                <a href="#">Thông tin vận chuyển</a>
                <a href="#">Chính sách bảo mật</a>
                <a href="#">Điều khoản</a>
            </div>

            <div class="col">
                <h4>Giới thiệu</h4>
                <a href="#">Tin tức</a>
                <a href="#">Hợp tác doanh nghiệp</a>
                <a href="#">Liên kết ngân hàng</a>
            </div>

            <div class="col install">
                <h4>Tải ứng dụng miễn phí</h4>
                <p>Tại App Store hoặc Google Play</p>
                <div class="row">
                    <img src="./images/app-store.png" alt="" /><a href="https://www.apple.com/vn/"></a>
                    <img src="./images/google-play.png" alt="" /><a href="https://play.google.com/store"></a>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>© 2022, Đại học - Tôn Đức Thắng</p>
        </div>
    </footer>

    <script src="./main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        smooth_clicking();
        <?php
        if (isset($_SESSION['username'])) {
            echo "const username = '" . $_SESSION['username'] . "';\ncheckAuthentication(username);";
        }
        ?>
        get_information();
    </script>
</body>

</html>