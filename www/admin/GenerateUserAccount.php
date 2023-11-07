<?php
    require_once './config/ConnectDatabase.php';
    function generateRandomPassword($password_len = 6) {
        return substr(str_shuffle(
                str_repeat($string_sample='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*|', 
                        ceil($password_len/strlen($string_sample)) 
                )
        ), 1, $password_len);
    }

    function generateRandomUsername($username_len = 10) {
        return substr(str_shuffle(
                str_repeat($string_sample='0123456789', 
                        ceil($username_len/strlen($string_sample)) 
                )
        ), 1, $username_len);
    } 
    
    function generateUsername() {
        global $connect_sql;
        $randomUserName = generateRandomUsername();
        $sql = "SELECT * FROM `account` WHERE `UserName` LIKE '$randomUserName'";
        $query = mysqli_query($connect_sql, $sql);
        
        while(mysqli_num_rows($query) > 0){
            $randomUserName = generateRandomUsername();
        }

        return $randomUserName;
    }

    function checkEmail($Email) {
        global $connect_sql;
        $sql = "SELECT * FROM `user` WHERE '$Email' = `Email`";
        $query = mysqli_query($connect_sql, $sql);
        if(mysqli_num_rows($query) > 0){
            return False;
        }
        return True; 
    }

    function checkPhone($Phone) {
        global $connect_sql;
        $sql = "SELECT * FROM `user` WHERE '$Phone' = `Phone`";
        $query = mysqli_query($connect_sql, $sql);
        if(mysqli_num_rows($query) > 0){
            return False;
        }
        return True; 
    }
?>