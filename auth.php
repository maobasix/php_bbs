<?php
// 负责检测用户是否合法
session_start();
if(empty($_SESSION['uid']))
{
    die('<script>alert("非法操作");history.back()</script>');
}