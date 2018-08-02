<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>查看栏目下的内容</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Public/Css/showcons.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <script>
        URL = "<?php echo U('deletecons');?>";
        var dele = URL + "/type/<?php echo ($_GET['type']); ?>";
    </script>
    <script src="../Public/Js/manage.js"></script>
</head>
<body>
<?php if($_GET['type'] != 3): ?><p class="menu"><a href="__URL__/addcons/id/<?php echo ($_GET['classid']); ?>/type/<?php echo ($_GET['type']); ?>" class="btn btn-primary"
                   target="right">添加内容</a></p><?php endif; ?>
<p class="wh" classid="<?php echo ($_GET['classid']); ?>"></p>
<?php if(!empty($rows)): ?><!--文章模型内容start-->
    <?php if($_GET['type'] == 1): ?><p>内容类型:文章</p>
        <table class="table table-hover table-condensed table-striped table-bordered">
            <tr>
                <th></th>
                <th>ID</th>
                <th>标题</th>
                <th>来源</th>
                <th>关键词</th>
                <th>本周访问量</th>
                <th>添加时间</th>
                <th>修改</th>
                <th>删除</th>
            </tr>
            <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
                    <td><input type="checkbox" uid="<?php echo ($row[id]); ?>"></td>
                    <td><?php echo ($row[id]); ?></td>
                    <td><?php echo mb_substr($row[title],0,15,'utf8');?></td>
                    <td><?php echo htmlspecialchars_decode($row[source]);?></td>
                    <td><?php echo mb_substr($row[keywords],0,12,'utf8');?></td>
                    <td><?php echo ($row[weekviews]); ?></td>
                    <td><?php echo date('Y-m-d H:i:s',$row[inputtime]);?></td>
                    <td><a href="__URL__/editcons/id/<?php echo ($row['id']); ?>/type/<?php echo ($_GET['type']); ?>" target="right">修改</a></td>
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
                    <?php switch($order): case "1": ?><a href="?seq=0">按最新添加排序</a><?php break;?>
                        <?php case "0": ?><a href="?seq=1">按最早添加排序</a><?php break; endswitch;?>
                </td>
                <td colspan="6"><?php echo ($show); ?></td>
            </tr>
        </table>
        <!--文章模型内容end-->

        <!--音乐模型内容start-->
        <?php elseif($_GET['type'] == 2): ?>
        <p class="type" type="<?php echo ($_GET['type']); ?>">内容类型:音乐</p>
        <table class="table table-hover table-condensed table-striped table-bordered">
            <tr>
                <th></th>
                <th>ID</th>
                <th>歌曲名</th>
                <th>简介</th>
                <th>来源</th>
                <th>添加时间</th>
                <th>修改</th>
                <th>删除</th>
            </tr>
            <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
                    <td><input type="checkbox" uid="<?php echo ($row[id]); ?>"></td>
                    <td><?php echo ($row[id]); ?></td>
                    <td><?php echo mb_substr($row[title],0,15,'utf8');?></td>
                    <td><?php echo mb_substr($row[description],0,15,'utf8');?></td>
                    <td><?php echo ($row[source]); ?></td>
                    <td><?php echo date('Y-m-d H:i:s',$row[inputtime]);?></td>
                    <td><a href="__URL__/editcons/id/<?php echo ($row['id']); ?>/type/<?php echo ($_GET['type']); ?>" target="right">修改</a></td>
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
                    <?php switch($order): case "1": ?><a href="?seq=0">按最新添加排序</a><?php break;?>
                        <?php case "0": ?><a href="?seq=1">按最早添加排序</a><?php break; endswitch;?>
                </td>
                <td colspan="6"><?php echo ($show); ?></td>
            </tr>
        </table>
        <!--音乐模型内容end-->
        <!--说说模型内容start-->
        <?php elseif($_GET['type'] == 3): ?>
        <p>内容类型:说说</p>
        <table class="table table-hover table-condensed table-striped table-bordered">
            <tr>
                <th></th>
                <th>ID</th>
                <th>标题</th>
                <th>发表用户</th>
                <th>发表时间</th>
                <th>获赞数</th>
                <th>修改</th>
                <th>删除</th>
            </tr>
            <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
                    <td><input type="checkbox" uid="<?php echo ($row[id]); ?>"></td>
                    <td><?php echo ($row[id]); ?></td>
                    <td><?php echo mb_substr($row[title],0,15,'utf8');?></td>
                    <td><?php echo ($row[user]); ?></td>
                    <td><?php echo date('Y-m-d H:i:s',$row[inputtime]);?></td>
                    <td><?php echo ($row[num]); ?></td>
                    <td><a href="__URL__/editcons/id/<?php echo ($row['id']); ?>/type/<?php echo ($_GET['type']); ?>" target="right">修改</a></td>
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
                    <?php switch($order): case "1": ?><a href="?seq=0">按最新添加排序</a><?php break;?>
                        <?php case "0": ?><a href="?seq=1">按最早添加排序</a><?php break; endswitch;?>
                </td>
                <td colspan="6"><?php echo ($show); ?></td>
            </tr>
        </table>
        <!--说说模型内容end-->
        <!--视频模型内容start-->
        <?php elseif($_GET['type'] == 4): ?>
        <p class="type" type="<?php echo ($_GET['type']); ?>">内容类型:视频</p>
        <table class="table table-hover table-condensed table-striped table-bordered">
            <tr>
                <th></th>
                <th>ID</th>
                <th>视频标题</th>
                <th>简介</th>
                <th>添加时间</th>
                <th>修改</th>
                <th>删除</th>
            </tr>
            <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
                    <td><input type="checkbox" uid="<?php echo ($row[id]); ?>"></td>
                    <td><?php echo ($row[id]); ?></td>
                    <td><?php echo mb_substr($row[title],0,15,'utf8');?></td>
                    <td><?php echo mb_substr($row[description],0,15,'utf8');?></td>
                    <td><?php echo date('Y-m-d H:i:s',$row[inputtime]);?></td>
                    <td><a href="__URL__/editcons/id/<?php echo ($row['id']); ?>/type/<?php echo ($_GET['type']); ?>" target="right">修改</a></td>
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
                    <?php switch($order): case "1": ?><a href="?seq=0">按最新添加排序</a><?php break;?>
                        <?php case "0": ?><a href="?seq=1">按最早添加排序</a><?php break; endswitch;?>
                </td>
                <td colspan="6"><?php echo ($show); ?></td>
            </tr>
        </table>
        <!--视频模型内容end--><?php endif; ?>
    <?php else: ?>
    <p class="empty">
        此栏目下没有内容
    </p><?php endif; ?>
<script>
    $('.del').click(function () {
        if (window.confirm('确定删除吗?')) {
            location = "<?php echo U('deletecons');?>" + "/id/" + $(this).attr('uid') + "/type/" + "<?php echo ($_GET['type']); ?>";
        }
    });
</script>
</body>
</html>