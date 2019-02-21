<?php
/**
 * Created by PhpStorm.
 * User: riritaba
 * Date: 2018/12/11
 * Time: 2:06 PM
 */
header('Content-type:text/html; charset=utf-8');
// 开启Session
session_start();

if (isset($_SESSION['islogin'])) {

    $userId = $_SESSION['userId'];

    $ads_id = $_POST['Ads_id'];
    if(!$ads_id){
        echo "empty";
    }
    $ads_name = $_POST['Ads_name'];
    $status = $_POST['status'];
    $link = $_POST['Link'];


    $servername = "127.0.0.1";
    $username = "root";
    $password = "22222";
    $dbname = "web_ads";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "select Ads.Ads_id, Ads_schedule.date,Ads_position.Position_name, Ads_position.Position_price from Ads inner join Ads_schedule on Ads.Ads_id=Ads_schedule.Ads_id inner join Ads_position on Ads_schedule.Position_id=Ads_position.Position_id where Ads.Owner = '$userId' and Ads.Ads_id='$ads_id';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $array_list = array();
        while ($row = $result->fetch_assoc()) {
//            echo $row["Ads_name"];
            $temp = array($row["Ads_id"], $row["date"], $row["Position_name"], $row["Position_price"]);
            array_push($array_list, $temp);
        }
    }else{
        echo "bad!bad!";
    }
    $sql1 = "select sum(Position_price) as total from Ads inner join Ads_schedule on Ads.Ads_id=Ads_schedule.Ads_id inner join Ads_position on Ads_schedule.Position_id=Ads_position.Position_id where Ads.Owner = '$userId' and Ads.Ads_id='$ads_id';";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
           $total = $row[total];
        }
    }

    $out = '
	       <!DOCTYPE html>
            <html lang="en">
            <head>
            <meta charset="UTF-8">
            <title>Pay</title>
            <link href=\'https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600\' rel=\'stylesheet\' type=\'text/css\'>
            <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" >
            <link rel = "stylesheet" href = "css/style.css" >
            </head >

<body >
<div class="form" >
    <div class="tab-content" >
        <a href = "purchase.php" style = "color: orangered; font-size:20px; float: right;text-decoration:underline" > Create new purchase </a >
        <h2 > Checkout information:</h2 >
        <br >

        <table style = " width:100%;" >
            <tr >
                <th style = "color: black" > Ads_id</th >
                <th style = "color: black" > Date</th >
                <th style = "color: black" > Position</th >
                <th style = "color: black" > Amount</th >
            </tr >
    ';
                            foreach( $array_list as $ar) {
                                $out .= '
                            <tr>
                            <td style="width: 10%;text-align: center;" >' . $ar[0] . '</td>
                            <td style="width: 35%;text-align: center;" >' . $ar[1] . '</td>
                            <td style="width: 25%;text-align: center;" >' . $ar[2] . '</td>
                            <td style="width: 20%;text-align: center;" >' . $ar[3] . '</td>
                            </tr>';
                            }
    $out.='    </table>
        <div style="float: right; vertical-align:middle;">
        <h2 style="font-style: italic"> Total: '.$total.'</h2>


            <form action="pay_process.php" method="POST" enctype="multipart/form-data">
            
                    <div style="float: right"> <select name="pay" style="width: 100px">
                    <option value="">Pay now?</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                    </select>
                    <input type="hidden" name="Ads_id" style=" border:none; font-size: 18px;height: 40px"   value="'.$ads_id.'"/>
                    </div>
                   
                    <div style="height: 40px"><input type="submit" name="Submit" value="submit" style="font-size: 20px;float: right;width: 100px; border: none"></div>

              

            </form>
        </div>


    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <a href=\'logout.php\' style="float: right">Log out</a>
    <a href="purchase_history.php" >Return</a>
    </div>
</div>

</body>
	    ';
    echo $out;

}