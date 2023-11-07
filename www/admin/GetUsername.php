<?php
    require './config/ConnectDatabase.php';
    header('Content-Type: application/json');
    if(!empty($_GET['username'])) {
        $username = $_GET['username'];
        $get_user_information = "SELECT * FROM `ACCOUNT`, `USER` WHERE ACCOUNT.USERNAME = USER.USERNAME AND ACCOUNT.USERNAME = ?";
        $stmt = $connect_sql->prepare($get_user_information);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $information = $stmt->get_result()->fetch_assoc();
        $response[]= [
                        'FullName'=>$information['FullName'], 
                        'Phone'=>$information['Phone'], 
                        'Birthday'=>$information['Birthday'], 
                        'Email'=>$information['Email'],
                        'balance'=> number_format($information['balance']).' VND',
                        'state'=>$information['state'], 
                        'frontIdCard'=>$information['FrontIDCard'], 
                        'backIdCard'=>$information['BackIdCard'],
                        'username'=>$information['Username'],
                    ];

        echo json_encode($response);
    } else if(!empty($_GET['token'])) {
        $token = $_GET['token'];
        $get_user_information = "SELECT * FROM `ACCOUNT`, `USER` WHERE ACCOUNT.USERNAME = USER.USERNAME AND ACCOUNT.TOKEN = ?";
        $stmt = $connect_sql->prepare($get_user_information);
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $information = $stmt->get_result()->fetch_assoc();
        $response[]= [
                        'FullName'=>$information['FullName'], 
                        'Phone'=>$information['Phone'], 
                        'Birthday'=>$information['Birthday'], 
                        'Email'=>$information['Email'],
                        'balance'=> number_format($information['balance']).' VND',
                        'state'=>$information['state'], 
                    ];

        echo json_encode($response);
    }
?>
