<?php session_start();
    if(isset($_SESSION['role'])) {
        $admin_role = 999;
        if ($_SESSION['role'] != $admin_role) {
            header('Location: ../../index.php');
            die();
        }
    } else {
        header('Location: ../../index.php');
        die();
    }
?>