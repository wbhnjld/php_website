<?php
/**
 * Created by PhpStorm.
 * User: riritaba
 * Date: 2018/12/9
 * Time: 8:07 PM
 */
header('Content-type:text/html; charset=utf-8');
// 开启Session
session_start();

if (isset($_SESSION['islogin'])) {

    $userId = $_SESSION['userId'];
    $servername = "127.0.0.1";
    $username = "root";
    $password = "22222";
    $dbname = "web_ads";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "select * from Ads where Owner='$userId';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $array_list = array();
        while ($row = $result->fetch_assoc()) {
//            echo $row["Ads_name"];
            $temp = array($row["Ads_id"], $row["Ads_name"], $row["Ads_status"], $row["Link"]);
            array_push($array_list, $temp);
        }


    }

    $out = '
	        <!DOCTYPE html>
                <html lang="en">
                <head>
                <meta charset="UTF-8">
	            <title>Purchase_history</title>
                <link href=\'https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600\' rel=\'stylesheet\' type=\'text/css\'>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
                <link rel="stylesheet" href="css/style.css">
                </head>
                
                <body>
                <div class="form">
                <div class="tab-content">
                
                
                 <a href="purchase.php" style="color: orangered; font-size:20px; float: right;text-decoration:underline"  >Create new purchase</a>
                  <h2> Purchase history:</h2>
                
                 <br>
                
                 
                </div>               
              
                <table style=" width:100%;">
                            <tr>
                            <th style="color: black;width: 10%;text-align: center;">Ads_id</th>
                            <th style="color: black;width: 35%;text-align: center;">Ads_name</th>
                            <th style="color: black;width: 20%;text-align: center;">Status</th>
                            <th style="color: black;width: 20%;text-align: center;">Link</th>
                            <th style="width: 15%"></th>
                            </tr>';
                    foreach( $array_list as $ar){
                        if($ar[2] == '0'){
                            $stat = "NOT paid";
                        }elseif ($ar[2] =='1'){
                            $stat = "Paid";
                        }
                        else $stat="Canceled";
                    $out.= '<tr>
                            <form action="pay.php" method="POST" enctype="multipart/form-data">
                            <td style="width: 10%;text-align: center;" ><input type="hidden" name="Ads_id" style=" border:none; font-size: 18px;"   value="'.$ar[0].'"/>'.$ar[0].'</td>
                            <td style="width: 35%;text-align: center;" ><input type="hidden" name="Ads_name" style=" border:none; font-size: 18px;"   value="'.$ar[1].'" />'.$ar[1].'  </td>
                            <td style="width: 20%;text-align: center;" ><input type="hidden" name="status" style="border:none; font-size: 18px;"   value="'.$stat.'"/>'.$stat  .'</td>
                            <td style="width: 20%;text-align: center;" ><input type="hidden" name="Link" style="border:none; font-size: 18px;"   value="'.$ar[3].'" />'.$ar[3].'</td>';

                              if($ar[2] =='0') {
                            $out.='<td  style="width: 15%;text-align: center;"><input type="submit" name="pay"  style="text-align: center; border:none;font-style: italic; font-size: 18px;color: blue; text-decoration:underline" value="Pay"/></td>';
                            }
                            $out.='
                            </form></tr>
                            ';
                        }

                     $out.='        
                </table>
	           
	            <br>
	            <br>
	            <a href=\'logout.php\' style="float: right">Log out</a>
	            <a href="index.php" >Return</a>
	    ';
            echo $out;
}