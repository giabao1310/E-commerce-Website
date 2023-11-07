<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập mật khẩu mới</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <a href="./index.php">
    <img src="./images/Silver coin_free-file (1).png" alt="Logo" class="img-background">
    </a>
    <div class="container-form" style="margin-top: 100px;">
        <h2>Nhập mật khẩu mới</h2>
        
        <form action="./admin/ChangePasswordFirstTime.php" method="POST">
            <label for="password">Nhập mật khẩu mới:</label>
            <input type="password" name="newPassword" placeholder="User password">
            <label for="password">Xác nhận mật khẩu mới:</label>
            <input type="password" name="confirmPassword" placeholder="Confirm password">
            <div style="text-align: center;">
                <button type="submit">Đổi mật khẩu</button>
            </div>
        </form>
    </div>
</body>
</html>