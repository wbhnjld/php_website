<?php
/**
 * Created by PhpStorm.
 * User: riritaba
 * Date: 2018/12/5
 * Time: 5:32 PM
 */
header('Content-type:text/html; charset=utf-8');
// 注销后的操作
session_start();
// 清除Session
$adminId = $_SESSION['adminId'];  //用于后面的提示信息
$_SESSION = array();
session_destroy();

// 清除Cookie
setcookie('adminId', '', time()-99);
setcookie('code', '', time()-99);

// 提示信息
echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                <meta charset="UTF-8">
	            <title>Logout Page</title>
                <link href=\'https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600\' rel=\'stylesheet\' type=\'text/css\'>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
                <link rel="stylesheet" href="css/style.css">
                </head>

                <body>
                <div class="form">
                <div class="tab-content">
                <h2> Click here to <a href=\'admin_login.html\'>login</a> as admin</h2>
                </body>
                </html>';

?>
