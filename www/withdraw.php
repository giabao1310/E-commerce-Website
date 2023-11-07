<? require './admin/CheckFirstTimeLogin.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Withdraw</title>
  <?php include_once './admin/lib.php';?>
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
            <a class="item-link-child" href="#root">
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

  <section id="withdraw">
    <h3 class="withdraw-content">Rút tiền</h3>
    <div class="container-withdraw">
      <div class="withdraw-box">
        <label for="fname">Các loại thẻ được chấp nhận</label>
        <div class="icon-container">
          <i class="fa-brands fa-cc-visa" style="color:navy;"></i>
          <i class="fa-brands fa-cc-mastercard" style="color:blue;"></i>
          <i class="fa-brands fa-cc-amex" style="color:red;"></i>
          <i class="fa-brands fa-cc-discover" style="color:orange;"></i>
        </div>
        <div class="withdraw-container">
          <label for="ccnum">Số tài khoản thụ hưởng : </label>
          <input type="text" class="withdraw-input" id="ccnum" name="cardnumber" placeholder="xxxxxx">
          <label for="expmonth">Ngày hết hạn :</label>
          <input type="text" class="withdraw-input" id="expmonth" name="expmonth" placeholder="dd/mm/yyyy">
          <label for="cvv">CVV :</label>
          <input type="text" class="withdraw-input" id="cvv" name="cvv" placeholder="xxxxxx">
          <label for="withdraw-money">Số tiền cần rút :</label>
          <input type="text" class="withdraw-input" id="withdraw-money" name="withdraw-money" placeholder="Số tiền phải là bội 50,000">
          <label for="expyear">Ghi chú :</label>
          <input type="text" class="withdraw-input" id="note" name="note">
          <button id="withdraw_submit"> Xác nhận</button>
        </div>
      </div>

      <div class="withdraw-info">
        <div>
          <h3 class="withdraw-phone">Số điện thoại: </h3>
          <p id="phonenumber">0909099099</p>
          <h3 class="withdraw-money">Số dư tài khoản: </h3>
          <p id="balance">1000000$</p>
        </div>
        <img src="./images/user1.jpg" alt="" class="withdraw-img">
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
    smooth_clicking()

    <?php
    if (isset($_SESSION['username'])) {
      echo 'const username = "' . $_SESSION['username'] . '";';
    } else {
      echo 'const username = "";';
    }
    ?>

    bank_withdraw();
    get_information();
  </script>
</body>

</html>