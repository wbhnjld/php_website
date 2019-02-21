<?php
header('Content-type:text/html; charset=utf-8');
// 开启Session
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "22222";
$dbname = "web_ads";
$conn = mysqli_connect($servername, $username, $password, $dbname);




if (isset($_POST['login'])) {
    # 接收用户的登录信息
    $adminId = trim($_POST['adminId']);
    $password = trim($_POST['password']);


    // 判断提交的登录信息
    if (($adminId == '') || ($password == '')) {
        header('refresh:3; url=login.html');
        exit;
    } else {
        $sql = "select Encrypt_password from Administrator where Admin_id='$adminId';";
        $result = mysqli_query($conn, $sql);
        $pp = 0;
        $EcpPW = md5($password);
        if ($result) {
            if ($result->num_rows > 0) {
                // 输出数据
                //echo "Then have the following syntax: <br>(1)id                          (2)pwd                         (3)User_name                          (4)Phone                                (5)Email                       (6)Company_id <br>";
                while ($row = $result->fetch_assoc()) {
                    $pp = $row["Encrypt_password"];
                }
                if ($pp != $EcpPW) {
                    echo "<script> {window.alert('Wrong Admin Id or Password！');location.href='admin_login.html'} </script>";
                    exit;
                } else {
                    # 用户名和密码都正确,将用户信息存到Session中
                    $_SESSION['adminId'] = $adminId;
                    $_SESSION['islogin'] = 1;

                    setcookie('userId', '', time() - 999);
                    setcookie('code', '', time() - 999);

                    // 处理完附加项后跳转到登录成功的首页
                    header('location:admin_manage.php');
                }
            }
        }
    }
}

?>
