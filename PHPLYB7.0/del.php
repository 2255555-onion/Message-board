
<?php
$con=mysqli_connect('localhost','root','123456','lyb',3308);
//mysqli_set_charset($con,"utf8");
mysqli_query($con,"set names utf8");
$time = $_GET['time'];
$sql = "DELETE FROM `LY` WHERE `LY`.`time` = '$time'";
$con->query($sql);
header('Location:rootindex.php');

?>

//    if (isset($_POST['SC'])) {
//        $time = $row["time"];
//        $sql = "DELETE FROM `LY` WHERE `LY`.`time` = '$time'";
//        $con->query($sql);
//        header('Location:rootindex.php');
//    }
//使用POST在同一网页下传值时，出现只能删除最后一条的情况，目前只想到用get传值跳转链接执行后再跳回原网页
