<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>修改广告</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <script src="../Public/Js/main.js"></script>
    <script src="../Public/Js/addadver.js"></script>
    <style>
        .opt{
            margin-top: 10px;
        }
        #preview{
            display: inline-block;
        }
    </style>

</head>
<body>
<div class="container-fluid">
    <p class="opt"><a href="__URL__/index" class="btn btn-danger">广告管理</a> </p>
    <form action="__URL__/update" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>广告标题</label>
            <input type="text" name="title" class="form-control" value="<?php echo ($row['title']); ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo ($row['id']); ?>">
        <div class="form-group">
            <label>广告连接</label>
            <input type="text" name="link" class="form-control" value="<?php echo ($row['url']); ?>">
        </div>
        <div class="form-group">
            <label>广告图片</label>
            <input type="file" name="img" class="form-control" onchange="previewImage(this)"  id="previewImg">
            <img src="__PUBLIC__/Uploads/adver/<?php echo ($row['img']); ?>" width="200px" height="200px">
            <span>替换为</span>
            <div id="preview"></div>
            <p class="text-danger">(*如不需要改变缩略图可以不用上传)</p>
        </div>
        <div class="form-group">
            <label>位置选择</label>
            <div class="checkbox">
                <?php if(is_array($pos)): foreach($pos as $key=>$row2): ?><label>
                        <?php if(in_array($row2['id'],$posi)): ?><input type="checkbox" value="<?php echo ($row2['id']); ?>" checked> <?php echo ($row2['name']); ?>
                            <?php else: ?>
                            <input type="checkbox" value="<?php echo ($row2['id']); ?>"> <?php echo ($row2['name']); endif; ?>
                    </label>
                    &nbsp;<?php endforeach; endif; ?>
                <input type="hidden" name="position" value="">
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </form>
</div>
</body>
</html>