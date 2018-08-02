<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>推荐位管理</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <style>
        .separator{
            height: 30px;
        }
        td,th{
            text-align: center;
        }
    </style>
    <script>
        var dele = "<?php echo U('deleterecommend');?>";
    </script>
    <script src="../Public/Js/manage.js"></script>
</head>
<body>
    <div class="container">
        <div class="separator"></div>
        <p><a href="__URL__/addrecommend" class="btn btn-primary">添加推荐位</a> </p>
        <table class="table table-hover table-condensed table-striped table-bordered">
            <tr>
                <th></th>
                <th>ID</th>
                <th>推荐位名称</th>
                <th>修改</th>
                <th>删除</th>
            </tr>
            <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
                    <td><input type="checkbox" uid="<?php echo ($row[id]); ?>"></td>
                    <td><?php echo ($row[id]); ?></td>
                    <td><?php echo ($row[name]); ?></td>
                    <td><a href="__URL__/editrecommend/id/<?php echo ($row['id']); ?>" target="right">修改</a></td>
                    <td><a href="javascript:" class="del" uid="<?php echo ($row[id]); ?>">删除</a></td>
                </tr><?php endforeach; endif; ?>
            <tr>
                <td colspan="1">
                    <a href="javascript:" class="all">全选</a>
                </td>
                <td colspan="1">
                    <a href="javascript:" class="delall">删除</a>
                </td>
                <td colspan="6"><?php echo ($show); ?></td>
            </tr>
        </table>
    </div>
    <script>
        $('.del').click(function () {
            if (window.confirm('确定删除吗?')) {
                location = "<?php echo U('deleterecommend');?>" + "/id/" + $(this).attr('uid');
            }
        });
    </script>
</body>
</html>