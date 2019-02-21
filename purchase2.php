<?php

// 开启Session


session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "22222";
$dbname = "web_ads";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$today=date("Y-m-d",time());
$sql="";
$userid = $_SESSION['userId'];
$sql="select max(Ads_id) from Ads";

$result = $conn->query($sql);
$next=$result->fetch_assoc()['max(Ads_id)']+1;
$sql="";

$ad_name=$_POST['ad_name'];
if ($ad_name==""){
    echo "Please input your advisement name!";
    return;
}

$file = $_FILES["img"];
echo var_dump($_FILES);
if ($file["error"] == 0) {
    // 成功
    // 判断传输的文件是否是图片，类型是否合适
    // 获取传输的文件类型
    $typeArr = explode("/", $file["type"]);
    if($typeArr[0]== "image"){
        // 如果是图片类型
        $imgType = array("png","jpg","jpeg");
        if(in_array($typeArr[1], $imgType)){ // 图片格式是数组中的一个
            // 类型检查无误，保存到文件夹内
            // 给图片定一个新名字 (使用时间戳，防止重复)
            $imgname = "~/file/".time().".".$typeArr[1];
            // 将上传的文件写入到文件夹中
            // 参数1: 图片在服务器缓存的地址
            // 参数2: 图片的目的地址（最终保存的位置）
            // 最终会有一个布尔返回值
            $bol = move_uploaded_file($file["tmp_name"], $imgname);
            if($bol){
                echo "上传成功！";
            } else {
                echo "上传失败！";
            };
        }
    } else {
        // 不是图片类型
        echo "没有图片，再检查一下吧！";
    };
} else {
    // 失败
    echo $file["error"];
};




for ($i=0; $i<=2; $i++)
{


    for ($j=0; $j<=6; $j++)
    {
        $a = (string)$i.'_'.(string)$j;
        //echo $a;
        if (isset($_POST[$a])){

            $str='+'.(string)($j+1)." day";
            $new_date= (date("Y-m-d",strtotime($str,strtotime($today))));
            //echo $new_date;

            $sql.="insert into Ads_schedule(Position_id,Ads_id,date) values($i+1,$next,'$new_date');\n ";

        }
    }



}

if ($sql!=""){
    $sql1="insert into Ads(Ads_name,Ads_status,Owner) values('test',0,'$userid');";
    echo $sql."<br>";
    $result = $conn->query($sql1);
    if (mysqli_multi_query($conn, $sql)) {
        echo "New record created successfully";

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}
else{
    echo "";
}