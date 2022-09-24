<?php
$con=mysqli_connect('localhost','root','123456','lyb',3308);
//mysqli_set_charset($con,"utf8");
mysqli_query($con,"set names utf8");
session_start();
if (isset($_SESSION['rootid'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户个人信息页</title>
    <link rel="stylesheet" type="text/css" href="index.css"/>
</head>
<body>
<div class="title"><p>用户个人信息</p></div>
<div class="a">
<form id="form1" name="form1" method="post" action="#">
    <input type="submit" name="FHrootindex" id="button" value="返回管理员界面"/>
</form>
<?php
if (isset($_POST['FHrootindex'])) {
    header('Location:rootindex.php');
}
?>
<ul>
    <?php
    // 最新留言展示前面
    $sql = "SELECT `mail`, `name` FROM `user` ";
    //  DESC 加上这个是降序排列
    $result = $con->query($sql);
    if($result->num_rows>0){
        //输出数据
        while($row = $result->fetch_assoc()){
            // $result->fetch_assoc()执行一次显示第一条，执行第二次显示第二条
//            $row2=$row["mail"];
//            print_r($row2);
//            $row3 = mysqli_fetch_row($row2);
//            $userapi2 = substr($row3[0], 0, -7);
            //这个地方想着直接用mail做切片出现bug，还是去复制了主页的通过名字找mail再切片
            $xxx = $row["name"];
            $result1 = mysqli_query($con, "SELECT mail FROM user WHERE name = '$xxx'");
            $row1 = mysqli_fetch_row($result1);
            $userapi2 = substr($row1[0], 0, -7);//从左边第一位字符起截取3位字符
            ?>
            <table border="1" cellspacing="5" width="800">
                <tr style="height: 200px">
                    <td style="width: 200px"><img src="http://q1.qlogo.cn/g?b=qq&nk=<?php echo $userapi2?>&s=640" width="190" height="190"></td>
                    <td style="text-align: center">
                        <p>用户昵称：<?php echo $row["name"];?></p>
                        <p>用户邮箱：<?php echo $row["mail"];?></p>
                    </td>
                </tr>
            </table>
            <?php
        }
    } else {
        echo"暂无用户";
    }
    ?>
</ul>
</div>
</body>
</html>
<?php
}else{
    ?><script type="text/javascript">
        alert("禁止翻墙！！！");
    </script><?php
}
?>