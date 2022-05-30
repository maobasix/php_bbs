<!-- 首页（显示话题和评论、点赞信息等） -->
<?php
    // 要使用session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>话题首页</title>
    <!-- 第三方的插件：样式插件 -->
    <link rel="stylesheet" href="libs/bootstrap-5.1.3/css/bootstrap.css">
    <script src="libs/popper.min.js"></script>
    <script src="libs/bootstrap-5.1.3/js/bootstrap.min.js"></script>
    <script src="libs/jquery-3.6.0.js"></script>
    <style>
        .chatbox { 
            display: grid;
            grid-template-columns: 60px auto;
            gap:15px;
        }
        .face {
            width: 60px;
            height: 60px;
            background: #ccc;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class='mt-4 mb-4'>
            <?php
                if(empty($_SESSION['uid'])){
            ?>
                <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">登录</a> | 
                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#regModal">注册</a>
            <?php        
                }else{
            ?>
                欢迎：
                <?php
                    echo $_SESSION['nickname'];
                ?>! | 
                <a href="logout.php">退出</a> | 
                <a data-bs-toggle="modal" data-bs-target="#chatModal">发布话题</a>
            <?php
                }
            ?>
        </div>
        <!-- 话题的结构（布局） -->
        <?php
            include 'conn.php';
            $sql="select c.*, u.nickname from chat c, users u where c.uid = u.uid order by pubtime desc";
            $rs=$conn->query($sql);
            while($row=$rs->fetch_assoc()){
                echo $row['title'];
                ?>
        <div class="chatbox">
            <div class='face'></div>
            <div>
                <h4><?php echo $row['nickname']?></h4>
                <span><?php echo $row['pubtime']?></span>
            </div>

            <div></div>
            <div>
                <h3><?php echo  $row['title']?></h3>
                <h3><?php ?></h3>
            </div>

            <div></div>
            <a>[评论]</a>

            <div></div>
            <div>
                <div><b>小亮：</b>评论评论评论评论评论评论评论评论</div>
                <div><b>小亮：</b>评论评论评论评论评论评论评论评论</div>
                <div><b>小亮：</b>评论评论评论评论评论评论评论评论</div>
                <div><b>小亮：</b>评论评论评论评论评论评论评论评论</div>
            </div>
        </div>
    </div>
        <?php
            }
            $conn->close();
        ?>



    <!-- 弹窗区域 -->
    <!-- 1. 注册 -->
    <form action="regSave.php" method="post">
        <div class="modal fade" id="regModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="regModalTitle">注册新用户</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 ps-5 pe-5">
                    账号
                    <input type="text" name='uid' class='form-control' required minlength='3' maxlength='20'>
                    密码
                    <input type="password" name='pwd' class='form-control' required minlength='6' maxlength='20'>
                    密码确认
                    <input type="password" name='pwd2' class='form-control' required>
                    昵称
                    <input type="text" name='nickname' class='form-control' required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button class="btn btn-primary">提交</button>
                </div>
                </div>
            </div>
        </div>
    </form>

    <!-- 2.登录 -->
    <form action="checkLogin.php" method="post">
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalTitle">用户登录</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 ps-5 pe-5">
                    账号
                    <input type="text" name='uid' class='form-control' required minlength='3' maxlength='20'>
                    密码
                    <input type="password" name='pwd' class='form-control' required minlength='6' maxlength='20'>
                    验证码
                    <input type="text" name='yzm' class='form-control' required>
                    <img src="yzm.php" onclick="this.src+='?'">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button class="btn btn-primary">登录</button>
                </div>
                </div>
            </div>
        </div>
    </form>

    <!-- 3.发布话题 -->
    <form action="chatSave.php" method="post">
        <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalTitle">发布新话题</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 ps-5 pe-5">
                    标题
                    <input type="text" name="title" class="form-control">
                    内容
                    <textarea name="content" rows="5" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button class="btn btn-primary">提交</button>
                </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>