<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <title>添加推荐位</title>
    <style>
        .separator{
            height: 30px;
        }
        td,th{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="separator"></div>
        <p class="menu"><a href="javascript:" class="btn btn-danger" onclick="history.back();">返回推荐位管理</a> </p>
    <form action="__URL__/insertrecommend" method="post">
        <div class="form-group">
            <label>推荐位名称</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">提交</button>
        </div>
    </form>
    </div>
</body>
</html>