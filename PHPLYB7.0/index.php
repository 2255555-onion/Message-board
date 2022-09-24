<?php
$con=mysqli_connect('localhost','root','123456','lyb',3308);
//mysqli_set_charset($con,"utf8");
mysqli_query($con,"set names utf8");
session_start();
if (isset($_SESSION["mail"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>留言板首页</title>
    <link rel="stylesheet" type="text/css" href="index.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>
<body>
<div class="title"><p>留言板</p></div>
<div class="a">
<?php
$x=$_SESSION["mail"];
$result=mysqli_query($con,"SELECT name FROM user WHERE mail = '$x'");
$row=mysqli_fetch_row($result);
$api=substr($x , 0 , -7);//从左边第一位字符起截取3位字符
//$result = mysqli_query($con,$sql);
//if (!$result) {
//    printf("Error: %s\n", mysqli_error($con));
//    exit();
//}一直报一个错：Warning: mysqli_fetch_array() expects parameter 1 to be mysqli_result, boolean given
//后来在网上找了一个很实用的解决方法：
//只需要在php文件中写入这样几行代码,便可以“知错就改”了
?>
    <div class="row">
        <div class="col-md-3">
            <img src="http://q1.qlogo.cn/g?b=qq&nk=<?php echo $api?>&s=640" width="100" height="100">
            <div style="margin-top: 20px">欢迎用户<i><strong><?php echo $row[0]  ?></strong></i></div>
        </div>
        <div class="col-md-8">
            <form action="#" method="POST">
                <textarea name="t" cols="70" rows="5" placeholder="请在此处留言..."></textarea>
                <table style="margin-left: 42%">
                    <tr>
                        <td><p><input name="FB" type="submit" value="发表"></p></td>
                        <td><p><input name="ZX" type="submit" value="切换用户"></p></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php
if (isset($_POST['ZX'])){//用户点击切换用户按钮
    $_SESSION=array();
    session_destroy();
    header('Location:userlogin.php');}
?>
<?php
if (isset($_POST['FB'])) {
    $t = $_POST["t"];
    date_default_timezone_set('PRC');//设置时区，PRC为北京时间
    $time = date("Y-m-d H:i:s", time());//格式化中h为12小时，H为24小时
//插入语句
    $sql = "INSERT INTO `LY` ( `name`, `text`, `time`) VALUES ('$row[0]', '$t', '$time');";
//执行sql的添加代码
    $con->query($sql);
}
?>
<hr>
<h2>留言列表</h2>
<hr>
<ul>
    <?php
    // 最新留言展示前面
    $sql = "SELECT * FROM `LY` ORDER BY `LY`.`time` DESC";
    //  DESC 加上这个是降序排列
    $result = $con->query($sql);
    if($result->num_rows>0){
        //输出数据
        while($row = $result->fetch_assoc()){
            // $result->fetch_assoc()执行一次显示第一条，执行第二次显示第二条
            $xxx = $row["name"];
            $result1 = mysqli_query($con, "SELECT mail FROM user WHERE name = '$xxx'");
            $row1 = mysqli_fetch_row($result1);
            $userapi = substr($row1[0], 0, -7);//从左边第一位字符起截取3位字符
            ?>
            <table border="1" cellspacing="5" width="800">
                <tr style="height: 200px">
                    <td style="width: 200px"><img src="http://q1.qlogo.cn/g?b=qq&nk=<?php echo $userapi?>&s=640" width="190" height="190"></td>
                    <td style="text-align: left"><p><strong>留言内容：</strong><?php echo $row["text"];?></p></td>
                </tr>
                <tr>
                    <td style="width: 200px"><p>留言人：<?php echo $row["name"];?></p></td>
                    <td style="text-align: right"><span><?php echo $row["time"];?></span></td>
                </tr>
            </table>
            <?php
        }
    } else {
        echo"暂无留言";
    } ?>
</ul>
</div>
</body>
</html>
<?php
}else{
    ?><script type="text/javascript">
        alert("禁止翻墙！！！");
    </script><?php
} ?>