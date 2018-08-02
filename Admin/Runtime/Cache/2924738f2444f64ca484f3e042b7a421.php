<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>查看评论</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <style>
        p{
            font-size: 20px;
        }
        .info{
            border: 1px solid #1F7099;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <p >
            <a href="javascript:" class="btn btn-danger" onclick="history.back();">返回</a>        </p>
        <p class="btn-primary">被评论的内容标题</p>
        <p class="info"><?php echo ($row['title']); ?></p>

        <p class="btn-primary">评论用户</p>
        <p class="info"><?php echo ($row['user']); ?></p>

        <p class="btn-primary">评论内容</p>
        <p class="info"> <?php echo htmlspecialchars_decode($row['content']);?></p>
    </div>
</body>
</html>