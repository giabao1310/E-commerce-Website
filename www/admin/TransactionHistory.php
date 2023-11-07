<?
    require './config/ConnectDatabase.php';
    header('Content-Type: application/json');
    $code = 1;
    $message = 0;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($_POST['username'])) {
            $message = 'Vui lòng cung cấp username';
        } else {
            $username = $_POST['username'];
            $transaction_sql = "SELECT * FROM RECEIPT WHERE USERNAME = ?";
            $stmt = $connect_sql->prepare($transaction_sql);
            $stmt->bind_param('s', $username);
            if ($stmt->execute()) {
                $trans = $stmt->get_result();
                $result = [];
                while (($data = $trans->fetch_assoc()) != null) {
                    $result[] = $data;
                }

                if (count($result) != 0) {
                    $message = $result;
                } else {
                    $message = "Không có thông tin lịch sử giao dịch";
                }
            } else {
                $message = "Lỗi trong quá trình lấy thông tin";
            }
        }

    } else {
        $message = "Không hỗ trợ phương thức";
    }

    die(json_encode(array('code' => $code, 'message' => $message), JSON_UNESCAPED_UNICODE));
?>