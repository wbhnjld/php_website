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
$userId = $_SESSION['userId'];  //用于后面的提示信息
$_SESSION = array();
session_destroy();

// 清除Cookie
setcookie('userId', '', time()-99);
setcookie('code', '', time()-99);

// 提示信息
echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                <meta charset="UTF-8">
	            <title>Index Page</title>
                <link href=\'https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600\' rel=\'stylesheet\' type=\'text/css\'>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
                <link rel="stylesheet" href="css/style.css">
                </head>

                <body>
                <div class="form">
                <div class="tab-content">
                <h2> Thanks for using. Click here to <a href=\'index1.php\'>login</a></h2>
                </body>
                </html>';

?>
