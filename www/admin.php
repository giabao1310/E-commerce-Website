<?php
    include './admin/config/only_admin.php';
    include_once './admin/config/CheckLogin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once './admin/lib.php'; ?>
    <title>User List</title>

</head>

<body>
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
    <div class="container-detail">
        <!-- detail này sẽ css flex direction: column để xuống hàng danh sách, chỉ có 2 danh sách mỗi hàng -->
        <div class="detail-userList">
            <!-- box này để flex direction: row cho 2 danh sách tài khoản chung 1 hàng -->
            <div class="box">
                <div class="userList-box">
                    <h3 class="userList-title">Danh sách tài khoản đang chờ kích hoạt</h3>
                    <div class="userList-header">
                        <h4>Thời gian tạo</h4>
                        <h4>Tài khoản</h4>
                        <!-- mới tạo hoặc mới bổ sung CMND -->
                        <h4>Trạng thái</h4>
                    </div>
                    <div class="userList-list" id="user_inactivate">
                        <div class="userList-item">
                            <div class="userList-time">
                                <span>14/2/2022 20:00 p.m <time datetime="2022-02-14 20:00"></time></span>
                            </div>
                            <div class="userList-account">
                                <img src="./images/user1.jpg" style="width:50px; border-radius: 50%;">
                                <span>Phạm Quốc Anh</span><br>
                            </div>
                            <div class="userList-status">
                                <span>Mới bổ sung CMND</span>
                            </div>
                        </div>

                        <div class="userList-item">
                            <div class="userList-time">
                                <span>14/2/2022 20:00 p.m <time datetime="2022-02-14 20:00"></time></span>
                            </div>
                            <div class="userList-account">
                                <img src="./images/user1.jpg" style="width:50px; border-radius: 50%;">
                                <span>Nguyễn Văn A</span><br>
                            </div>
                            <div class="userList-status">
                                <span>Mới bổ sung CMND</span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="userList-box">
                    <h4 class="userList-title">Danh sách tài khoản đã kích hoạt</h4>
                    <div class="userList-header">
                        <h4>Thời gian tạo</h4>
                        <h4>Tài khoản</h4>
                        <h4>Trạng thái</h4>
                    </div>
                    <div class="userList-list" id="user_activated">
                        <div class="userList-item">
                            <div class="userList-time">
                                <span>14/2/2022 20:00 p.m <time datetime="2022-02-14 20:00"></time></span>
                            </div>
                            <div class="userList-account">
                                <img src="./images/user1.jpg" style="width:50px; border-radius: 50%;">
                                <span>Lương Gia Bảo</span><br>
                            </div>
                            <div class="userList-status">
                                <span>Đã kích hoạt</span>
                            </div>
                        </div>

                        <div class="userList-item">
                            <div class="userList-time">
                                <span>14/2/2022 20:00 p.m <time datetime="2022-02-14 20:00"></time></span>
                            </div>
                            <div class="userList-account">
                                <img src="./images/user1.jpg" style="width:50px; border-radius: 50%;">
                                <span>Lương Gia Bảo</span><br>
                            </div>
                            <div class="userList-status">
                                <span>Đã kích hoạt</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- box này để flex direction: row cho 2 danh sách tài khoản chung 1 hàng -->
            <div class="box">
                <div class="userList-box">
                    <h4 class="userList-title">Danh sách tài khoản đã bị vô hiệu hóa</h4>
                    <div class="userList-header">
                        <h4>Thời gian tạo</h4>
                        <h4>Tài khoản</h4>
                        <h4>Trạng thái</h4>
                    </div>
                    <div class="userList-list" id="user_disabled">
                        <div class="userList-item">
                            <div class="userList-time">
                                <span>14/2/2022 20:00 p.m <time datetime="2022-02-14 20:00"></time></span>
                            </div>
                            <div class="userList-account">
                                <img src="./images/user1.jpg" style="width:50px; border-radius: 50%;">
                                <span>Lương Gia Bảo</span><br>
                            </div>
                            <div class="userList-status">
                                <span>Vô hiệu hóa</span>
                            </div>
                        </div>

                        <div class="userList-item">
                            <div class="userList-time">
                                <span>14/2/2022 20:00 p.m <time datetime="2022-02-14 20:00"></time></span>
                            </div>
                            <div class="userList-account">
                                <img src="./images/user1.jpg" style="width:50px; border-radius: 50%;">
                                <span>Lương Gia Bảo</span><br>
                            </div>
                            <div class="userList-status">
                                <span>Vô hiệu hóa</span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="userList-box">
                    <h4 class="userList-title">Danh sách tài khoản đang bị khóa vô thời hạn</h4>
                    <div class="userList-header">
                        <h4>Thời gian tạo</h4>
                        <h4>Tài khoản</h4>
                        <h4>Trạng thái</h4>
                    </div>
                    <div class="userList-list" id="user_locked">
                        <div class="userList-item">
                            <div class="userList-time">
                                <span>14/2/2022 20:00 p.m <time datetime="2022-02-14 20:00"></time></span>
                            </div>
                            <div class="userList-account">
                                <img src="./images/user1.jpg" style="width:50px; border-radius: 50%;">
                                <span>Lương Gia Bảo</span><br>
                            </div>
                            <div class="userList-status">
                                <span>Khóa vô thời hạn</span>
                            </div>
                        </div>

                        <div class="userList-item">
                            <div class="userList-time">
                                <span>14/2/2022 20:00 p.m <time datetime="2022-02-14 20:00"></time></span>
                            </div>
                            <div class="userList-account">
                                <img src="./images/user1.jpg" style="width:50px; border-radius: 50%;">
                                <span>Lương Gia Bảo</span><br>
                            </div>
                            <div class="userList-status">
                                <span>Khóa vô thời hạn</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <script>
        <?php echo "const role = '" . $_SESSION['role'] . "';"; ?>
        inactivateUser(role);
        activatedUser(role);
        disabledUser(role);
        lockedUser(role);

        $(document).on('click', '.userList-item', (profile) => {
            const user_id = $(profile.target).closest('.userList-item').attr('id');
            window.location.href = `/profile.php?user=${user_id}`;
        })
    </script>
</body>

</html>