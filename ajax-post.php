<?php
/**
 * Created by PhpStorm.
 * User: riritaba
 * Date: 2018/12/5
 * Time: 5:27 PM
 */
$emailAdd = $_POST['emailAdd'];

$servername = "127.0.0.1";
$username = "root";
$password = "22222";
$dbname = "web_ads";
$conn = mysqli_connect($servername, $username, $password, $dbname);


$sql = "SELECT Email FROM User;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $array_list = array();
    while ($row = $result->fetch_assoc()) {
//        $temp = array($row["Company_id"], $row["Company_name"]);
        $array_list[] = $row['Email'];
    }
//    echo "<pre>";print_r($array_list);echo "<pre>";
//    echo "Your company's address has been registered!";
//    return;
}

if($emailAdd == "") echo "<font style='font-size:15px;color:red;'>You must enter email address.</font>";
else if(in_array($emailAdd, $array_list)) echo "<font style='font-size:15px;color:red;'>This email address has already been registered!</font>";
else echo "<font style='font-size:15px;color:green;'>This email address is fine.</font>";

?>
