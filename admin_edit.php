<?php
header('Content-type:text/html; charset=utf-8');
// 开启Session
session_start();
if (isset($_SESSION['islogin'])) {
    $user_id = $_POST["User_id"];
    $ads_id = $_POST["Ads_id"];
    $ads_name = $_POST["Ads_name"];


    $servername = "127.0.0.1";
    $username = "root";
    $password = "22222";
    $dbname = "web_ads";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql = "select Ads_schedule.Position_id, Ads_id, date, Position_name from Ads_schedule left join Ads_position on Ads_schedule.Position_id=Ads_position.Position_id where Ads_id='$ads_id';";
    $result = $conn->query($sql);
    $array_list = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $temp = array($row["Position_id"], $row["Ads_id"], $row["date"], $row["Position_name"]);
            array_push($array_list, $temp);
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
                
                  <h2> Purchase history:</h2>
                
                 <br>
                
                 
                </div>               
              
                <table style=" width:100%;">
                            <tr>
                            <th style="color: black;width: 20%;text-align: center;">Position id</th>
                            <th style="color: black;width: 20%;text-align: center;">Position name</th>
                            <th style="color: black;width: 20%;text-align: center;">Ads id</th>
                            <th style="color: black;width: 20%;text-align: center;">date</th>
                            <th style="color: black;width: 20%;text-align: center;"></th>
                            <th style="width: 15%"></th>
                            </tr>';

//        $out = "<table><tr><td>Position id</td><td>Ads id</td><td>date</td></tr>>";
        foreach ($array_list as $x => $x_value) {
            $out .= '<tr><form action="admin_delete.php" method="POST">';
            $out .= '
               <td style="width: 20%;text-align: center;" ><input type="hidden" name="Position_id" style=" border:none; font-size: 18px;"   value="' . $x_value[0] . '"/>' . $x_value[0] . '</td>
               <td style="width: 20%;text-align: center;" ><input type="hidden" name="Position_name" style=" border:none; font-size: 18px;"   value="' . $x_value[3] . '"/>' . $x_value[3] . '</td>
               <td style="width: 20%;text-align: center;" ><input type="hidden" name="Ads_id" style=" border:none; font-size: 18px;"   value="' . $x_value[1] . '" />' . $x_value[1] . '  </td>
               <td style="width: 20%;text-align: center;" ><input type="hidden" name="date" style="border:none; font-size: 18px;"   value="' . $x_value[2] . '" />' . $x_value[2] . '</td>
               <td style="width: 20%;text-align: center;"><input type="submit" name="Delete"  style="text-align: center; border:none;font-style: italic; font-size: 18px;color: blue; text-decoration:underline" value="Delete"/></td></form></tr>';
        }
        echo $out . "</table>
<br>
<a href=\"admin_manage.php\" >Return</a></div></body></html>";


    } else {
        echo "<script> {window.alert('This order has already been canceled!');location.href='admin_manage.php'} </script>";

    }
}