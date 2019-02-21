<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <script type="text/javascript">
        function check() {
            var xhr = new XMLHttpRequest();
            var emailAdd = document.getElementById('email').value;


            emailAdd = encodeURIComponent(emailAdd);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) document.getElementById('checkName').innerHTML = xhr.responseText;
            }
            xhr.open("post", "./ajax-post.php");


//form表单把数据转化为XML格式传递到服务器端
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");  //设置header头信息，把传递的数据转化为XML格式
            var info = "emailAdd=" + emailAdd;   //定义字符串info用于传递数据
            xhr.send(info);


        }
        function checkId() {
            var xhr = new XMLHttpRequest();
            var userid = document.getElementById('userId').value;


            userid = encodeURIComponent(userid);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) document.getElementById('checkName1').innerHTML = xhr.responseText;
            }
            xhr.open("post", "./ajax-post1.php");


//form表单把数据转化为XML格式传递到服务器端
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");  //设置header头信息，把传递的数据转化为XML格式
            var info = "userid=" + userid;   //定义字符串info用于传递数据
            xhr.send(info);


        }
        function detect1(){
            var inputValue = document.getElementById("userId").value;
            //console.log(inputValue);
            if(inputValue.indexOf(";")!=-1){
                alert("Please don't contain semicolon(;) in your userID!" );
                document.getElementById("userId").value = "";
            }
        }

        function detect2(){
            var inputValue = document.getElementById("userName").value;
            //console.log(inputValue);
            if(inputValue.indexOf(";")!=-1){
                alert("Please don't contain semicolon(;) in your userName" );
                document.getElementById("userName").value = "";
            }
        }
        function detect3(){
            var inputValue = document.getElementById("email").value;
            //console.log(inputValue);
            if(inputValue.indexOf(";")!=-1){
                alert("Please don't contain semicolon(;) in your email" );
                document.getElementById("email").value = "";
            }
        }

            function detect4() {
                var inputValue = document.getElementById("phone").value;
                //console.log(inputValue);
                if (inputValue.indexOf(";") != -1) {
                    alert("Please don't contain semicolon(;) in your phone number");
                    document.getElementById("phone").value = "";
                }
            }

        function detect5(){
            var inputValue = document.getElementById("userId_1").value;
            //console.log(inputValue);
            if(inputValue.indexOf(";")!=-1){
                alert("Please don't contain semicolon(;) in your userID!" );
                document.getElementById("userId_1").value = "";
            }
        }


    </script>
    <title>Sign-Up/Login Form</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


    <link rel="stylesheet" href="css/style.css">


</head>

<body>

<div class="form">

    <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
    </ul>

    <div class="tab-content">
        <div id="signup">
            <h1>Welcome to our advertisement purchase system!</h1>

            <form action="reg2.php" method="POST" enctype="multipart/form-data">

                <div class="top-row">
                    <div class="field-wrap">
                        <label>
                            User ID<span class="req">*</span>
                        </label>
                        <input type="text" name="userId" id="userId" onchange="detect1();" onblur="checkId();"required autocomplete="off"/>
                    </div>


                    <div class="field-wrap" style="float: right">
                        <label>
                            User Name<span class="req">*</span>
                        </label>
                        <input type="text" name="userName" id="userName" onchange="detect2();" required autocomplete="off"/>
                    </div>

                </div>
                <div id="checkName1"></div>
                <div class="field-wrap">
                    <label>
                        Email Address<span class="req">*</span>
                    </label>
                    <input type="email" name='email' id="email" onchange="detect3();" onblur="check();" required autocomplete="off"/>
                </div>

                <div class="field-wrap" id="checkName"></div>

                <div class="field-wrap">
                    <label>
                        Phone number<span class="req">*</span>
                    </label>
                    <input type="text" name="phone" id="phone" onchange="detect4();" required autocomplete="off"/>
                </div>
                <div class="field-wrap">
                    <label>
                        Set A Password<span class="req">*</span>
                    </label>
                    <input type="password" name="password" required autocomplete="off"/>
                </div>

                <?php
                $servername = "127.0.0.1";
                $username = "root";
                $password = "22222";
                $dbname = "web_ads";
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                $sql = "SELECT Company_id, Company_name FROM Company;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $array_list = array();
                    while ($row = $result->fetch_assoc()) {
                        $temp = array($row["Company_id"], $row["Company_name"]);
                        array_push($array_list, $temp);
                    }

                    $out= '<div class="field-wrap">
                            <select name="q">
                            <option value="">Choose one company:</option>';
                                foreach( $array_list as $ar){
                                $out.= '<option value='.$ar[0].'>'.$ar[1].'</option>';
                                }

                    $out.='</select>'.' <a style="display:inline" href="add_company.php">If your company was not listing, click here.</a></div>';
                    echo $out;

                }
//                 $conn.closeConnect();
                ?>

                <br>
                <br>
                <button type="submit" class="button button-block"/>
                Get Started</button>

            </form>

        </div>

        <div id="login">
            <h1>Welcome Back!</h1>

            <form action="login.php" method="POST" enctype="multipart/form-data">

                <div class="field-wrap">
                    <label>
                        User ID<span class="req">*</span>
                    </label>
                    <input type="text" name="userId" id="userId_1" onchange="detect5();" required autocomplete="off"/>
                </div>

                <div class="field-wrap">
                    <label>
                        Password<span class="req">*</span>
                    </label>
                    <input type="password" name="password" required autocomplete="off"/>
                </div>
                <div class="field-wrap">

                </div>

                </br>

                <button class="button button-block" name="login" value="login"/>
                Log In</button>

            </form>

        </div>

    </div><!-- tab-content -->

</div> <!-- /form -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


<script src="js/index.js"></script>


</body>

</html>



