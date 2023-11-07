<?php session_start();
if (isset($_SESSION['time_block'])) {
    if (time() - $_SESSION['time_block']  >= 60) {
        unset($_SESSION['time_block']);
        unset($_SESSION['login_tmp']);
    }
}

if (isset($_COOKIE['uid'])) {
    header('Location: ./index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once './admin/lib.php'; ?>
    <title>Đăng nhập</title>
</head>

<body>
    <a href="./index.php">
        <img src="./images/Silver coin_free-file (1).png" alt="Logo" class="img-background">
    </a>
    <div class="container-form" style="margin-top: 100px;">
        <h2>Đăng nhập</h2>

        <form method="POST" action="./admin/Login.php">
            <input type="text" name="username" id="username" placeholder="Tên đăng nhập" required>
            <input type="password" name="pass" id="pass" placeholder="Mật khẩu" required>
            <div class="btns">
                <button type="submit">Đăng nhập</button>
                <a href="./registration.php"><button type="button" id="sign-up">Đăng ký</button></a>
            </div>
            <div class="forget" style="text-align: center;">
                <a href="./ForgetPw.html">Quên mật khẩu?</a>
            </div>
        </form>
    </div>
    
    <script src="./main.js"></script>
    <?php
    if (isset($_SESSION['warning'])) {        
        echo "<script>show_toast('".$_SESSION['warning']."');</script>";
        if (!isset($_SESSION['time-block'])) {
            unset($_SESSION['warning']);
        }
    }
    ?>

</body>

</html>