<?php session_start();
    require './Mail.php';

    if (isset($_COOKIE['uid'])) {
        if (empty($_SESSION['otp-time'])) {
            $_SESSION['otp-time'] = time();
            $_SESSION['otp-forgot-pass'] = rand(100000, 999999);
            $content = "<p><b>OTP:</b> ". $_SESSION['otp-forgot-pass']. "<br><p style='color: red;'>Thời gian hiệu lực: 1 phút</p></p>";
            if (sendEmail($_SESSION['email'], 'Change password', $content)) {
                header('Location: ChangePassword.php');
                die();
            } else {
                header('Location: ForgotPassword.php');
                die();
            }
        } else {
            if (time() - $_SESSION['otp-time'] >= 60) {
                unset($_SESSION['otp-time']);
                unset($_SESSION['otp-forgot-pass']);
            }
        }
    }

    header('Location: ../index.php');
    die();
?>