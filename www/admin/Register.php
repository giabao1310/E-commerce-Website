<?php session_start();
    require './Mail.php';
    require './config/ConnectDatabase.php';
    require './GenerateUserAccount.php';

    $Phone="";
    $Email="";
    $FullName="";
    $UserName = generateUsername();
    $Password = generateRandomPassword();
    $BirthDay="";
    $Address="";
    $FrontIdCard="";
    $BackIdCard="";
    $NumberChangePass=0;

    if(isset($_POST['phone'])){
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['email'] = $_POST['email'];
        $Phone = $_POST['phone'];
        $Email = $_POST['email'];
        $FullName = $_POST['fullname'];
        $BirthDay = $_POST['datetime'];
        $Address = $_POST['address'];

        if(checkEmail($Email, $connect_sql) && checkPhone($Phone, $connect_sql)){
            if (isset($_FILES['upload_image1']) && isset($_FILES['upload_image2'])) {
                // store id card
                if ($_FILES['upload_image1']['error'] == 0 && $_FILES['upload_image2']['error'] == 0)
                    mkdir("./UserIDCard/".$UserName, 0777);
                    $ElementFrontIdCard = explode('.',$_FILES['upload_image1']['name']);
                    $FrontIdCard=$UserName.'Font.'.$ElementFrontIdCard[sizeof($ElementFrontIdCard)-1];
                    $ElementBackIdCard = explode('.',$_FILES['upload_image2']['name']);
                    $BackIdCard=$UserName.'Back.'.$ElementBackIdCard[sizeof($ElementBackIdCard)-1];
                    move_uploaded_file($_FILES['upload_image1']['tmp_name'], './UserIDCard/'.$UserName.'/' . $FrontIdCard);
                    move_uploaded_file($_FILES['upload_image2']['tmp_name'], './UserIDCard/'.$UserName.'/' . $BackIdCard);
                }
            }

        // insert user account into table account
        $token = md5("$Phone-$Email-$UserName");
        $insert_account = "INSERT INTO account(Username, FrontIdCard, BackIdCard, NumOfChangePass, token, date) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connect_sql->prepare($insert_account);
        $date_create = date('y-m-d h:i:s');
        $stmt->bind_param('sssiss', $UserName, $FrontIdCard, $BackIdCard, $NumberChangePass, $token, $date_create);
        $stmt->execute();


        $salt = generateRandomPassword(10); // generate random salt
        $password = md5($Password.$salt);
        $insert_password = "INSERT INTO PASSWORD_STORAGE VALUES (?, ?, ?)";
        $stmt = $connect_sql->prepare($insert_password);
        $stmt->bind_param('sss', $UserName, $password, $salt);
        $stmt->execute();
        
        $insert_user_info = "INSERT INTO user(UserName,Phone,Email,FullName,Birthday,Address) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connect_sql->prepare($insert_user_info);
        $stmt->bind_param('ssssss', $UserName,$Phone,$Email, $FullName, $BirthDay, $Address);
        $stmt->execute();
        
        $insert_role = "INSERT INTO ROLES VALUES (?, 0)";
        $stmt = $connect_sql->prepare($insert_role);
        $stmt->bind_param('s', $token);
        $stmt->execute();

        sendEmail($Email, 'Email and Password', "Username: ".$UserName." <br/>Password: ".$Password);
        header('Location: ../login.php');
    }
