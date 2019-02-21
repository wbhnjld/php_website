<!DOCTYPE html>
<html lang="en">
<script>
    function detect() {
        var inputValue = document.getElementById("companyName").value;
        //console.log(inputValue);
        if (inputValue.indexOf(";") != -1) {
            alert("Please don't contain semicolon(;) in your company Name");
            document.getElementById("companyName").value = "";
        }
    }

    function detect1() {
        var inputValue = document.getElementById("address").value;
        //console.log(inputValue);
        if (inputValue.indexOf(";") != -1) {
            alert("Please don't contain semicolon(;) in your address");
            document.getElementById("address").value = "";
        }
    }
</script>
<head>
    <meta charset="UTF-8">
    <title>Company Register</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


    <link rel="stylesheet" href="css/style.css">
</head>
<body>


<form action="add_company2.php" method="POST" enctype="multipart/form-data">
    <div class="form">

        <div class="tab-content">
                <h1>Welcome to Register your Company!</h1>

                <form action="add_company2.php.php" method="POST" enctype="multipart/form-data">


                    <div class="field-wrap">
                        <label>
                            Company Name<span class="req">*</span>
                        </label>
                        <input type="text" name="companyName" id="companyName" onchange="detect();" required autocomplete="off"/>
                    </div>

                    <div class="field-wrap">
                        <label>
                            Company address<span class="req">*</span>
                        </label>
                        <input <input type="text" name="address" id="address" onchange="detect1();" required autocomplete="off"/>
                    </div>


                    <button type="submit" name="submit" class="button button-block"/>
                    Register</button>

                </form>

            </div>


    </div>
    </form>




<body>



    </div><!-- tab-content -->

</div> <!-- /form -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


<script src="js/index.js"></script>


</body>

</html>




