<?php
//画布
$img = imagecreate(140,45);
$bgcolor = imagecolorallocate($img,255,255,255); //分配的一个颜色是背景色

//随机生成中文验证码
$str = "一二三四五六七八九十";
$array = str_split($str,3); //三个字符 存一个汉字

//获取字符总数
$len = count($array);

//验证码
$code = "";

for($i=0;$i<4;$i++){
    $index = rand(0,$len-1);
    $code .= $array[$index];  //+=  -=

    //绘制验证码
    //imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text)

    $size = rand(15,20);  //文字大小
    $angle = rand(-60,60); //角度
    $x = 10+25*$i;//横坐标
    $y =rand(30,35);//纵坐标
    $color = imagecolorallocate($img,rand(0,80),rand(0,80),rand(0,80));//文字颜色
    $fontfile = realpath('./SIMLI.TTF'); //字体库  C:\Windows\Fonts 绝对路径
    imagettftext($img, $size, $angle, $x, $y, $color, $fontfile, $array[$index]);
}

//把验证码写入session
session_start();
$_SESSION['code'] = $code;
//echo $code;
//die;

//线干扰
for($i=0;$i<10;$i++){
    $color = imagecolorallocate($img,rand(0,80),rand(0,80),rand(0,80));
    imageline($img,rand(1,139),rand(1,44),rand(1,139),rand(1,44),$color);
}


//点干扰
for($i=0;$i<500;$i++){
    $color = imagecolorallocate($img,rand(0,80),rand(0,80),rand(0,80));
    imagesetpixel($img,rand(1,139),rand(1,44),$color);
}


//绘制到浏览器
header("content-type:image/png");
imagepng($img);
?>