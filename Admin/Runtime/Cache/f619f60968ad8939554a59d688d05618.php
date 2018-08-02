<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>管理员信息</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
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
<p class="menu"><a href="__URL__/admin">管理员信息</a><span>|</span><a href="__URL__/add">添加管理员</a><span>|</span> </p>
    <table class="table table-hover table-condensed table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>管理员名</th>
            <th>头像</th>
            <th>邮箱</th>
            <th>添加时间</th>
            <th>上次登录时间</th>
            <th>修改</th>
            <th>删除</th>
        </tr>
        <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
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
                <td><a href="__URL__/edit/id/<?php echo ($row['id']); ?>">修改</a> </td>
                <td><a href="javascript:" class="del" uid="<?php echo ($row[id]); ?>">删除</a> </td>

            </tr><?php endforeach; endif; ?>
        <tr>
            <td colspan="8"><?php echo ($show); ?></td>
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