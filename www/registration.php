<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./main.js"></script>
</head>
<body>
    <a href="./index.php">
    <img src="./images/Silver coin_free-file (1).png" alt="Logo" class="img-background" >
    </a>
    <div class="container-form">
        <h2>Đăng ký</h2>        
        <form action="./admin/Register.php" method="POST" enctype="multipart/form-data">
            <label for="phone">Số điện thoại đăng ký:</label>
            <input type="tel" id="phone" name="phone" required>
            <label for="mail">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="fname">Họ và tên:</label>
            <input type="text" id="fname" name="fullname">
            <label for="birthdaytime">Ngày sinh:</label>
            <input type="datetime-local" id="birthdaytime" name="datetime">
            <label for="address">Địa chỉ:</label>
            <input type="text" name="address" id="address">
            
            <label for="image-id-front" class="label-upload-image">Tải ảnh chứng minh nhân dân mặt trước</label>
            <input type="file" name="upload_image1" id="image-id-front" class="upload-photo" onchange="loadFile(event)">
            <img src="" alt="" id="output_front" class="upload-id hidden">
            
            <label for="image-id-back" class="label-upload-image">Tải ảnh chứng minh nhân dân mặt sau</label>
            <input type="file" name="upload_image2" id="image-id-back" class="upload-photo" onchange="loadFile(event)">
            <img src="" alt="" id="output_back" class="upload-id hidden">

            <div class="btns">
                <button type="submit">Đăng kí</button>
            </div>

        </form>
    </div>
</body>
</html>