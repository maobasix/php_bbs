<!-- chatSave.php -->
<?php
    session_start();
    $title = $_POST['title'];
    $content = $_POST['content'];
    if(empty($title) || empty($content)){
        die("<script>alert('请输入标题、内容');history.back();</script>");
    }
    include 'conn.php';
    $sql="insert into chat (title,content,pubtime,uid) values (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $ptime = date('Y-m-d H:i:s');
    $uid = $_SESSION['uid'];
    $stmt->bind_param("ssss", $title, $content, $ptime, $uid);
    try{
        $stmt->execute();
        echo "<script>alert('发布成功！');location.href='index.php';</script>";
    }catch(Exception $err){
        echo "<script>alert('发布失败！');history.back();</script>";
    }finally{
        $stmt->close();
        $conn->close();
    }


?>  
