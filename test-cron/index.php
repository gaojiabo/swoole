<?php
// 假定数据库用户名：root，密码：123456，数据库：RUNOOB 
$con=mysqli_connect("10.240.0.61","root","root123","guanggao"); 
if (mysqli_connect_errno($con)) 
{ 
    echo "连接 MySQL 失败: " . mysqli_connect_error(); 
} 

$sql = "update yl_shop_advert_image set shop_id=1666 where id=431";

mysqli_query($con, $sql);

mysqli_close($con);



?>