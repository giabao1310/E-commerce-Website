<?php
    session_start();
    require './admin/config/ConnectDatabase.php';
    if(isset($_POST['confirm'])){
            // Receive username and password from Post method
            $UserName = $_SESSION['username'];
            $PassWord = $_POST['oldPassword'];
            $newPass = $_POST['newPassword'];
            $confirmPass = $_POST['confirmPassword'];
            // query to set salt from db
            $get_salt = "SELECT * FROM `PASSWORD_STORAGE`, `ACCOUNT` WHERE PASSWORD_STORAGE.USERNAME = ACCOUNT.USERNAME AND PASSWORD_STORAGE.USERNAME = '$UserName'";
            $query = $connect_sql->query($get_salt);
            $salt = $query->fetch_assoc();
    
            $password_hashing = md5($PassWord . $salt['salt']);

            $find_password = "SELECT * FROM `password_storage`,`account` WHERE password_storage.username = account.username AND Password = '$password_hashing'";
    
            $query = $connect_sql->query($find_password);
            if ($query->num_rows > 0) {
                if($newPass==$confirmPass){
                    $passHashing = md5($newPass.$salt['salt']);
                    $updatePassword = "UPDATE PASSWORD_STORAGE SET PASSWORD='$passHashing' WHERE USERNAME='$UserName'";
                    $updatePassword = $connect_sql->query($updatePassword);
                    $updateChangeTimes = "UPDATE ACCOUNT SET NUMOFCHANGEPASS = NUMOFCHANGEPASS + 1 WHERE USERNAME='$UserName'";
                    $updateChangeTimes = $connect_sql->query($updateChangeTimes);
                    header("location: ./index.php");
                }
                else{
                    $_SESSION['warning'] = "Mật khẩu mới phải trùng với nhau";
                }
            }
            else{
                $_SESSION['warning'] = "Mật khẩu cũ bị sai";
            }
    }
?>