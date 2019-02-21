<?php
header('Content-type:text/html; charset=utf-8');
// 开启Session
session_start();

if (isset($_SESSION['islogin'])) {
    $pw = $_POST['password'];//isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '';
//$userId=isset($_GET['useId']) ? htmlspecialchars($_GET['userId']) : '';
    if ($pw) {
        $servername = "127.0.0.1";
        $username = "root";
        $dbpassword = "22222";
        $dbname = "web_ads";
        $conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
        $userId = $_SESSION['userId'];
        echo $userId;
        echo $pw;

            $EncryptedPW = md5($pw);
            $sql = "UPDATE User SET Encrypt_password = '$EncryptedPW' WHERE User_id='$userId';";
            if (mysqli_query($conn, $sql)) {
                echo "<script> {window.alert('Success!');location.href='index.php'} </script>";
//                header('location:index.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

    }


