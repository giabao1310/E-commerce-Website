<?php
    include './admin/TransferInformation.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="./style.css" />

    <link rel="shortcut icon" href="./images/money.ico" type="image/x-icon">
    <title>Transfer Money</title>

</head>
<body>
    <div class="container-detail">
        <div class="detail-pay">
            <div class="line-info">
                <div class="box-point">
                    <a class="point-1" href="transfer.php"></a>      
                    <h5 class="detail-text">Giao dịch</h5>
                </div>

                <div class="line-detail-1"></div>

                <div class="box-point">
                    <div class="point-2 checked"></div> 
                    <h5 class="detail-text">Kiểm tra thông tin</h5>
                </div>

                <div class="line-detail-2"></div>

                <div class="box-point">
                    <div class="point-3"></div> 
                    <h5 class="detail-text">Xác nhận</h5>
                </div>

            </div>
            <div class="detail-receipt">
                <div class="detail-box">
                    <div class="form-detail">
                        <?php if(isset($Warning)){echo $Warning;}?>
                        <div>
                            <h4 class="fname">Họ và tên:</h4>
                            <span class="dname-user"><?php if(isset($information['FullName'])) {echo $information['FullName'];}?></span>
                        </div>
                        <div>
                            <h4 class="phone">Số điện thoại đăng ký:</h4>
                            <span class="dphone-user"><?php if(isset($information['Phone'])) {echo $information['Phone'];}?></span>
                        </div>
                        <div>
                            <h4 class="money">Số tiền gửi:</h4>
                            <span class="receipt-money"><?php if(isset($money)) {echo $money." VND";}?></span>
                        </div>
                        <div>
                            <h4 class="receiptday">Ngày gửi:</h4>
                            <span class="day-receipt"><?php echo date("d/m/Y");;?></span>
                        </div>
                        <div>
    
                        </div>
                    </div>
                    <h4 class="dtext">Nội dung: </h4>
                    <span><?php if(isset($content)) {echo $content;}?></span>
                </div>
                <button class="btn-checked" type="submit" method="POST" name="confirm" onclick="<?php send_otp()?>">Xác nhận</button>
            </div>

                <div class="check-otp endshow">
                    <div class="otp-box">
                        <form action="" method="POST">
                            <label for="OTP">Hãy nhập mã xác nhận: </label> <br>
                            <input type="text" name="otp">
                            <button type="submit" name="confirm_otp">xác nhận</button>
                            <button type="button" class="btn-back">Back</button>
                        </form>
                    </div>
                </div>
        </div>
        
    </div>
  
  <script src="./main.js"></script>
</body>
  
  </html>