<?php 
    require_once './admin/CheckFirstTimeLogin.php';
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
    <title>Thông tin thẻ điện thoại</title>
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
                    <?php include_once './admin/ShowAdminPanel.php'; ?>
                </ul>
            </div>
        </div>

    </section>



    <!-- product -->
    <section id="inforCard" class="section-p1">
        <div class="detail-inforCard">
            <div class="inforCard-box">
                <h3 class="inforCard-title">Thông tin thẻ</h3>
                <div class="inforCard-content">
                    <div>
                        <label>Loại mã thẻ:</label>
                        <label>Mệnh giá thẻ: </label>
                        <label>Số lượng: </label>
                        <label>Mã thẻ: </label>
                    </div>
                    <div class="receipt_detail"></div>
                </div>
                <a href="index.php"> <button>Trở về trang chủ</button> </a>
                <a href=""> <button>Mua tiếp</button> </a>
            </div>

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

    <script src="main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        smooth_clicking();
        show_detail();
        function show_detail() {
            const cards = localStorage.getItem('cards');
            const json_cards = JSON.parse(cards);
            if (json_cards) {
                $('.receipt_detail').append(`
                <p>${json_cards['supply']}</p>
                <p>${json_cards['denom']}</p>
                <p>${json_cards['quantity']}</p>
                <p>${json_cards['cards'].toString()}</p>
                `)
                localStorage.removeItem('cards');
            }
        }
    </script>
</body>

</html>