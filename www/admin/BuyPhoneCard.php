<?php
require './config/ConnectDatabase.php';
require './Bank.php';
header('Content-Type: application/json');
$code = 1;
$message = "";
$phone_cards_props = [
    'viettel' => "11111",
    'mobifone' => "22222",
    'vinaphone' => "33333"
];

function valid_supplier($name)
{
    global $phone_cards_props;
    $suppliers = array_keys($phone_cards_props);
    return in_array($name, $suppliers);
}

function total_phone_cards($cards)
{
    $count = 0;
    foreach ($cards as $card) {
        $count += $card->quantity;
    }

    return $count;
}

function generate_phone_card($supplier_name)
{
    global $phone_cards_props;
    return $phone_cards_props[strtolower($supplier_name)] . rand(10000, 99999);
}

function generate_cards($name, $amount)
{
    $cards = [];
    for ($i = 0; $i < $amount; $i++) {
        $cards[] = generate_phone_card($name);
    }

    return $cards;
}

function save_record($trans_id, $cards, $services_fee)
{
    global $connect_sql;
    $save_trans = "INSERT INTO PHONECARD_TRANSACTION VALUES (?, ?, ?)";
    $stmt = $connect_sql->prepare($save_trans);

    foreach ($cards as $index => $cards_sup) {
        foreach ($cards_sup as $card) {
            $stmt->bind_param('ssi', $trans_id, $card, $services_fee);
            if (!$stmt->execute()) {
                return false;
            }
        }
    }

    return true;
}

function create_receipt($username, $amount)
{
    global $connect_sql;
    $latest_id = (int)str_replace('R', '', latest_receipt_id());
    $cur_id = $latest_id + 1;
    $receipt_id = "R" . str_pad($cur_id, 4, '0', STR_PAD_LEFT);

    $sql = "INSERT INTO RECEIPT VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connect_sql->prepare($sql);

    $date = date('y-m-d h:i:s');
    $note = "Mua thẻ điện thoại";
    $type = 2;
    $state = 1;
    $stmt->bind_param('sssisii', $receipt_id, $username, $date, $amount, $note, $type, $state);

    if ($stmt->execute()) {
        return $receipt_id;
    }

    return "";
}

function total($cards)
{
    $total = 0;
    foreach ($cards as $index => $card) {
        $total += $card->denominations * $card->quantity;
    }

    return $total;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request_body = file_get_contents('php://input');
    $request_json = json_decode($request_body);

    if (is_null($request_json)) {
        $message = "Chỉ hỗ trợ file JSON";
    } else {
        if (empty($request_json->username)) {
            $message = "Vui lòng đăng nhập để sử dụng chức năng này";
        } else if (empty($request_json->cards)) {
            $message = "Vui lòng nhập đầy đủ thông tin";
        } else if (total_phone_cards($request_json->cards) > 5 || total_phone_cards($request_json->cards) <= 0) {
            $message = "Số lượng không phù hợp.";
        } else {
            $username = $request_json->username;
            $cards = [];
            $code = 0;
            $data = $request_json->cards;
            $total = total($request_json->cards);
            $curr_balance = current_balance($username);

            if ($total < $curr_balance) {
                foreach ($data as $index => $card) {
                    $cards[] = generate_cards($card->phone_supplier, $card->quantity);
                }
                $trans_id = create_receipt($username, $total);
                if (save_record($trans_id, $cards, 0)) {
                    if (deduction($username, $total)) {
                        $code = 0;
                        $message = $cards;
                    } else {
                        $message = 'Lỗi không thể mua thẻ';
                    }
                } else {
                    $message = "Lỗi trong quá trình mua thẻ điện thoại. Vui lòng thử lại";
                }
            } else {
                $message = "Không đủ khả năng chi trả";
            }
        }
    }
} else {
    $message = "Không hỗ trợ phương thức";
}

die(json_encode(array('code' => $code, 'message' => $message), JSON_UNESCAPED_UNICODE));
