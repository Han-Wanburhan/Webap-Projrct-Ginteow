<?php
session_start();
echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
//เช็คว่ามีตัวแปร session อะไรบ้าง
//print_r($_SESSION);
//exit();
//สร้างเงื่อนไขตรวจสอบสิทธิ์การเข้าใช้งานจาก session
if (empty($_SESSION['id']) && empty($_SESSION['email']) && empty($_SESSION['tel'])) {
    echo '<script>
                setTimeout(function() {
                swal({
                title: "คุณไม่มีสิทธิ์ใช้งานหน้านี้",
                type: "error"
                }, function() {
                window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
                </script>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>กิ๋นตวย | Service</title>
</head>

<body class="welcome">
    <center>
        <h1>สวัสดีคุณ <?= $_SESSION['email'] . ' ' . $_SESSION['tel']; ?></h1>
        <a href="logout.php" class="list-group-item list-group-item-danger" onclick="return confirm('ยืนยันการออกจากระบบ');">ออกจากระบบ</a>
    </center>
    <img src="./images/logo.png" alt="logo" class="logo-main">
    <img src="./images/profile.png" alt="logo" class="profile">
    <!--form action-->
    <div class="container">
        <div class="buy">
            ซื้อ
        </div>
        <!--test format-->
        <div class="sell">
            หิ้ว
        </div>
    </div>
    <!--form action-->
</body>

</html>