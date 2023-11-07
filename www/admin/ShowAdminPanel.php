<?php
if (isset($_COOKIE['uid'])) {
    if (isset($_SESSION['role'])) {
      if ($_SESSION['role'] == 999) {
        echo '<li class="subnav-item"><a class="subnav-link" href="./admin.php">Quản trị viên</a></li>';
      }
    }

    echo '
        <li class="subnav-item"><a class="subnav-link" href="Info.php">Thông tin</a></li>
        <li class="subnav-item"><a class="subnav-link" href="history.php">Lịch sử giao dịch</a></li>
        <li class="subnav-item"><a class="subnav-link" href="./changepassword.php">Đổi mật khẩu</a></li>
        <li class="subnav-item"><a class="subnav-link" href="./admin/logout.php">Đăng xuất</a></li>
    ';
  } else {
    echo '<li class="subnav-item"><a class="subnav-link" href="login.php">Đăng nhập</a></li>';
    echo '<li class="subnav-item"><a class="subnav-link" href="registration.php">Đăng ký</a></li>';
  }
?>