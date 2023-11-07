<?php
session_start();
if (empty($_COOKIE['uid'])) {
    header('Location: ./index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="./style.css" />

    <link rel="shortcut icon" href="./images/product.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Product</title>
    <script src="./main.js" defer></script>
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
                        <a class="item-link" href="#root">
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



    <!-- product -->
    <section id="product" class="section-p1">
        <div>
            <div action="" id="buy_card">
                <h2 class="title-product">Chọn nhà cung cấp</h2>
                <div class="product-container">
                    <label>
                        <input type="radio" class="card-select" name="typecard" value="mobifone">
                        <img class="card" src="./images/mobifone.jpg" id="image">
                    </label>
                    <label>
                        <input type="radio" class="card-select" name="typecard" value="viettel">
                        <img class="card" src="./images/viettel.png" id="image">
                    </label>
                    <label>
                        <input type="radio" class="card-select" name="typecard" value="vinaphone">
                        <img class="card" src="./images/vinaphone.jpg" id="image">
                    </label>
                </div>
                <h2 class="title-product">Chọn mệnh giá</h2>
                <div class="product-container">
                    <!-- thẻ điện thoại 10.000 -->
                    <label>
                        <input type="radio" id="10k" name="current" value="10000">
                        <div class="product-detail">
                            <h4>10.000đ</h4>
                            <span>Đã bán: 863</span>
                        </div>
                    </label>

                    <label>
                        <input type="radio" id="20k" name="current" value="20000">
                        <div class="product-detail">
                            <h4>20.000đ</h4>
                            <span>Đã bán: 863</span>
                        </div>
                    </label>

                    <label>
                        <input type="radio" id="50k" name="current" value="50000">
                        <div class="product-detail">
                            <h4>50.000đ</h4>
                            <span>Đã bán: 863</span>
                        </div>
                    </label>

                    <label>
                        <input type="radio" id="100k" name="current" value="100000">
                        <div class="product-detail">
                            <h4>100.000đ</h4>
                            <span>Đã bán: 863</span>
                        </div>
                    </label>

                    <label>
                        <input type="radio" id="200k" name="current" value="200000">
                        <div class="product-detail">
                            <h4>200.000đ</h4>
                            <span>Đã bán: 863</span>
                        </div>
                    </label>

                    <label>
                        <input type="radio" id="500k" name="current" value="500000">
                        <div class="product-detail">
                            <h4>500.000đ</h4>
                            <span>Đã bán: 863</span>
                        </div>
                    </label>

                    <label style="margin-left: 30px;">Số lượng: </label>
                    <input type="number" name="quantity" min="1" max="5" class="count-product">
                    <button class="confirm-btn"> Thanh toán</button>
                </div>
            </div>
            <h2 class="title-product"></h2>
        </div>
    </section>
    <!-- end product-->


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

        buy_card();
    </script>
</body>

</html>