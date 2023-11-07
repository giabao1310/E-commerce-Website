<?php    
    require '../config/ConnectDatabase.php';
    header('Content-Type: application/json');
    $status = 0;
    $message = [];
    if (!empty($_POST['role'])) {
        if ($_POST['role'] == 999) {
            $queryAllUsers = "SELECT ACCOUNT.USERNAME, ACCOUNT.DATE, ACCOUNT.STATE, USER.FullName
                                FROM ACCOUNT, USER 
                                WHERE ACCOUNT.USERNAME = USER.USERNAME
                                AND STATE = 2
                                AND ACCOUNT.USERNAME != 'ADMIN'
                                ORDER BY ACCOUNT.DATE DESC";
            $users = $connect_sql->query($queryAllUsers);
    
            if ($users->num_rows > 0) {
                $status = 1;
                $message = [];
                while ($user = $users->fetch_assoc()) {
                    $eachUser = [
                        'username' => $user['USERNAME'],
                        'fullname' => $user['FullName'],
                        'state' => $user['STATE'],
                        'datetime' => $user['DATE'],
                    ];
        
                    $message[] =  $eachUser;
                }
            } else {
                $status = 2;
                $message = "Không có người dùng bị vô hiệu hóa";
            }
        } else {
            $message = "Bạn phải là QTV mới sử dụng được API này";    
        }
    } else {
        $message = "Vui lòng đăng nhập để sử dụng";
    }

    $result = ['status' => $status, 'message' => $message];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
