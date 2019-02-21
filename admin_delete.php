<?php

header('Content-type:text/html; charset=utf-8');
// 开启Session
session_start();
if (isset($_SESSION['islogin'])) {
    $p_id = $_POST["Position_id"];
    $ads_id = $_POST["Ads_id"];
    $date = $_POST["date"];

    $servername = "127.0.0.1";
    $username = "root";
    $password = "22222";
    $dbname = "web_ads";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql = "delete from Ads_schedule where Ads_id='$ads_id' and Position_id='$p_id' and date='$date';";
    $result = $conn->query($sql);
    $sql = "select * from Ads_schedule where Ads_id='$ads_id';";
    $result = $conn->query($sql);
    if ($result->num_rows <= 0) {
        $sql = "update Ads set Ads_status=-1 where Ads_id='$ads_id';";
        if (mysqli_query($conn, $sql)) {
            echo "<script> {window.alert('Delete success!');location.href='admin_manage.php'} </script>";
//                header('location:index.php');
        } else {
            echo "<script> {window.alert('Failed!');location.href='admin_manage.php'} </script>";
        }
    }

}