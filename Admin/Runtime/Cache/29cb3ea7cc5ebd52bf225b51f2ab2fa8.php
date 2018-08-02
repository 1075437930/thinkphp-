<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Public/Css/artispecial.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <style>
        p{
            margin: 20px auto;
        }
    </style>
</head>
<body>
<div class="container">
    <p>
        <a href="__URL__/artispecial">专题管理</a>
        <a href="__URL__/addspecial">添加专题</a>
    </p>
<form action="__URL__/updatespecial" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>专题名</label>
        <input type="text" class="form-control" name="name" value="<?php echo ($row['name']); ?>">
    </div>
    <div class="form-group">
        <label>专题描述</label>
        <input type="text" class="form-control" name="describe" value="<?php echo ($row['describe']); ?>">
    </div>
    <input type="hidden" name="id" value="<?php echo ($row['id']); ?>">
    <div class="form-group">
        <label>上传专题图片</label>
        <input type="file" name="img" class="form-control">
        <img src="<?php echo ($row['img']); ?>"  class="img-thumbnail">
        <p class="text-danger">(如无需改变可不用上传)</p>
    </div>
    <div class="form-group">
        <input type="submit" value="修改" class="form-control">
    </div>
</form>
</body>
</html>