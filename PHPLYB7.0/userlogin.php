<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户登录页面</title>
    <link rel="stylesheet" type="text/css" href="login.css"/>
</head>
<body>
<div class="title">用户登录</div>
<div class="a">
<form id="form1" name="form1" method="post" action="">
    <table width="374" border="0">
        <tr>
            <td width="74">邮箱:</td>
            <td width="300"><input type="text" name="mail" id="textfield" placeholder="请输入邮箱"/></td>
        </tr>
        <tr>
            <td width="74">密码:</td>
            <td width="320"><input type="text" name="password" id="textfield2" placeholder="请输入密码"/></td>
        </tr>
        <tr height="10px"></tr></table>
    <table width="374">
        <tr>
            <td><img src="./code.php"/> </td>
        </tr>
        <tr height="8px"></tr>
        <tr>
            <td><input type="text" name="code" placeholder="验证码" /></td>
        </tr>
        <tr height="8px"></tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="login" id="button" value="登录"/>
                <input type="submit" name="ZHUCE" id="button2" value="注册"/>
                <input type="submit" name="rootlogin" id="button3" value="管理员登录"/>
                <?php
                session_start();
                if (isset($_POST['ZHUCE']))//如果用户点击注册按钮则跳转到用户注册页面
                {header('Location:userZC.php');}
                ?>
                <?php
                if (isset($_POST['rootlogin']))//如果用户点击管理员登录按钮则跳转到管理员登录页面
                {header('Location:rootlogin.php');}
                ?>
                <?php
                if (isset($_POST['login'])){
                    $con=mysqli_connect('localhost','root','123456','lyb',3308);
                    //mysqli_set_charset($con,"utf8");
                    mysqli_query($con,"set names utf8");
                    //数据库连接和设置字符集
                    $x=$_POST["mail"];
                    $y=$_POST["password"];
                    $y=md5($y);
                    $a=mysqli_query($con,"SELECT * FROM user WHERE mail = '{$x}' AND password ='{$y}'");//执行mysql查询语句
                    $row=mysqli_fetch_array($a);
                    if(empty($row)){//查询数据库为空则empty返回1,弹窗显示登录失败;查询成功则返回0进入主页
                        ?><script type="text/javascript">
                            alert("登录失败");
		                </script><?php
                    }else{
                        if($_SESSION['code'] == $_POST['code']){
                            $_SESSION["mail"]=$_POST["mail"];
                            header('Location:index.php');
                        }else{
                            ?><script type="text/javascript">
                                alert("验证码输入错误，请重新输入。");
                            </script><?php
                        }
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