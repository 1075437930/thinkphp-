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
    var getmodel="<?php echo U('getmodel');?>";
</script>
<script src="../Public/Js/cascade.js"></script>
<h1>添加子栏目</h1>
<form action="__URL__/insertcolumn" method="post"  target="">
    <div class="form-group">
        <label >栏目名称</label>
        <input type="text" class="form-control" name="name" placeholder="栏目名">
    </div>
    <div class="form-group">
        <label >父栏目</label>
        <select name="father" class="form-control">
            <option value="" disabled>选择</option>
            <option value="<?php echo ($row['id']); ?>" class="ebled"><?php echo ($row['name']); ?></option>
        </select>
    </div>
    <div class="form-group">
        <label >模型</label>
        <select name="model" class="form-control">
            <option value="" disabled>选择</option>
            <option value="<?php echo ($t[id]); ?>"><?php echo ($t[name]); ?></option>
        </select>
    </div>
    <button type="submit" class="btn btn-default">确认</button>
</form>
</body>
</html>