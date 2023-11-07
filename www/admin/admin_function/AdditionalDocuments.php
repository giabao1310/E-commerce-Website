<?php
    require '../config/ConnectDatabase.php';
    
    header('Content-Type: application/json');

    $status = 0;
    $message = [];
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $sql = "UPDATE ACCOUNT SET STATE = 4 WHERE USERNAME = ?";
        $update_state = $connect_sql->prepare($sql);
        $update_state->bind_param('s', $username);

        if ($update_state->execute()) {
            $code = 1;
            $message = "Cập nhật thành công";
        } else {
            $message = 'Cập nhật không thành công';
        }
    } else {
        $message = "Vui lòng gửi thông tin về username của người dùng";
    }

    $result = ['status' => $status, 'message' => $message];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>