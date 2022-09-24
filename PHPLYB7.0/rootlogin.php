<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员登录页面</title>
    <link rel="stylesheet" type="text/css" href="login.css"/>
</head>
<body>
<div class="title">管理员登录页面</div>
<div class="a">
<form id="form1" name="form1" method="post" action="#">
    <table width="400" >
        <tr>
            <td width="120">管理员账号:</td>
            <td width="300"><input type="text" name="id" id="textfield"/></td>
        </tr>
        <tr>
            <td width="68">密码:</td>
            <td width="320"><input type="text" name="password" id="textfield2"/></td>
        </tr>
        <tr height="10px"></tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="rootlogin" id="button" value="管理员登录"/>
                <input type="submit" name="userlogin" id="button2" value="用户登录界面"/>
                <?php
                if (isset($_POST['userlogin']))//跳转用户登录界面，管理员不提供注册只能通过数据库添加账号密码
                    header('Location:userlogin.php');
                ?>
                <?php
                session_start();
                if (isset($_POST['rootlogin'])){
                    $con=mysqli_connect('localhost','root','123456','lyb',3308);
                    //mysqli_set_charset($con,"utf8");//数据库连接和设置字符集
                    mysqli_query($con,"set names utf8");
                    $xx=$_POST["id"];
                    $yy=$_POST["password"];
                    $aa=mysqli_query($con,"SELECT * FROM rootlogin WHERE id= '{$xx}' AND password ='{$yy}'");//执行mysql查询语句
                    $row=mysqli_fetch_array($aa);
                    if(empty($row)){//查询数据库为空则empty返回1,弹窗显示登录失败;查询成功则返回0进入管理员主页
                        ?><script type="text/javascript">
                            alert("管理员登录失败");
                        </script><?php
                    }else{
                        $_SESSION['rootid']=$xx;
                        header('Location:rootindex.php');
                    }
                }
                ?>
            </td>
        </tr>
    </table>
</form>
</div>
</body>
</html>