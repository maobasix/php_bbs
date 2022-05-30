<!-- 此页面负责注册 -->
<?php
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $nickname = $_POST['nickname'];

    if(empty($uid) || empty($pwd)){
        die('<script>alert("账号密码均不能为空！");history.back()</script>');
    }
    if(strlen($uid)<3 || strlen($uid)>20){
        die('<script>alert("账号长度应在3~20位！");history.back()</script>');
    }
    if(strlen($uid)<6 || strlen($uid)>20){
        die('<script>alert("密码长度应在6~20位！");history.back()</script>');
    }

    // 包含连接数据库的文件(相当于嵌入conn.php的代码，目的：代码重用)
    include 'conn.php';
    // 插入数据
    $face = 'default.jpg';
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $sql="insert into users (uid,pwd,face,nickname) values (?,?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ssss", $uid, $pwd, $face, $nickname);
    
    try{
        $stmt->execute();
        echo "<script>alert('注册成功！');location.href='index.php';</script>";
    }catch(Exception $err){
        echo "<script>alert('注册失败！');history.back();</script>";
    }finally{
        $stmt->close();
        $conn->close();
    }
?>