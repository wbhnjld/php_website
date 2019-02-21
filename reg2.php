<?php
header('Content-type:text/html; charset=utf-8');
// 开启Session
session_start();
    $q = $_POST['q'];//isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '';
    //$userId=isset($_GET['useId']) ? htmlspecialchars($_GET['userId']) : '';
    if($q){
        $servername = "127.0.0.1";
        $username = "root";
        $dbpassword = "22222";
        $dbname = "web_ads";
        $conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
        $userId=$_POST['userId'];
        $userName=$_POST['userName'];
        $passWord=$_POST['password'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];

        if(!ctype_digit($phone)){
            echo "<script> {window.alert('Phone format is wrong!');location.href='index1.php'} </script>";
        }
        if ($email=='' or $phone=='' or $passWord=='' or $userName=='' or $userId=='' ){
            echo "<script> {window.alert('You forget input some information, please redo it!');location.href='index1.php'} </script>";
        }
        else{
            $EncryptedPW = md5($passWord);

            $sql = "insert into User( User_id,Encrypt_password,User_name,Phone ,Email,Company_id ) values ('$userId', 
                    '$EncryptedPW', '$userName', '$phone', '$email', '$q');";
            if (mysqli_query($conn, $sql)) {
//                echo "New record created successfully";
                $_SESSION['userId'] = $userId;
                $_SESSION['islogin'] = 1;

                setcookie('userId', '', time() - 999);
                setcookie('code', '', time() - 999);

                // 处理完附加项后跳转到登录成功的首页
                header('location:index.php');
            } else {
//                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                echo "<script> {window.alert('Create failed. Please retry.');location.href='index1.php'} </script>";
            }
        }

    }
    else{
        echo "<script> {window.alert('You did not choose a company!');location.href='index1.php'} </script>";

    }

//    $conn.closeConnect();
