<?php session_start();
    require './admin/config/ConnectDatabase.php';
    require 'Mail.php';
    $phone = $content = "";
    $money = 0;
    $cost = "";
    if(isset($_POST['send'])){
        $phone = $_POST['phoneNumber'];
        $_SESSION['phoneReceiver'] = $phone;
        $money = $_POST['money'];
        $_SESSION['money'] = $money;
        $cost = $_POST['cost'];
        $_SESSION['cost'] = $cost;
        $content = $_POST['content'];
        $_SESSION['content'] = $content;
        $get_information = "SELECT * FROM user WHERE Phone = '$phone'";
        $information = $connect_sql->query($get_information);
        $information = $information->fetch_assoc();
    }
    $OTP = "";
    function send_otp(){
        global $OTP;
        $_SESSION['otp-time'] = time();
        $_SESSION['otp-send-money'] = rand(100000, 999999);
        $OTP = $_SESSION['otp-send-money'];
        $_SESSION['otp'] = $OTP; 
        sendEmail($_SESSION['email'], 'OTP', "OTP: ".$_SESSION['otp-send-money']);
        if (time() - $_SESSION['otp-time'] >= 60) {
            unset($_SESSION['otp-time']);
            unset($_SESSION['otp-send-money']);
        }
    }
    function latest_receipt_id() {
        global $connect_sql;
        $get_latest_id = 'select receipt_id from receipt ORDER by receipt_id DESC limit 1';
        $latest_id = $connect_sql->query($get_latest_id)->fetch_array();
        if (empty($latest_id)) {
            $latest_id = 0;
        } else {
            $latest_id = $latest_id['receipt_id'];
        }
        
        return $latest_id;
    }
    if(isset($_POST['confirm_otp'])){
        $OTP = "";
        $OTP = $_SESSION['otp'];
        if($OTP == $_POST['confirm_otp']){
            $phone = "";
            $phone = $_SESSION['phoneReceiver'];
            $email="";
            $email = $_SESSION['email'];
            $money=0;
            $money = $_SESSION['money'];
            $cost="";
            $cost = $_SESSION['cost'];
            $get_balance = "SELECT account.* FROM account,user WHERE user.Email='$email' and user.UserName = account.Username";
            $balance = $connect_sql->query($get_balance);
            $balance = $balance->fetch_assoc();
            if($cost=="sender"){
                if($balance['balance']>=($money+$money*0.05)){
                    if($money<5000000){
                        $sub_balance = "UPDATE account,user SET account.balance = account.balance-'$money'-'$money'*0.05 WHERE user.Email='$email' and user.UserName = account.Username";
                        $sub_balance = $connect_sql->query($sub_balance);
                        $add_balance = "UPDATE account,user SET account.balance = account.balance+'$money' WHERE user.Phone='$phone' and user.UserName = account.Username";
                        $add_balance = $connect_sql->query($add_balance);
                        $latest_id = (int)str_replace('R', '', latest_receipt_id());
                        $cur_id = $latest_id + 1;
                        $receipt_id = "R".str_pad($cur_id, 4, '0', STR_PAD_LEFT);
                        $usernameSender = $balance['Username'];
                        $content = $_SESSION['content'];
                        $add_receipt = "INSERT INTO receipt(receipt_id,username,date,amount,note,transaction_type,state) VALUES('$receipt_id','$usernameSender',now(),'$money','$content',3,1)";
                        $add_receipt = $connect_sql->query($add_receipt);
                        $get_receiver = "SELECT User.* FROM account,user WHERE user.Phone='$phone' and user.UserName = account.Username";
                        $receiver = $connect_sql->query($get_receiver);
                        $receiver = $receiver->fetch_assoc();
                        sendEmail($receiver['Email'], 'OTP', $receiver['FullName']." Đã chuyển ".$money."cho bạn");
                    }
                    else{
                        $latest_id = (int)str_replace('R', '', latest_receipt_id());
                        $cur_id = $latest_id + 1;
                        $receipt_id = "R".str_pad($cur_id, 4, '0', STR_PAD_LEFT);
                        echo $receipt_id;
                        $usernameSender = $balance['Username'];
                        $content = $_SESSION['content'];
                        $get_receiver = "SELECT account.* FROM account,user WHERE user.Phone='$phone' and user.UserName = account.Username";
                        $receiver = $connect_sql->query($get_receiver);
                        $receiver = $receiver->fetch_assoc();
                        $usernameReceiver = $receiver['Username'];
                        $add_receipt = "INSERT INTO receipt(receipt_id,username,date,amount,note,transaction_type,state) VALUES('$receipt_id','$usernameSender',now(),'$money','$content',3,0)";
                        $add_receipt = $connect_sql->query($add_receipt);
                        $add_transfer_history = "INSERT INTO transfer_history(usernameSender,usernameReceiver,receipt_id) VALUES('$usernameSender','$usernameReceiver','$receipt_id')";
                        $add_transfer_history = $connect_sql->query($add_transfer_history);
                    }

                }
                else{
                    $Warning = "Bạn không đủ tiền trong tài khoản";
                }
            }
            if($cost=="receiver"){
                if($balance['balance']>=$money){
                    if($money<5000000){
                        $sub_balance = "UPDATE account,user SET account.balance = account.balance-'$money' WHERE user.Email='$email' and user.UserName = account.Username";
                        $sub_balance = $connect_sql->query($sub_balance);
                        $add_balance = "UPDATE account,user SET account.balance = account.balance+'$money'- '$money'*0.05 WHERE user.Phone='$phone' and user.UserName = account.Username";
                        $add_balance = $connect_sql->query($add_balance);
                        $latest_id = (int)str_replace('R', '', latest_receipt_id());
                        $cur_id = $latest_id + 1;
                        $receipt_id = "R".str_pad($cur_id, 4, '0', STR_PAD_LEFT);
                        $usernameSender = $balance['Username'];
                        $content = $_SESSION['content'];
                        $add_receipt = "INSERT INTO receipt(receipt_id,username,date,amount,note,transaction_type,state) VALUES('$receipt_id','$usernameSender',now(),'$money','$content',3,1)";
                        $add_receipt = $connect_sql->query($add_receipt);
                        $get_receiver = "SELECT User.* FROM account,user WHERE user.Phone='$phone' and user.UserName = account.Username";
                        $receiver = $connect_sql->query($get_receiver);
                        $receiver = $receiver->fetch_assoc();
                        sendEmail($receiver['Email'], 'OTP', $receiver['FullName']." Đã chuyển ".$money."cho bạn");
                    }
                    else{
                        $latest_id = (int)str_replace('R', '', latest_receipt_id());
                        $cur_id = $latest_id + 1;
                        $receipt_id = "R".str_pad($cur_id, 4, '0', STR_PAD_LEFT);
                        $usernameSender = $balance['Username'];
                        $content = $_SESSION['content'];
                        $get_receiver = "SELECT account.* FROM account,user WHERE user.Phone='$phone' and user.UserName = account.Username";
                        $receiver = $connect_sql->query($get_receiver);
                        $receiver = $receiver->fetch_assoc();
                        $usernameReceiver = $receiver['Username'];
                        $add_receipt = "INSERT INTO receipt(receipt_id,username,date,amount,note,transaction_type,state) VALUES('$receipt_id','$usernameSender',now(),'$money','$content',3,0)";
                        $add_receipt = $connect_sql->query($add_receipt);
                        $add_transfer_history = "INSERT INTO transfer_history(usernameSender,usernameReceiver,receipt_id) VALUES('$usernameSender','$usernameReceiver','$receipt_id')";
                        $add_transfer_history = $connect_sql->query($add_transfer_history);
                    }
                }
                else{
                    $Warning = "Bạn không đủ tiền trong tài khoản";
                }
            }
        }
        else{
            $Warning = "OTP không đúng. Vui lòng nhập OTP mới";
            send_otp();
        }
        unset($_SESSION['phoneReceiver']);
        unset($_SESSION['money']);
        unset($_SESSION['cost']);
        unset($_SESSION['content']);
        if(isset($_SESSION['otp'])){
            unset($_SESSION['otp']);
        }
    }
?>