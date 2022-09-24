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
        <title>留言板管理界面</title>
        <link rel="stylesheet" type="text/css" href="index.css"/>
    </head>
    <body>
    <div class="title"><p>欢迎管理员登录</p></div>
    <hr>
    <div class="a">
        <h2>留言列表</h2>
        <form id="form" name="form" method="post" action="#">
            <table style="margin-left: 40%">
                <tr>
                    <td><input type="submit" name="CK" id="button1" value="查看用户信息"/></td>
                    <td><input type="submit" name="FH" id="button2" value="返回登陆界面"/></td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['FH'])){//用户点击返回登陆界面按钮
            $_SESSION=array();
            session_destroy();
            header('Location:userlogin.php');}
        if (isset($_POST['CK'])) {
            header('Location:userdata.php');
        }
        ?>
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
                            <td style="text-align: right"><a href="del.php?time=<?php echo $row['time'];?>">删除</a><span>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $row["time"];?></span></td>
                        </tr>
                    </table>
                    <?php
                }
            } else {
                echo"暂无留言";
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
