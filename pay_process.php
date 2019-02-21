<?php
/**
 * Created by PhpStorm.
 * User: riritaba
 * Date: 2018/12/13
 * Time: 3:14 AM
 */
header('Content-type:text/html; charset=utf-8');
// 开启Session
session_start();

if (isset($_SESSION['islogin'])) {
    $ads_id= $_POST['Ads_id'];
    echo $_POST['pay'];
    if ($_POST['pay'] == 'yes') {

        $userId = $_SESSION['userId'];
        $servername = "127.0.0.1";
        $username = "root";
        $password = "22222";
        $dbname = "web_ads";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $sql = "update Ads set Ads_status  = '1' where Ads_id= $ads_id;";
        if (mysqli_query($conn, $sql)) {
            echo "<script> {window.alert('Payment success!');location.href='purchase_history.php'} </script>";

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
//            echo "<script> {window.alert('Success!');location.href='index.php'} </script>";


        }
        else{
            echo "<script> {window.alert('Thank you! Please pay at next time.');location.href='purchase_history.php'} </script>";

        }

}