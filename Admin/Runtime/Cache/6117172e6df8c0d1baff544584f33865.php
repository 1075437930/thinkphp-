<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>添加管理员</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <script src="../Public/js/showupload.js"></script>
    <style>
        .Station{
            height:10px;
        }
        iframe{
            display: none;
        }
        .menu{
            height: 40px;
            line-height: 40px;
            border-bottom: 1px solid #ededed;
        }
        .menu span{
            color: #ededed;
        }
        .menu a{
            margin-left: 14px;
        }
        form{
            width: 90%;
            margin: 0 auto;
        }
    </style>
    <script>
        var ins="<?php echo U('insert');?>";
        var upload="<?php echo U('upload');?>";
    </script>
</head>
<body>
        <p class="menu"><a href="__URL__/admin">管理员信息</a><span>|</span><a href="__URL__/add">添加管理员</a><span>|</span> </p>
    <form action="__URL__/insert" method="post" enctype="multipart/form-data" target="">
        <div class="form-group">
            <label >管理员名</label>
            <input type="text" class="form-control" name="username" placeholder="管理员名">
        </div>
        <div class="form-group">
            <label >密码</label>
            <input type="password" name="password" class="form-control"  placeholder="密码">
        </div>
        <div class="form-group">
            <label >确认密码</label>
            <input type="password" name="repassword" class="form-control"  placeholder="">
        </div>

        <div class="form-group">
            <label >邮箱</label>
            <input type="email" name="email" class="form-control"  placeholder="邮箱">
        </div>
        <div class="form-group">
            <label >上传头像</label>
            <input type="file" name="img" class="form-control">
            <img src="" class="view" width="100px" height="100px" alt="">
        </div>
        <input type="hidden" name="admin" value="1">
        <input type="hidden" name="examine" value="1">
        <input type="hidden" name="head" value="">
        <button type="submit" class="btn btn-default">确认</button>
    </form>

    <iframe name="uploadbox"></iframe>

</body>
</html>