<?php
header('Content-type:text/html; charset=utf-8');
// 开启Session
session_start();
if (isset($_SESSION['islogin'])) {
    $out= '     <!DOCTYPE html>
                <html lang="en">
                <head>
                <meta charset="UTF-8">
	            <title>Admin Manage</title>
                <link href=\'https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600\' rel=\'stylesheet\' type=\'text/css\'>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
                <link rel="stylesheet" href="css/style.css">
                </head>
                
                <body>
                <div class="form">
                <h2 style="float: right;font-size: 15px"> Admin: '.$_SESSION['adminId'].'</h2>
                <br>
                
                <form action="admin_information.php" method="POST" enctype="multipart/form-data">
                <h2>Please input user id:</h2><input type="text" name="userid" value="" />
                <br>
                <button class="button button-block" name="login" value="login"/>
                Search</button>
                <br>
                <br>

                <div style="float: right"><a href="admin_logout.php" >Logout</a></div>
    </form>
    </div>
    </body>
    </html>';
        echo $out;
    }

?>