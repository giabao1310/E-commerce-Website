<?php require './admin/TransferInformation.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <link rel="stylesheet" href="./style.css" />

  <link rel="shortcut icon" href="./images/money.ico" type="image/x-icon">
  <title>Transfer Money</title>

</head>

<body>
  <div id="root"></div>
  <section id="header" class="container">
    <a href="#">
      <img src="./images/Silver coin_free-file (1).png" alt="" class="main-logo" />
    </a>
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
            <a class="item-link" href="Product.php">
              Mua hàng trực tuyến
            </a>
            <div class="line"></div>
          </li>
          <li class="navbar-item">
            <a class="item-link" href="#root">
              Chuyển tiền - Nhận tiền
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

  <!-- Form chuyển tiền -->
  <section id="transfer" class="container">
    <form class="transfer-form" method="post" action="./TransferSucces.php">
      <h2>Giao dịch an toàn</h2>
      <ul>
        <label for="FullName">Tên người nhận:</label>
        <?php echo $QueryArray['FullName']; ?>
      </ul>
      <ul>
        <label for="Phone">Số điện thoại:</label>
        <?php echo $QueryArray['Phone']; ?>
      </ul>
      <ul>
        <label for="money">Số tiền:</label>
        <?php echo $money; ?>
      </ul>
      <ul>
        <label for="FeeMoney">Phí chuyển tiền:</label>
        <?php echo $money * 0.05; ?>
      </ul>

      <ul>
        <label for="content">Nội dung:</label>
        <?php echo $content; ?>
      </ul>
      <ul>
        <label for="feer">Vui lòng chọn người chịu phí chuyển tiền:</label>
        <input name="fee" type="radio" value="nguoinhan">Người nhận</br>
        <input name="fee" type="radio" value="nguoigui">Người gửi</br>
      </ul>
      <ul>
        <button type="submit" class="btn1" name="ConfirmTransfer">Chuyển ngay</button>
      </ul>
    </form>
  </section>
  <!-- end form chuyển tiền -->


  <!-- hướng dẫn sử dụng -->
  <section id="guide" class="container">
    <h1>Các bước đơn giản để chuyển tiền cho mọi người</h1>
    <div class="content">
      <div class="guide-box">
        <img src="./images/one.png" alt="" class="img" />
        <div class="contentInside">
          <h3>Đăng nhập vào tài khoản của bạn</h3>
          <p>Trở thành người dùng, nhập số tài khoản bạn muốn chuyển</p>
        </div>
      </div>
      <div class="guide-box">
        <img src="./images/two.png" alt="" class="img" />
        <div class="contentInside">
          <h3>Nhập tên người nhận</h3>
          <p>Nhập liền tay tên "người ấy" của bạn</p>
        </div>
      </div>
      <div class="guide-box">
        <img src="./images/three.png" alt="" class="img" />
        <div class="contentInside">
          <h3>Nhập số tiền và nội dung</h3>
          <p>Gửi cho họ một phong bao đầy ắp hiện kim cùng lời nhắn tốt đẹp và gửi ngay thôi nào</p>
        </div>
      </div>
    </div>
  </section>
  <!-- end hướng dẫn -->


  <!-- Lý do chọn Silver Coin -->
  <section id="reasonToChoose" class="container">
    <h1>Tại sao phải chọn Silver Coin?</h1>
    <h3>Dưới đây là 4 lý do sử dụng Silver Coin sẽ khiến bạn an tâm!</h3>
    <div class="flex-direction">
      <div class="reason-box">
        <img src="./images/Money-transfer.jpg" alt="" class="reaImg">
        <div class="reaContent">
          <p><i class="fa-solid fa-circle-check checked-icon"></i> Phí giao dịch thấp hơn mặt bằng chung</p>
          <p><i class="fa-solid fa-circle-check checked-icon"></i> Dễ sử dụng và kèm theo hướng dẫn bên dưới</p>
          <p><i class="fa-solid fa-circle-check checked-icon"></i> Bảo mật an toàn tuyệt đối</p>
          <p><i class="fa-solid fa-circle-check checked-icon"></i> Hệ thống hỗ trợ khách hàng 24/7</p>
        </div>
      </div>
    </div>
  </section>
  <!-- end lý do -->


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
</body>

</html>