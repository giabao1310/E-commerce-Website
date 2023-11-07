<?php
session_start();
require './config/ConnectDatabase.php';

if (empty($_SESSION['login_tmp'])) {
    $_SESSION['login_tmp'] = 0;
}
$UserName = "";
$PassWord = "";
$username = "";
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    if (!empty($_SESSION['time_block_' . $username])) {
        if (time() - $_SESSION['time_block_' . $username]  >= 60) {
            unset($_SESSION['time_block_' . $username]);
            unset($_SESSION['login_tmp']);
        } else {
            $_SESSION['warning'] = 'Tài khoản hiện đang bị tạm khóa, vui lòng thử lại sau 1 phút';
            header("Location: ../login.php");
        }
    } else {
        if (get_abnormal($username) == 2) {
            $_SESSION['warning'] = 'Tài khoản đã bị vô hiệu hóa, vui lòng liên hệ admin để mở lại';
            header("Location: ../login.php");
        } else {
            // Receive username and password from Post method
            $UserName = $_POST['username'];
            $PassWord = $_POST['pass'];

            $find_username = "SELECT * FROM `account` WHERE Username = '$UserName'";
            $query = $connect_sql->query($find_username);

            if ($query->num_rows > 0) {
                // query to set salt from db
                $get_salt = "SELECT * FROM `PASSWORD_STORAGE`, `ACCOUNT` WHERE PASSWORD_STORAGE.USERNAME = ACCOUNT.USERNAME AND PASSWORD_STORAGE.USERNAME = '$UserName'";

                $query = $connect_sql->query($get_salt);
                $salt = $query->fetch_assoc();

                $update_abnormal = "UPDATE account set abnormal = 0 WHERE username = '$UserName'";
                $query = $connect_sql->query($update_abnormal);

                // use md5 to hashing password
                $password_hashing = md5($PassWord . $salt['salt']);

                $find_password = "SELECT * FROM `password_storage`,`account` WHERE password_storage.username = account.username AND Password = '$password_hashing'";

                $query = $connect_sql->query($find_password);
                $QueryArray = $query->fetch_assoc();

                if ($query->num_rows > 0) {

                    $updateAbnormal = "UPDATE ACCOUNT SET ABNORMAL=0 WHERE USERNAME=?";
                    $updAbnormal = $connect_sql->prepare($updateAbnormal);
                    $updAbnormal->bind_param('s', $UserName);
                    $updAbnormal->execute();

                    $getInformation = "SELECT ACCOUNT.username, USER.email, ACCOUNT.state, ACCOUNT.NumOfChangePass FROM ACCOUNT, USER WHERE ACCOUNT.USERNAME = USER.USERNAME AND USER.USERNAME=?";
                    $stmt = $connect_sql->prepare($getInformation);
                    $stmt->bind_param('s', $UserName);
                    $stmt->execute();
                    $info = $stmt->get_result()->fetch_assoc();

                    // cookie
                    $token = $QueryArray['Token'];
                    setcookie("uid", $token, time() + 3600, "/");
                    $role = $connect_sql->query("SELECT role FROM ROLES WHERE TOKEN='$token'")->fetch_assoc()['role'];

                    $_SESSION['username'] = $info['username'];
                    $_SESSION['email'] = $info['email'];
                    $_SESSION['state'] = $info['state'];
                    $_SESSION['role'] = $role;
                    $_SESSION['login_first_time'] = $info['NumOfChangePass'];

                    header('location:../index.php');
                } else {
                    if ($_SESSION['login_tmp'] == 2 && empty($_SESSION['time_block_' . $username])) {
                        $update_abnormal = "UPDATE account set abnormal = abnormal + 1 WHERE username = '$UserName'";
                        $query = $connect_sql->query($update_abnormal);
                        $_SESSION['time_block_' . $username] = time();
                    } else {
                        $_SESSION['login_tmp'] += 1;
                    }

                    header("Location: ../login.php");
                }
            } else {
                $_SESSION['warning'] = 'Sai tài khoản hoặc mật khẩu';
                header("Location: ../login.php");
            }
        }
    }    
}

function get_abnormal($username)
{
    global $connect_sql;
    $get_abnormal = "SELECT ABNORMAL FROM ACCOUNT WHERE USERNAME = ?";
    $stmt = $connect_sql->prepare($get_abnormal);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $user_abnormal = $stmt->get_result()->fetch_assoc();
    return $user_abnormal['ABNORMAL'];
}
