<?php

$servername = "127.0.0.1";
$username = "root";
$password = "22222";
$dbname = "web_ads";
$conn = mysqli_connect($servername, $username, $password, $dbname);


header('Content-type:text/html; charset=utf-8');
// 开启Session
session_start();
if (isset($_SESSION['islogin'])) {
    $search_key = $_POST["userid"];
    $array_list = array();
    $sql = "select User_id,Ads_id,Ads_name from User inner join Ads on Ads.Owner=User.User_id where User.User_id='$search_key';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $temp = array($row["User_id"], $row["Ads_id"], $row["Ads_name"]);
            array_push($array_list, $temp);
        }
    } else {
        return;
    }
    $out = "      <!DOCTYPE html>
                <html lang=\"en\">
                <head>
                <meta charset=\"UTF-8\">
	            <title>Admin information</title>
                <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
                <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css\">
                <link rel=\"stylesheet\" href=\"css/style.css\">
                </head>
                
                <body>

                <div class=\"form\">
                 <h2>User history:</h2>
                                
                <br>

                <table style=\" width:100%;\">
                            <tr>
                            <th style=\"color: black;width: 20%;text-align: center;\">User_id</th>
                            <th style=\"color: black;width: 20%;text-align: center;\">Ads_id</th>
                            <th style=\"color: black;width: 40%;text-align: center;\">Ads_name</th>
                            <th style=\"color: black;width: 20%;text-align: center;\"></th>
                            </tr>";
    foreach ($array_list as $x => $x_value) {

        $out .= '
               <tr><form action="admin_edit.php" method="POST">
               <td style="width: 20%;text-align: center;" ><input type="hidden" name="User_id" style=" border:none; font-size: 18px;"   value="' . $x_value[0] . '"/>' . $x_value[0] . '</td>
               <td style="width: 20%;text-align: center;" ><input type="hidden" name="Ads_id" style=" border:none; font-size: 18px;"   value="' . $x_value[1] . '" />' . $x_value[1] . '  </td>
               <td style="width: 40%;text-align: center;" ><input type="hidden" name="Ads_name" style="border:none; font-size: 18px;"   value="' . $x_value[2] . '" />' . $x_value[2] . '</td>
               <td  style="width: 20%;text-align: center;"><input type="submit" name="Enter"  style="text-align: center; border:none;font-style: italic; font-size: 18px;color: blue; text-decoration:underline" value="Enter"/></td></form></tr>';
    }
        $out.= '</table>

<br>
<br>
<a href="admin_manage.php" >Return</a></form>
<div style="float: right"><a href="admin_logout.php" >Logout</a></div>';
    echo $out;
}


