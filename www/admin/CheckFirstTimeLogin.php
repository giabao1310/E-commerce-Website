<?php
    session_start();
    if (isset($_SESSION['login_first_time'])) {
        if ($_SESSION['login_first_time'] == 0 && $_SESSION['role'] != 999) {
            header('Location: ../ChangePasswordFirstTime.php');
        }
    }
?>