<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>用户管理</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <script src="__PUBLIC__/Js/jquery.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <script>
        var dele="<?php echo U('delete');?>";
    </script>
    <script src="../Public/Js/manage.js"></script>
    <style>
        th,td{
            text-align: center;
            vertical-align: middle!important;
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
    </style>
</head>
<body>
<p class="menu"><a href="__URL__/manage">用户管理</a><span>|</span><a href="__URL__/adduser">添加用户</a><span>|</span> </p>
<table class="table table-hover table-condensed table-striped table-bordered">
    <tr>
        <th></th>
        <th>ID</th>
        <th>用户名</th>
        <th>头像</th>
        <th>邮箱</th>
        <th>添加时间</th>
        <th>上次登录时间</th>
        <th>修改</th>
        <th>删除</th>
    </tr>
    <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
            <td><input type="checkbox" uid="<?php echo ($row[id]); ?>"></td>
            <td><?php echo ($row[id]); ?></td>
            <td><?php echo ($row['username']); ?></td>
            <td>
                <?php if(!empty($row['img'])): ?><img src="<?php echo ($row['img']); ?>" width="50px" height="50px">
                    <?php else: ?>
                    无<?php endif; ?>
            </td>
            <td><?php echo ($row['email']); ?></td>
            <td><?php echo date('Y年m月d日 H:i',$row['regtime']);?></td>
            <td><?php echo date('Y年m月d日 H:i',$row['lastred']);?></td>
            <td><a href="__URL__/edituser/id/<?php echo ($row['id']); ?>">修改</a> </td>
            <td><a href="javascript:" class="del" uid="<?php echo ($row[id]); ?>">删除</a> </td>
        </tr><?php endforeach; endif; ?>
    <tr>
        <td colspan="1">
            <a href="javascript:" class="all">全选</a>
        </td>
        <td colspan="1">
            <a href="javascript:" class="delall">删除</a>
        </td>
        <td colspan="1">
            <?php if($order==1): ?><a href="?seq=0">倒序</a>
                <?php else: ?>
                <a href="?seq=1">正序</a><?php endif; ?>
        </td>
        <td colspan="6"><?php echo ($show); ?></td>
    </tr>
</table>
<script>
    $('.del').click(function(){
        if(window.confirm('确定删除吗?')){
            location="<?php echo U('delete');?>"+"/id/"+$(this).attr('uid');
        }
    });
</script>
</body>
</html>