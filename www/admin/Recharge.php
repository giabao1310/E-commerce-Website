<?php session_start();
    require './config/ConnectDatabase.php';
    require './Bank.php';
    header('Content-Type: application/json');

    $cards_props = [
        '111111' => ['cvv' => 411, 'prop' => 0, 'expire date' => '10/10/2022'], 
        '222222' => ['cvv' => 443, 'prop' => 1, 'expire date' => '11/11/2022'],
        '333333' => ['cvv' => 577, 'prop' => 2, 'expire date' => '12/12/2022']
    ];

    $message = "";
    $code = 1;

    function charge($username, $amount) {
        global $connect_sql;
        $charge_sql = "UPDATE ACCOUNT SET BALANCE = BALANCE + ? WHERE USERNAME = ?";
        $stmt = $connect_sql->prepare($charge_sql);
        $stmt->bind_param('is', $amount, $username);
        if (save_transaction($username, $amount, 'Nạp tiền vào tài khoản', 0, 1)) {
            return $stmt->execute();
        }
        return false;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $request_body = file_get_contents('php://input');
        $request_json = json_decode($request_body)[0];
        $cards = array_keys($cards_props);
        
        if (empty($_SESSION['username'])) {
            $message = "Vui lòng đăng nhập để sử dụng chức năng này";
        } else {
            if (is_null($request_json)) {
                $message = "Chỉ hỗ trợ file JSON";
            } else if (empty($request_json->id_card) || 
                        empty($request_json->cvv) || 
                        empty($request_json->amount) ||
                        empty($request_json->expire_date)) {
                $message = "Vui lòng nhập đầy đủ thông tin";
            }else {
                $idCard = $request_json->id_card;
                $cvv = $request_json->cvv;
                $amount = $request_json->amount;
                $expireDate = $request_json->expire_date;
                $username = $_SESSION['username'];

                if (!in_array($idCard, $cards)) {
                    $message = 'Không có thông tin về thẻ trong hệ thống';
                } else if (!valid_cvv($idCard, $cvv, $cards_props)) {
                    $message = 'Sai thông tin mã số cvv';
                } else if (!valid_expire_date($idCard, $expireDate, $cards_props)) {
                    $message = 'Sai ngày hết hạn thẻ';
                } else {
                    $valid = true;
                    if ($idCard == '222222' && $cvv == '443') {
                        if ($amount > 1000000) {
                            $message = 'Vượt quá hạn mức';
                            $valid = false;
                        }
                    }
                    
                    if ($idCard == '333333' && $cvv == '577') {
                        $message = 'Thẻ không đủ khả năng chi trả';
                        $valid = false;
                    }
                    
                    if ($valid) {
                        $success = true;
                        if (charge($username, $amount)) {
                            $code = 0;
                            $message = 'Nạp tiền thành công';
                        } else {
                            $message = 'Đã xảy ra lỗi trong quá trình nạp tiền';
                        }
                    }
                }
            }
        }

    } else {
        $message = 'Không hỗ trợ phương thức';
    }
    
    die(json_encode(array('code' => $code, 'message' => $message), JSON_UNESCAPED_UNICODE));
?>
