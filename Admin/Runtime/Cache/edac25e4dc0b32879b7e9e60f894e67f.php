<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>管理栏目</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Public/Css/colheader.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
</head>
<body>
<p class="menu">
    <?php if(ACTION_NAME==column): ?><a href="__URL__/column" class="active">管理栏目</a>
        <?php else: ?>
        <a href="__URL__/column" >管理栏目</a><?php endif; ?>
    <span>|</span>
    <?php if(ACTION_NAME==addcolumn): ?><a href="__URL__/addcolumn" class="active">添加新栏目</a>
        <?php else: ?>
        <a href="__URL__/addcolumn" >添加新栏目</a><?php endif; ?>
    <span>|</span>
</p>
<script>
    var dele="<?php echo U('deletecolumn');?>";
</script>
<script src="../Public/Js/manage.js"></script>
<table class="table table-hover table-condensed table-striped table-bordered">
    <tr>
        <th></th>
        <th>ID</th>
        <th>栏目名称</th>
        <th>栏目模型</th>
        <th>修改</th>
        <th>删除</th>
    </tr>
    <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
            <td><input type="checkbox" uid="<?php echo ($row[id]); ?>"></td>
            <td><?php echo ($row['id']); ?></td>
            <td><?php echo ($row['tree']); ?><a href="__URL__/addson/id/<?php echo ($row['id']); ?>" class="pull-right" title="添加子栏目"><span class="glyphicon glyphicon-plus"></span></a></td>
            <td>
                <?php if($row['pid']==0): echo ($row['type']); ?>
                    <?php else: ?>
                    <span class="glyphicon glyphicon-arrow-up"></span><?php endif; ?>
            </td>
            <td><a href="__URL__/editcolumn/id/<?php echo ($row['id']); ?>">修改</a> </td>
            <td><a href="javascript:" class="del" uid="<?php echo ($row['id']); ?>">删除</a> </td>
        </tr><?php endforeach; endif; ?>
    <tr>
        <td colspan="1">
            <a href="javascript:" class="all">全选</a>
        </td>
        <td colspan="1">
            <a href="javascript:" class="delall">删除</a>
        </td>
        <td colspan="5"><?php echo ($show); ?></td>
    </tr>
</table>
<script>
    $('.del').click(function(){
        if(window.confirm('确定删除吗?')){
            location="<?php echo U('deletecolumn');?>"+"/id/"+$(this).attr('uid');
        }
    });
</script>
</body>
</html>