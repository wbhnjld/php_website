<?php
header('Content-type:text/html; charset=utf-8');
// 开启Session
session_start();

if (isset($_SESSION['islogin'])) {
    $q = $_POST['q'];//isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '';
//$userId=isset($_GET['useId']) ? htmlspecialchars($_GET['userId']) : '';
    if ($q) {
        $servername = "127.0.0.1";
        $username = "root";
        $dbpassword = "22222";
        $dbname = "web_ads";
        $conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
        $userId = $_SESSION['userId'];
        $userName = $_POST['userName'];
        $phone = $_POST['phone'];

        if (!ctype_digit($phone)) {
            echo "Phone format is wrong!";
        }
        if ($phone == '' or  $userName == '' or $userId == '') {
            echo "You forget input some information, please redo it!";
        } else {
            $EncryptedPW = md5($passWord);
            $sql = "UPDATE User SET User_name = '$userName', Phone = '$phone', Company_id = '$q' WHERE User_id='$userId';";
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
                header('location:index.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

    } else
        echo "You didn't choose a company!";
// $sql =
//                     $conn.closeConnect();
}