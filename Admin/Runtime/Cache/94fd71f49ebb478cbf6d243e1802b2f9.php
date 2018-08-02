<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>管理内容</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Public/Css/substance.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <script src="../Public/Js/substance.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <ul class="tree">
                    <?php if(is_array($rows)): foreach($rows as $key=>$row): if($row['haveson']==1): ?><li><a href="javascript:" ><?php echo ($row['tree']); ?></a><img src="../Public/Images/z.jpg" width="20px" height="20px"></li>
                            <?php else: ?>
                            <li><a href="__URL__/showcons/classid/<?php echo ($row['id']); ?>/type/<?php echo ($row['typeid']); ?>" target="ri" class="bot" classid="<?php echo ($row['id']); ?>"><?php echo ($row['tree']); ?></a><span class="
glyphicon glyphicon-arrow-left" style="display: none;"></span></li><?php endif; endforeach; endif; ?>
                </ul>
            </div>
            <div class="col-md-10">
                <iframe name="ri" width="100%" height="480px">

                </iframe>
            </div>
        </div>
    </div>
</body>
</html>