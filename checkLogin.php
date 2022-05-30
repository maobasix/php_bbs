<?php
session_start();
// 读取用户在界面上的输入
$uid = $_POST['uid'];
$pwd = $_POST['pwd'];
$yzm = $_POST['yzm'];
// 检测验证码是否正确
if($yzm!=$_SESSION['vcode']){
    die('<script>alert("验证码错误！");history.back()</script>');
}
// 检测格式
if(empty($uid) || empty($pwd)){
    die('<script>alert("账号密码均不能为空！");history.back()</script>');
}
if(strlen($uid)<3 || strlen($uid)>20){
    die('<script>alert("账号密码错误！");history.back()</script>');
}
if(strlen($uid)<6 || strlen($uid)>20){
    die('<script>alert("账号密码错误！");history.back()</script>');
}

// 验证真伪
// include 'conn.php';
require 'conn.php';
$sql="select * from users where uid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $uid);
$stmt->execute();
$rs = $stmt->get_result();
$row = $rs->fetch_assoc();
if($row && password_verify($pwd, $row['pwd'])){
    // 登录成功后，要存储账号等数据
    $_SESSION['uid'] = $uid;
    $_SESSION['nickname']=$row['nickname'];
    $_SESSION['face']=$row['face'];
    echo "<script>alert('登录成功！');location.href='index.php';</script>";
}else{
    echo "<script>alert('登录失败！');history.back();</script>";
}