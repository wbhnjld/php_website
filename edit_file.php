<?php
/**
 * Created by PhpStorm.
 * User: riritaba
 * Date: 2018/12/9
 * Time: 10:49 PM
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
    $sql = "select * from User where User_id='$userId';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userName = $row["User_name"];
            $phone = $row["Phone"];
            $email = $row["Email"];
            $compId = $row["Company_id"];
        }


    }
    $out = '           
            <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    
    <title>Sign-Up/Login Form</title>
    <script>
    function detect2(){
            var inputValue = document.getElementById("userName").value;
            //console.log(inputValue);
            if(inputValue.indexOf(";")!=-1){
                alert("Please don\'t contain semicolon(;) in your userName" );
                document.getElementById("userName").value = "";
            }
        }
         function detect4() {
                var inputValue = document.getElementById("phone").value;
                //console.log(inputValue);
                if (inputValue.indexOf(";") != -1) {
                    alert("Please don\'t contain semicolon(;) in your phone number");
                    document.getElementById("phone").value = "";
                }
            }
        </script>
    <link href=\'https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600\' rel=\'stylesheet\' type=\'text/css\'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="css/style.css">


</head>

<body>

<div class="form">

            <h1>Edit information</h1>

            <form action="edit.php" method="POST" enctype="multipart/form-data">

                    <div class="field-wrap" style="height:40px;">
                        <label style="left: 70%">
                            User Name<span class="req">*</span>
                        </label>
                        <input type="text" name="userName" id="userName" onchange="detect2();" value="'.$userName.'" required autocomplete="off"/>
                    </div>

                <div class="field-wrap" style="height:40px;">
                    <label style="left: 70%">
                        Phone number<span class="req">*</span>
                    </label>
                    <input type="text" name="phone" id="phone" onchange="detect4();" value="'.$phone.'" required autocomplete="off"/>
                </div>
               ';

                $sql = "SELECT Company_id, Company_name FROM Company;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $array_list = array();
                    while ($row = $result->fetch_assoc()) {
                        $temp = array($row["Company_id"], $row["Company_name"]);
                        array_push($array_list, $temp);
                    }

                    $out .= '<div class="field-wrap">
                            <select name="q">
                            <option value="">Choose one company:</option>';
                    foreach ($array_list as $ar) {
                        $out .= '<option value='.$ar[0].'>'.$ar[1].'</option>';
                    }

                    $out .= '</select>' . ' <a style="display:inline" href="add_company.php">If your company was not listing, click here.</a></div>';


                }
                $out.='

                <br>
                   <div class="field-wrap" style="height:40px;">
                        <a style="display:inline; font-size:20px" href="changePW.html">click here to change password</a>
                    </div>
                <br>
                <button type="submit" class="button button-block"/>
                Confirm</button>

            </form>

        </div>


    </div><!-- tab-content -->

</div> <!-- /form -->
<script src=\'http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js\'></script>


<script src="js/index.js"></script>


</body>

</html>';

                echo $out;


}