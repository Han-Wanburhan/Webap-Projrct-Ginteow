<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>กิ๋นตวย | Login</title>
</head>

<body class="welcome">
    <div class="container">
        <div class="image">
            <img src="./images/logo.png" alt="logo" id="login-logo">
        </div>
        <div class="login">
            <h1 id="header">Welcome</h1>
            <form action="" method="post">
                <input type="text" name="username" id="username" placeholder="username" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <div class="container">
                    <input type="submit" value="Login">
                    <button onclick="location.href='http://localhost/0/register.php'" type="button">
                        Register</button>
                </div>
            </form>
            <center><a href="http://localhost/0/login.php">Forgot Password</a></center>
        </div>
    </div>
</body>

</html>

<?php

//print_r($_POST); //ตรวจสอบมี input อะไรบ้าง และส่งอะไรมาบ้าง 
//ถ้ามีค่าส่งมาจากฟอร์ม
if (isset($_POST['username']) && isset($_POST['password'])) {
    // sweet alert 
    echo '
   <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    //ไฟล์เชื่อมต่อฐานข้อมูล
    require_once 'connect.php';
    //ประกาศตัวแปรรับค่าจากฟอร์ม
    $username = $_POST['username'];
    $password = sha1($_POST['password']); //เก็บรหัสผ่านในรูปแบบ sha1 

    //check username  & password
    $stmt = $conn->prepare("SELECT id, email, tel FROM tbl_member WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();

    //กรอก username & password ถูกต้อง
    if ($stmt->rowCount() == 1) {
        //fetch เพื่อเรียกคอลัมภ์ที่ต้องการไปสร้างตัวแปร session
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //สร้างตัวแปร session
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['tel'] = $row['tel'];

        //เช็คว่ามีตัวแปร session อะไรบ้าง
        //print_r($_SESSION);

        //exit();

        header('Location: service.php'); //login ถูกต้องและกระโดดไปหน้าตามที่ต้องการ
    } else { //ถ้า username or password ไม่ถูกต้อง

        echo '<script>
                      setTimeout(function() {
                       swal({
                           title: "เกิดข้อผิดพลาด",
                            text: "Username หรือ Password ไม่ถูกต้อง ลองใหม่อีกครั้ง",
                           type: "warning"
                       }, function() {
                           window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
                       });
                     }, 1000);
                 </script>';
        $conn = null; //close connect db
    } //else
} //isset 
?>