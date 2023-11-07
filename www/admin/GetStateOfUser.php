<?php
    require './config/ConnectDatabase.php';
    
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $get_state = "SELECT state FROM ACCOUNT WHERE USERNAME = ?";
        $stmt = $connect_sql->prepare($get_state);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $state = $stmt->get_result()->fetch_assoc()['state'];        
        echo json_encode($state);
    }
?>