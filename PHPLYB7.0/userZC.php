<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户注册页面</title>
    <link rel="stylesheet" type="text/css" href="login.css"/>
</head>
<body>
<div class="title">用户注册页面</div>
<div class="a">
<form id="form1" name="form1" method="post" action="">
    <table width="400" border="0">
        <tr>
            <td width="80">邮箱：</td>
            <td width="300"><input type="text" name="mail" id="textfiled"/></td>
        </tr>
        <tr>
            <td width="80">名称：</td>
            <td width="300"><input type="text" name="name" id="textfiled2"/></td>
        </tr>
        <tr>
            <td width="80">密码：</td>
            <td width="300"><input type="text" name="password" id="textfiled3"/></td>
        </tr>
        <tr height="10px"></tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="ZC" id="button" value="确定注册">
                <input type="submit" name="FH" id="button2" value="已有账号返回登录">
            </td>
        </tr>
    </table>
</form>
</div>
<?php
if (isset($_POST['FH']))//跳转到用户登录页面
{
    header('Location:userlogin.php');
}
if(@$_POST["ZC"]=="确定注册"){
    $mail=$_POST["mail"];
    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$mail)) {
        ?><script type="text/javascript">
            alert("邮箱格式非法");
        </script><?php
    }else{
        ?><script type="text/javascript">
            alert("注册成功");
        </script><?php
        $con=mysqli_connect('localhost','root','123456','lyb',3308);
        //mysqli_set_charset($con,"utf8");
        mysqli_query($con,"set names utf8");
        $a=$_POST["mail"];
        $b=$_POST["name"];
        $c=$_POST["password"];
        $c=md5($c);
        mysqli_query($con,"INSERT INTO user(mail,name,password) VALUES ('$a','$b','$c')");
    }
}
?>
</body>
</html>