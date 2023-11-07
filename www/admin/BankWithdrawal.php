<?php
    require './config/ConnectDatabase.php';
    require './Bank.php';
    header('Content-Type: application/json');

    $message = "";
    $code = 1;
    $valid_card = [
        '111111' => ['cvv' => 411, 'prop' => 0, 'expire date' => '10/10/2022'], 
    ];

    $cards_props = [
        '111111' => ['cvv' => 411, 'prop' => 0, 'expire date' => '10/10/2022'], 
        '222222' => ['cvv' => 443, 'prop' => 1, 'expire date' => '11/11/2022'],
        '333333' => ['cvv' => 577, 'prop' => 2, 'expire date' => '12/12/2022']
    ];

    function is_withdraw($id_card, $cvv, $expire_date, $cards_props) {
        global $valid_card;
        return in_array($id_card, array_keys($valid_card)) &&
                valid_cvv($id_card, $cvv, $cards_props) &&
                valid_expire_date($id_card, $expire_date, $cards_props);
    }

    function withdraw($username, $amount, $note) {
        global $connect_sql;
        $total = $amount + (5/100) * $amount;
        $withdraw_sql = "UPDATE ACCOUNT SET BALANCE = BALANCE - ? WHERE USERNAME = ?";
        $stmt = $connect_sql->prepare($withdraw_sql);
        $stmt->bind_param('is',  $total, $username);
        $state = 1;
        if ($amount >= 5000000) {
            $state = 0;
        }

        if (save_transaction($username, -$total, $note, 1, $state)) {
            if ($state != 0) {
                if ($stmt->execute()) {
                    return 1;
                } else {
                    return -1;
                }
            }
        }

        return 0;
    }

    function check_amount($amount) {
        return ($amount % 50000 == 0);
    }


    function is_limit_withdraw($username) {
        global $connect_sql;
        $limit = "select count(*) as time from receipt where username = ? and transaction_type = 1 and DAY(date) = DAY(NOW())";
        $stmt = $connect_sql->prepare($limit);
        $stmt->bind_param('s', $username);
        $stmt->execute();

        $times = $stmt->get_result()->fetch_assoc()['time'];
        return $times;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        global $cards_props;
        $request_body = file_get_contents('php://input');
        $request_json = json_decode($request_body);
        $cards = array_keys($cards_props);
        if (is_null($request_json)) {
            $message = "Chỉ hỗ trợ file JSON";
        } else {
            if (empty($request_json->username)) {
                $message = "Vui lòng đăng nhập để sử dụng chức năng này";
            } else if (empty($request_json->information->id_card) || 
                        empty($request_json->information->cvv) || 
                        empty($request_json->information->amount) ||
                        empty($request_json->information->expire_date)) {
                $message = "Vui lòng nhập đầy đủ thông tin";
            }else {
                $idCard = $request_json->information->id_card;
                $cvv = $request_json->information->cvv;
                $amount = $request_json->information->amount;
                $expireDate = $request_json->information->expire_date;
                $note = $request_json->information->note;
                $username = $request_json->username;

                if (!in_array($idCard, $cards) || !valid_cvv($idCard, $cvv, $cards_props) || !valid_expire_date($idCard, $expireDate, $cards_props)) {
                    $message = 'Thông tin thẻ không hợp lệ';
                } else {
                    if (!is_withdraw($idCard, $cvv, $expireDate, $cards_props)) {
                        $message = "Thẻ không hỗ trợ chức năng rút tiền";
                    } else if (!check_amount($amount)){
                        $message = "Số tiền mỗi lần rút phải là bội số của 50,000";
                    }else {
                        $cur_balance = current_balance($username);
                        if ($amount < $cur_balance) {
                            $withdraw_times = is_limit_withdraw($username);
                            if ($withdraw_times < 2) {
                                $withdraw_state = withdraw($username, $amount, $note);
                                if ($withdraw_state == 1) {
                                    $code = 0;
                                    $message = "Rút tiền thành công";
                                } else if ($withdraw_state == 0) {
                                    $message = "Đã ghi nhận yêu cầu. Chờ xác thực từ quản trị viên";
                                }else {
                                    $message = "Lỗi trong quá trình rút tiền. Vui lòng thử lại";
                                }
                            } else {
                                $message = "Không thể rút tiền do đã rút 2 lần trong ngày";
                            }
                        } else {
                            $message = "Không đủ khả năng chi trả";
                        }
                    }
                }
            }
        }

    } else {
        $message = 'Không hỗ trợ phương thức';
    }
    
    die(json_encode(array('code' => $code, 'message' => $message), JSON_UNESCAPED_UNICODE));
