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
    $userId = trim($_POST['userId']);
    $password = trim($_POST['password']);


    // 判断提交的登录信息
    if (($userId == '') || ($password == '')) {
        header('refresh:3; url=login.html');
        echo "User Id or Password can not be empty.";
        exit;
    } else {
        $sql = "select Encrypt_password from User where User_id='$userId';";
        $result = mysqli_query($conn, $sql);
        $pp = 0;
        $EcpPW = md5($password);
        if ($result) {
            if ($result->num_rows > 0) {
                // 输出数据
                while ($row = $result->fetch_assoc()) {
                    $pp = $row["Encrypt_password"];
                }
                if ($pp != $EcpPW) {
                    echo "<script> {window.alert('Wrong User Id or Password！');location.href='index1.php'} </script>";
                    exit;
                } else {
                    # 用户名和密码都正确,将用户信息存到Session中
                    $_SESSION['userId'] = $userId;
                    $_SESSION['islogin'] = 1;

                    setcookie('userId', '', time() - 999);
                    setcookie('code', '', time() - 999);

                    // 处理完附加项后跳转到登录成功的首页
                    header('location:index.php');
                }
            }
        }else{
            echo "<script> {window.alert('User Id does not exist!');location.href='index1.php'} </script>";

        }
    }
}

?>
