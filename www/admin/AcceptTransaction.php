<?php
    header('Content-Type: application/json');
    require './config/ConnectDatabase.php';
    require './Bank.php';
    $code = 0;
    $message = 1;

    function get_receipt($transaction_id) {
        global $connect_sql;
        $transaction = 'SELECT * FROM RECEIPT WHERE RECEIPT_ID = ?';
        $stmt = $connect_sql -> prepare($transaction);
        $stmt->bind_param('s', $transaction_id);
        
        if ($stmt -> execute()) {
            return $stmt->get_result()->fetch_assoc();
        }

        return NULL;
    }

    function update_receipt_state($trans_id, $username, $state) {
        global $connect_sql;
        $update_state = "UPDATE RECEIPT SET STATE = ? WHERE RECEIPT_ID = ? AND USERNAME = ?";
        $stmt = $connect_sql->prepare($update_state);
        $stmt->bind_param('iss', $state, $trans_id, $username);

        return $stmt->execute();
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($_POST['trans_id']) || empty($_POST['state'])) {
            $message = "Thiếu thông tin";
        } else {
            $trans_id = $_POST['trans_id'];
            $state = $_POST['state'];
            $transaction = get_receipt($trans_id);
            $username = $transaction['username'];
            $transaction_denominations = $transaction['amount'];
            $user_balance = current_balance($username);

            if ($state == 1 && $user_balance + $transaction_denominations < 0) {
                update_receipt_state($trans_id, $username, 2);
                $message = 'Số tiền trong tài khoản không đủ để thực hiện giao dịch';
            } else {
                $code = 1;
                update_receipt_state($trans_id, $username, 1);
                deduction($username, -$transaction_denominations);
                $message = 'Phê duyệt giao dịch thành công';
            }    
        }
    } else {
        $message = 'Không hỗ trợ phương thức';
    }
    
    die(json_encode(array('code' => $code, 'message' => $message), JSON_UNESCAPED_UNICODE));
?>