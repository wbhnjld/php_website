<?php
/**
 * Created by PhpStorm.
 * User: riritaba
 * Date: 2018/12/9
 * Time: 1:48 PM
 */
$userId = $_POST['userid'];

$servername = "127.0.0.1";
$username = "root";
$password = "22222";
$dbname = "web_ads";
$conn = mysqli_connect($servername, $username, $password, $dbname);


$sql = "SELECT User_id FROM User;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $array_list = array();
    while ($row = $result->fetch_assoc()) {
//        $temp = array($row["Company_id"], $row["Company_name"]);
        $array_list[] = $row['User_id'];
    }
//    echo "<pre>";print_r($array_list);echo "<pre>";
//    echo "Your company's address has been registered!";
//    return;
}

if($userId == "") echo "<font style='font-size:15px;color:red;'>You must enter user id.</font>";
else if(in_array($userId, $array_list)) echo "<font style='font-size:15px;color:red;'>This user ID has already been used!</font>";
else echo "<font style='font-size:15px;color:green;'>This user ID is fine.</font>";

?>
