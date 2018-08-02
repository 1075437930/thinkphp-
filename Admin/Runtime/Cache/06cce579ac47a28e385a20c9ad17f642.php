<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>添加广告</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <script src="../Public/Js/main.js"></script>
    <script src="../Public/Js/addadver.js"></script>
    <style>
        .opt{
            margin-top: 10px;
        }

    </style>

</head>
<body>
    <div class="container-fluid">
        <p class="opt"><a href="__URL__/index" class="btn btn-danger">广告管理</a> </p>
        <form action="__URL__/insert" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>广告标题</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label>广告连接</label>
                <input type="text" name="link" class="form-control">
            </div>
            <div class="form-group">
                <label>广告图片</label>
                <input type="file" name="img" class="form-control" onchange="previewImage(this)"  id="previewImg">
                <div id="preview"></div>
            </div>
            <div class="form-group">
                <label>位置选择</label>
                <div class="checkbox">
                    <?php if(is_array($pos)): foreach($pos as $key=>$row): ?><label>
                            <input type="checkbox" value="<?php echo ($row['id']); ?>"> <?php echo ($row['name']); ?>
                        </label>
                        &nbsp;<?php endforeach; endif; ?>
                </div>
            </div>
            <input type="hidden" name="position" value="">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </form>
    </div>
</body>
</html>