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
        <table class="table table-hover table-condensed table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>专题名</th>
                <th>修改</th>
                <th>删除</th>
            </tr>
            <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
                    <td><?php echo ($row['id']); ?></td>
                    <td><?php echo ($row['name']); ?></td>
                    <td><a href="__URL__/editspecial/id/<?php echo ($row['id']); ?>">修改</a> </td>
                    <td><a href="__URL__/delspecial/id/<?php echo ($row['id']); ?>">删除</a> </td>
                </tr><?php endforeach; endif; ?>
        </table>
    </div>
</body>
</html>