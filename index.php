<?php
/**
 * Created by PhpStorm.
 * User: riritaba
 * Date: 2018/12/5
 * Time: 1:36 PM
 */


	header('Content-type:text/html; charset=utf-8');
	// 开启Session
	session_start();

	// 首先判断Cookie是否有记住了用户信息
	if (isset($_COOKIE['userId'])) {
		# 若记住了用户信息,则直接传给Session
		$_SESSION['userId'] = $_COOKIE['userId'];
		$_SESSION['islogin'] = 1;
	}
	if (isset($_SESSION['islogin'])) {


        $servername = "127.0.0.1";
        $username = "root";
        $password = "22222";
        $dbname = "web_ads";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $sql2 = "select Company_id, Company_name from Company;";
        $result = $conn->query($sql2);
        if ($result->num_rows > 0) {
            $array_list = array();
            while ($row = $result->fetch_assoc()) {
                $temp = array($row["Company_id"], $row["Company_name"]);
                array_push($array_list, $temp);
            }



        $userID = $_SESSION['userId'];
        $sql1 = "SELECT * FROM User WHERE User_id = '$userID';";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userName = $row[User_name];
                $phone = $row[Phone];
                $emailAdd = $row[Email];
                $cpId = $row[Company_id];
                $cpName = null;
                foreach ($array_list as $arr){
                    if ($cpId == $arr[0]){
                        $cpName = $arr[1];
                    }

                }
            }
            }

            echo '
	        <!DOCTYPE html>
                <html lang="en">

                <head>
                <meta charset="UTF-8">
	            <title>Home Page</title>
                <link href=\'https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600\' rel=\'stylesheet\' type=\'text/css\'>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
                <link rel="stylesheet" href="css/style.css">
                </head>
                
                <body>
                <div class="form">
                <div class="tab-content">
                
                <h2> '.$userID.',  welcome!</h2>
                <div style="float: right">
                 <a href="purchase.php" style="color: white; font-size:20px; " >Buy an advertisement</a>
                 <br>
                 <br>
                 <br>
                 <a href="purchase_history.php" style="color: white;font-size:20px;" >Purchase History</a>
                 <br>
                 <br>
                 <br>
                 <a href="edit_file.php" style="color: white;font-size:20px;" >Edit Information</a>
                </div>               
              
                <table style="width: 50%">
                <tr>
                <td style="color: black;font-weight:bold;">Your ID</td>
                <td>'.$userID.'</td>
                </tr>
                <tr>
                <td style="color: black;font-weight:bold;">Name</td>
                <td>'.$userName.'</td>
                </tr>
                <tr>
                <td style="color: black;font-weight:bold;">Phone</td>
                <td>'.$phone.'</td>
                </tr>
                <tr>
                <td style="color: black;font-weight:bold;">Email</td>
                <td>'.$emailAdd.'</td>
                </tr>
                <tr>
                <td style="color: black;font-weight:bold;">Company</td>
                <td>'.$cpName.'</td>
                </tr>
                
                </table>
	           
	            <br>
	            <br>
	            <a href=\'logout.php\' style="float: right">Log out</a>
	            
	            
	    
	    
	    
	    
	    
	            
	    
	    
	    ';
        }
    }else {
		// 若没有登录
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
                <h2> You did not log in yet, please click <a href=\'index1.php\'>login</a></h2>
                </body>
                </html>';
	}
 ?>