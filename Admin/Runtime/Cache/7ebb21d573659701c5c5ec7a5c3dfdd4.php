<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>管理广告</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <style>
        th,td{
            text-align: center;
        }
        .opt{
            margin-top: 10px;
        }
    </style>
    <script>
        var dele = "<?php echo U('delete');?>";
    </script>
    <script src="../Public/Js/manage.js"></script>
</head>
<body>
<div class="container-fluid">
    <p class="opt"><a href="__URL__/add" class="btn btn-primary">添加广告</a></p>
    <table class="table table-hover table-condensed table-striped table-bordered">
        <tr>
            <th></th>
            <th>ID</th>
            <th>广告标题</th>
            <th>添加时间</th>
            <th>修改</th>
            <th>删除</th>
        </tr>
        <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
                <td><input type="checkbox" uid="<?php echo ($row[id]); ?>"></td>
                <td><?php echo ($row['id']); ?></td>
                <td><?php echo mb_substr($row[title],0,15,'utf8');?></td>
                <td><?php echo date('Y-m-d H:i:s',$row[inputtime]);?></td>
                <td><a href="__URL__/edit/id/<?php echo ($row['id']); ?>">修改</a> </td>
                <td><a href="javascript:" class="del" uid="<?php echo ($row[id]); ?>">删除</a></td>
            </tr><?php endforeach; endif; ?>
        <tr>
            <td colspan="1">
                <a href="javascript:" class="all">全选</a>
            </td>
            <td colspan="1">
                <a href="javascript:" class="delall">删除</a>
            </td>

            <td colspan="1">
                <?php switch($order): case "1": ?><a href="?seq=0">按最新评论排序</a><?php break;?>
                    <?php case "0": ?><a href="?seq=1">按最早评论排序</a><?php break; endswitch;?>
            </td>
            <td colspan="6"><?php echo ($show); ?></td>
        </tr>
    </table>
</div>
<script>
    $('.del').click(function () {
        if (window.confirm('确定删除吗?')) {
            location = "<?php echo U('delete');?>" + "/id/" + $(this).attr('uid');
        }
    });
</script>
</body>
</html>