<?php
echo "Welcome to our website. Choose which relations you want to look at:\n";
echo '
<br><br><br>
';
?>
<form action="" method="get">
    <select name="q">
        <option value="">choose one relation:</option>
        <option value="User">User relation</option>
        <option value="Company">Company relation</option>
        <option value="Ads">Ads relation</option>
        <option value="Ads_position">Ads position</option>
    </select>
    <input type="submit" value="submit">
</form>
<?php
/**
 * Created by PhpStorm.
 * User: riritaba
 * Date: 2018/11/27
 * Time: 7:33 PM
 */
header("content-type:text/html;charset=utf-8");
$servername = "127.0.0.1";
$username = "root";
$password = "22222";
$dbname = "web_ads";

// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);

$q = isset($_GET['q'])? htmlspecialchars($_GET['q']) : '';

function build_table_User($array){
    // start table
    $html = '<table>';
    // header row
    $html .= '<tr>';
    //foreach($array[0] as $key=>$value){
    $html .= '<th>' . htmlspecialchars('user_id') . '</th>'.'<th>' . htmlspecialchars('password') . '</th>'.'<th>' . htmlspecialchars('user_name') . '</th>'
    .'<th>' . htmlspecialchars('phone') . '</th>'.'<th>' . htmlspecialchars('email') . '</th>'.'<th>' . htmlspecialchars('Company_id') . '</th>';
    //}
    $html .= '</tr>';

    // data rows
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}


function build_table_Comp($array){
    // start table
    $html = '<table>';
    // header row
    $html .= '<tr>';
    //foreach($array[0] as $key=>$value){
    $html .= '<th>' . htmlspecialchars('Company_id') . '</th>'.'<th>' . htmlspecialchars('Company_name') . '</th>'.'<th>' . htmlspecialchars('Address');
    //}
    $html .= '</tr>';

    // data rows
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}

function build_table_Ads($array){
    // start table
    $html = '<table>';
    // header row
    $html .= '<tr>';
    //foreach($array[0] as $key=>$value){
    $html .= '<th>' . htmlspecialchars('Ads_id') . '</th>'.'<th>' . htmlspecialchars('Ads_name') . '</th>'.'<th>' . htmlspecialchars('Ads_status').'<th>'.'<th>' . htmlspecialchars('Link').'<th>';
    //}
    $html .= '</tr>';

    // data rows
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}


function build_table_Adspo($array){
    // start table
    $html = '<table>';
    // header row
    $html .= '<tr>';
    //foreach($array[0] as $key=>$value){
    $html .= '<th>' . htmlspecialchars('Position_id') . '</th>'.'<th>' . htmlspecialchars('Position_name') . '</th>'.'<th>' . htmlspecialchars('Position_price').'<th>';
    //}
    $html .= '</tr>';

    // data rows
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}

if($q) {
    if($q =='User') {
        echo 'here is the User relation';
        echo '<br>';
        echo '<br>';
        $sql = "SELECT User_id, Encrypt_password, User_name, Phone, Email, Company_id FROM User;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // 输出数据
            //echo "Then have the following syntax: <br>(1)id                          (2)pwd                         (3)User_name                          (4)Phone                                (5)Email                       (6)Company_id <br>";
            $array_list=array();
            while($row = $result->fetch_assoc()) {
                $temp=array($row["User_id"],$row["Encrypt_password"],$row["User_name"],$row["Phone"],$row["Email"],$row["Company_id"]);
                array_push($array_list,$temp);
            }

            echo build_table_User($array_list);

        } else {
            echo "No result, please insert data first.";
        }

    } else if($q =='Company') {
        echo 'here is the Company relation';
        echo '<br>';
        echo '<br>';
        $sql = "SELECT Company_id, Company_name, Address FROM Company;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // 输出数据
            $array_list=array();
            while($row = $result->fetch_assoc()) {
                $temp=array($row["Company_id"],$row["Company_name"],$row["Address"]);
                array_push($array_list,$temp);
            }

            echo build_table_Comp($array_list);
//            echo $result;
        } else {
            echo "No result, please insert data first.";
        }
    } else if($q =='Ads') {
        echo 'here is the Ads relation';
        echo '<br>';
        echo '<br>';
        $sql = "SELECT Ads_id, Ads_name, Ads_status, Link FROM Ads;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // 输出数据
            $array_list=array();
            while($row = $result->fetch_assoc()) {
                $temp=array($row["Ads_id"],$row["Ads_name"],$row["Ads_status"],$row["Link"]);
                array_push($array_list,$temp);
            }

            echo build_table_Ads($array_list);
//            echo $result;
        } else {
            echo "No result, please insert data first.";
        }
    }else if($q =='Ads_position') {
        echo 'here is the Ads relation';
        echo '<br>';
        echo '<br>';
        $sql = "SELECT Position_id, Position_name, Position_price FROM Ads_position;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // 输出数据
            $array_list=array();
            while($row = $result->fetch_assoc()) {
                $temp=array($row["Position_id"],$row["Position_name"],$row["Position_price"]);
                array_push($array_list,$temp);
            }

            echo build_table_Adspo($array_list);
//            echo $result;
        } else {
            echo "No result, please insert data first.";
        }
    }
}
?>


