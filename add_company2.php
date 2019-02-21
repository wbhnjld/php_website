
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "22222";
$dbname = "web_ads";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$c_name=$_POST['companyName'];
$c_addr=$_POST['address'];

if($c_name=='' or $c_addr==''){
    echo "You information is not complete!";
    return;
}

$sql = "SELECT * FROM Company where Address='$c_addr';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Your company's address has been registered!";
    return;
}

$sql = "insert into Company (Company_name,Address) values('$c_name','$c_addr')";
$result = $conn->query($sql);
if($result){
    echo "<script> {window.alert('Create Success!');location.href='index1.php'} </script>";
}
else{
    echo "Error";
}
?>