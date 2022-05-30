<?php
// 开启会话
session_start();

// phpinfo();

// 1. 声明资源类型
header('Content-Type: image/jpeg');

// 2. 创建画布
$img = imagecreatetruecolor(100, 40);

// 3. 设置画布的颜色
$color_bg = imagecolorallocate($img, 200, 200, 200);
imagefill($img, 0, 0, $color_bg);

// 4.写入验证码
$color_text = imagecolorallocate($img, 0, 0, 0);
$str = '0123456789abcdefgABCDEFG';
$text = '';
for($i=0; $i<4; $i++){
    $text .= substr($str, rand(0, strlen($str)-1) ,1);
}
// imagestring($img, 5, 10, 10, $text, $color_text);
imagettftext($img, 20, 0, 5, 30, $color_text,'VarelaRound-Regular.ttf',$text);
// 把验证码存储在服务器"缓存"中，以便登录比对
$_SESSION['vcode'] = $text;

// 5.添加“干扰噪点”
for($i=0; $i<600;$i++){
    $c = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
    imagesetpixel($img, rand(0,100), rand(0,40), $c);
}
// 6.添加“干扰线”
for($i=0; $i<8; $i++){
    $c = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
    imageline($img, rand(0,100), rand(0,40), rand(0,100), rand(0,40), $c);
}

// 输出图片
imagepng($img);