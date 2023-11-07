<?php
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

    function save_transaction($username, $amount, $note, $type, $state) {
        global $connect_sql;
        $save_trans = "INSERT INTO receipt VALUES (?, ?, ?, ?, ?, ?, ?)";
        $latest_id = (int)str_replace('R', '', latest_receipt_id());
        $cur_id = $latest_id + 1;
        $receipt_id = "R".str_pad($cur_id, 4, '0', STR_PAD_LEFT);

        $stmt = $connect_sql->prepare($save_trans);
        $date = date('y-m-d h:i:s');
        $stmt->bind_param('sssisii', $receipt_id, $username, $date, $amount, $note, $type, $state);
        return $stmt->execute();
    }

    function valid_cvv($id_card, $cvv, $cards_props) {
        $valid = true;
        try {
            if (!empty($cards_props[$id_card])) {
                $valid = $cards_props[$id_card]['cvv'] == $cvv;
            } else {
                $valid = false;
            }
        } catch (Exception $e) {
            $valid = false;
        } finally {
            return $valid;
        }
    }

    function valid_expire_date($id_card, $date, $cards_props) {
        $valid = true;
        try {
            if (!empty($cards_props[$id_card])) {
                $valid = $cards_props[$id_card]['expire date'] == $date;
            } else {
                $valid = false;
            }
        } catch (Exception $e) {
            $valid = false;
        } finally {
            return $valid;
        }
    }

    function current_balance($username) {
        global $connect_sql;
        $get_balance = "SELECT BALANCE FROM ACCOUNT WHERE USERNAME = ?";
        $stmt = $connect_sql -> prepare($get_balance);
        $stmt->bind_param('s', $username);

        if ($stmt->execute()) {
            return $stmt->get_result()->fetch_assoc()['BALANCE'];
        } else {
            return -9999;
        }
    }

    function deduction($username, $total) {
        global $connect_sql;
        $deduction_sql = "UPDATE ACCOUNT SET BALANCE = BALANCE - ? WHERE USERNAME = ?";
        $stmt = $connect_sql->prepare($deduction_sql);
        $stmt->bind_param('is', $total, $username);

        return $stmt->execute();
    }
?>