<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>修改管理员信息</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <script src="../Public/js/showupload.js"></script>
    <style>
        .Station{
            height:30px;
        }
        iframe{
            display: none;
        }
    </style>
    <script>
        var ins="<?php echo U('update');?>";
        var upload="<?php echo U('upload');?>";
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="Station"></div>
        <h1><span class="glyphicon glyphicon-wrench"></span>修改管理员信息</h1>
        <form action="__URL__/update" method="post" enctype="multipart/form-data" target="">
            <div class="form-group">
                <label >管理员名</label>
                <input type="text" class="form-control" name="username" placeholder="管理员名" value="<?php echo ($row['username']); ?>" disabled="disabled">
            </div>
            <input type="hidden" name="id" value="<?php echo ($row['id']); ?>">
            <div class="form-group">
                <label >原密码</label>
                <input type="password" name="password" class="form-control"  placeholder="原密码">
            </div>
            <div class="form-group">
                <label >新密码</label>
                <input type="password" name="newpassword" class="form-control"  placeholder="">
            </div>

            <div class="form-group">
                <label >邮箱</label>
                <input type="email" name="email" class="form-control"  placeholder="邮箱" value="<?php echo ($row['email']); ?>">
            </div>
            <div class="form-group">
                <label >上传头像</label>
                <input type="file" name="img" class="form-control">
                <img src="<?php echo ($row['img']); ?>"  width="100px" height="100px" alt=""><span>替换为</span><img src="" class="view" width="100px" height="100px" alt="">
                <p class="text-danger">(*如不需要改变头像可以不用上传)</p>
                <input type="hidden" name="head" value="<?php echo ($row['img']); ?>">
                <input type="hidden" value="<?php echo ($row['img']); ?>" class="help">
            </div>
            <input type="hidden" name="admin" value="1">
            <input type="hidden" name="examine" value="1">
            <button type="submit" class="btn btn-default">确认</button>
        </form>
    </div>
    <iframe name="uploadbox"></iframe>
</div>
</body>
</html>