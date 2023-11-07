<?php
    require './config/ConnectDatabase.php';

    session_start();
    if (isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
        if ($_POST['newPassword'] == $_POST['confirmPassword']) {
            $username = $_SESSION['username'];
            
            $getSalt = "SELECT salt FROM PASSWORD_STORAGE WHERE USERNAME=?";
            $stmt = $connect_sql->prepare($getSalt);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $salt = $stmt->get_result()->fetch_assoc()['salt'];
    
            $passHashing = md5($_POST['newPassword'].$salt);
            
            $updatePassword = "UPDATE PASSWORD_STORAGE SET PASSWORD=? WHERE USERNAME=?";
            $updateChangeTimes = "UPDATE ACCOUNT SET NUMOFCHANGEPASS = NUMOFCHANGEPASS + 1 WHERE USERNAME=?";
            $passChange = $connect_sql->prepare($updatePassword);
            $passChange->bind_param('ss', $passHashing, $username);
    
            $passChangeTime = $connect_sql->prepare($updateChangeTimes);
            $passChangeTime->bind_param('s', $username);
    
            $passChangeTime->execute();
            $passChange->execute();
            
            $_SESSION['state'] += 1;
    
            if ($stmt->execute()) {
                $_SESSION['login_first_time'] = 1;
                header("Location: ../index.php");
                die();
            }
        }
    }

    header("Location: ../ChangePasswordFirstTime.php");
?>