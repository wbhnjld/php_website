<?php
/**
 * Created by PhpStorm.
 * User: riritaba
 * Date: 2018/12/9
 * Time: 1:15 PM
 */

header('Content-type:text/html; charset=utf-8');
// 开启Session
session_start();

if (isset($_SESSION['islogin'])) {

    $servername = "127.0.0.1";
    $username = "root";
    $password = "22222";
    $dbname = "web_ads";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $today=date("Y-m-d",time());
    $one_week= (date("Y-m-d",strtotime("+1 week",strtotime($today))));
    $sql = "SELECT * FROM Ads_schedule where date>'$today' and date <='$one_week';";
    //$sql="insert into Ads_schedule(Position_id,Ads_id,date) values(1,2,'$today');";
    $result = $conn->query($sql);
    $array_list = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $temp = array($row["Position_id"], $row["date"]);
            array_push($array_list,$temp);
        }
    }

    $temp=array(0,0,0,0,0,0,0);
    $show=array();
    for ($i=1; $i<=3; $i++)
    {
        array_push($show,$temp);
    }
    foreach($array_list as $x=>$x_value)
    {
        $interval= intval(date (  "d", strtotime($x_value[1])-strtotime($today)));
        $show[intval($x_value[0])-1][$interval-2]=1;
        //echo $show[intval($x_value[0])-1][$interval-1];
    }

    $out='<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pay</title>
    <link href=\'https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600\' rel=\'stylesheet\' type=\'text/css\'>
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" >

</head >

<body style=" background: #c1bdba;
  font-family: \'Titillium Web\', sans-serif;">
<div class="form">';

    $out .= ' <div class="tab-content">
            <form action="purchase2.php" method="POST"  enctype="multipart/form-data" style=" background: rgba(19, 35, 47, 0.9);
  padding: 40px;
  max-width: 600px;
  margin: 40px auto;
  border-radius: 4px;
  box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);">
                <h2 style="color: white">Welcome to make a purchase!</h2>
                <div class="field-wrap" style="color: white">
                        <label style="">
                            Your advertisement name:<span class="req">*</span>
                        </label>
                        <input type="text" name="ad_name" id="ad_name" onchange="detect()" required autocomplete="off"/
                    </div>

    <br><table><tr>
    <td style="color: orangered; font-weight: bold">Position Name</td>';
    for ($i=1; $i<=7; $i++)
    {
        $str="+".$i."day";
        $one_week= (date("Y-m-d",strtotime($str,strtotime($today))));
        $out.="<td style=\"color: #1ab188; font-weight: bold\">".$one_week."</td>";
    }
    $out.='</tr>';
    foreach($show as $x=>$x_value)
    {
        $out.= "<tr>";
        $sql = "SELECT Position_name FROM Ads_position where Position_id=$x+1;";
        $result = $conn->query($sql);
        $out.= "<td style=\"color: orangered; font-style: italic\">".$result->fetch_assoc()["Position_name"]."</td>";
        foreach($x_value as $y=>$y_value)
        {
            $str=(string)$x."_".(string)$y." ";
            if ($y_value==0){

                $out.='<td>
            <input type="checkbox" name= '.$str.' /> 
        </td>';}
            else{$out.='<td>
            <input type="checkbox" name='.$str .'checked="checked" disabled/> 
        </td>';}

        }
        $out.="</tr>";
    }
    $out.='</table><br>
    Upload your advertisement picture: <input name="img" id="img" type="file" onchange="detect2()"><br><br>
    <input type="submit" name="submit" value="submit"> <input type="reset" name="cancel" value="reset">
    
    <a style="float: right;color: #1ab188" href="purchase_history.php" >Return</a>
    </form>
    </div> </body></div>
';
    echo $out;



}?>
<script>
    function detect(){
        var inputValue = document.getElementById("ad_name").value;
        //console.log(inputValue);
        if(inputValue.indexOf(";")!=-1){
            alert("Please don't contain semicolon in your Ads name!" );
            document.getElementById("ad_name").value = "";
        }
    }

    function detect2(){
        var inputValue = document.getElementById("img").value;
        console.log(inputValue);
        if(inputValue.indexOf(";")!=-1){
            alert("Please don't contain semicolon in your Ads picture name!" );
            document.getElementById("img").value = "";
        }
        if(inputValue.indexOf(".png")==-1 && inputValue.indexOf(".jpg")==-1 &&inputValue.indexOf(".jpeg")==-1 ){
            alert("Please upload .png or .jpg or .jpeg picture!" );
            document.getElementById("img").value = "";
        }
    }
</script>

