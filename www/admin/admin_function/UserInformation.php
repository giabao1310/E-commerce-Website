<?php    
    require '../config/ConnectDatabase.php';
    header('Content-Type: application/json');
    $status = 0;
    $message = [];
    if (!empty($_POST['username'])) {
        if ($_POST['role'] == 999) {
            $user = "SELECT ACCOUNT.USERNAME, ACCOUNT.STATE, 
                    ACCOUNT.BACKIDCARD, ACCOUNT.FONTIDCARD, 
                    USER.FullName
                    FROM ACCOUNT, USER 
                    WHERE ACCOUNT.USERNAME = ?";
            $stmt = $connect_sql->prepare($user);
            $stmt->bind_param('s', $_POST['username']);
            $users = $connect_sql->query($queryAllUsers);
    
            if ($users->num_rows > 0) {
                $status = 1;
                $message = [];
                while ($user = $users->fetch_assoc()) {
                    $eachUser = [
                        'username' => $user['USERNAME'],
                        'backidcard' => $user['BACKIDCARD'],
                        'frontidcard' => $user['FRONTIDCARD'],
                        'fullname' => $user['FullName'],
                        'state' => $user['STATE'],
                        'datetime' => $user['DATE'],
                    ];
        
                    $message[] =  $eachUser;
                }
            } else {
                $status = 2;
                $message = "Không tìm thấy người dùng";
            }
        } else {
            $message = "Bạn phải là QTV mới sử dụng được API này";    
        }
    } else {
        $message = "Vui lòng đăng nhập để sử dụng";
    }

    $result = ['status' => $status, 'message' => $message];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
