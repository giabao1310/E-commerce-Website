<?php include './admin/CheckFirstTimeLogin.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="./responsive.css">
    <link rel="shortcut icon" href="./images/home.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Home Page</title>


</head>

<body>
    <div id="root"></div>
    <section id="header" class="container">
        <a href="#root">
            <img src="./images/Silver coin_free-file (1).png" alt="" class="main-logo" />
        </a>
        <i class="fa-solid fa-bars nav-open" onclick="myFunction()"></i>
        <div class="box">
            <div class="navbar">
                <ul class="navbar-list">
                    <li class="navbar-item">
                        <a class="item-link" href="#root">
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


    <section id="body" class="container">
        <!-- slide show -->
        <div class="slideshow-container">

            <!-- Ảnh full kích thước với các số trang -->
            <div class="mySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src="./images/slide1.jpg" style="width:100%">
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="./images/slide2.png" style="width:100%">
            </div>

            <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="./images/slide3.jpg" style="width:100%">
            </div>

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>

        <!-- Chấm tròn đếm trang -->
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>

    </section>

    <!-- feature -->
    <section id="feature" class="container">
        <h3>Tính năng</h3>
        <div class="boxes">
            <div class="fe-box">
                <img src="./images/tradeMoney.jpg " alt="" class="fe-img" />
                <h6>Nạp - chuyển tiền</h6>
            </div>
            <div class="fe-box">
                <img src="./images/freeShip.jpg" alt="" class="fe-img" />
                <h6>Miễn phí vận chuyển</h6>
            </div>
            <div class="fe-box">
                <img src="./images/onlineOrder.jpg" alt="" class="fe-img" />
                <h6>Đặt hàng trực tuyến</h6>
            </div>
            <div class="fe-box">
                <img src="./images/saveMoney.jpg" alt="" class="fe-img" />
                <h6>Tiết kiệm chi phí</h6>
            </div>
            <div class="fe-box">
                <img src="./images/sale.jpg" alt="" class="fe-img" />
                <h6>Khuyễn mãi cực lớn</h6>
            </div>
            <div class="fe-box">
                <img src="./images/support.png" alt="" class="fe-img" />
                <h6>Đội ngũ hỗ trợ 24/7</h6>
            </div>
        </div>
    </section>
    <!-- end feature -->

    <!-- some voucher -->
    <section id="voucher" class="section-p1">
        <h2>Tham gia ngay với những ưu đãi đặc biệt</h2>
        <div class="voucher-container">
            <div class="card">
                <img src="./images/voucher1.jpg" alt="">
            </div>
            <div class="card">
                <img src="./images/voucher1.jpg" alt="">
            </div>
            <div class="card">
                <img src="./images/voucher2.jpg" alt="">
            </div>
            <div class="card">
                <img src="./images/voucher2.jpg" alt="">
            </div>
        </div>
    </section>
    <!-- end -->

    <!-- footer -->
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
    <!-- end footer -->

    <script src="./main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        smooth_clicking();

        <?php
        if (isset($_SESSION['username'])) {
            echo "const username = '" . $_SESSION['username'] . "';\ncheckAuthentication(username);";
        }
        ?>
        var slideIndex = 1;
        slide_show();
    </script>

</body>

</html>