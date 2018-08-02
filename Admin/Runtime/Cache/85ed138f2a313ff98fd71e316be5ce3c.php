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
<script src="../Public/Js/showchoose/showchoose.js"></script>
<style>
    h1{
        width: 90%;
        margin: 0 auto;
    }
</style>
<h1><span class="glyphicon glyphicon-wrench"></span>修改栏目信息</h1>
<form action="__URL__/updatecolumn" method="post"  target="" enctype="multipart/form-data">
    <div class="form-group">
        <label >栏目名称</label>
        <input type="text" class="form-control" name="name" placeholder="栏目名" value="<?php echo ($row['name']); ?>">
    </div>
    <div class="form-group">
        <label >选择父栏目</label>
        <select name="father" class="form-control">
            <option value="" disabled>选择</option>
            <?php if($row['pid']==0): ?><option value="0" class="ebled" selected>顶级栏目</option>
                <?php else: ?>
                <option value="0" class="ebled">顶级栏目</option><?php endif; ?>
            <option value="" disabled class="text-danger">- - - - - - - </option>
            <?php if(is_array($rows)): foreach($rows as $key=>$row2): if($row['pid']==$row2['id']): ?><option value="<?php echo ($row2['id']); ?>" class="ebled" selected><?php echo ($row2['tree']); ?></option>
                    <?php else: ?>
                    <option value="<?php echo ($row2['id']); ?>" class="ebled"><?php echo ($row2['tree']); ?></option><?php endif; endforeach; endif; ?>
        </select>
    </div>
    <div class="form-group">
        <label>上传栏目图片</label>
        <input type="file" name="img" class="form-control" onchange="previewImage(this)"  id="previewImg">
        <img src="__PUBLIC__/Uploads/column/<?php echo ($row['img']); ?>" width="150px" height="150px">
        <span>替换为</span>
        <div id="preview" style="display: inline-block"></div>
    </div>
    <input type="hidden" name="id" value="<?php echo ($row['id']); ?>">
    <div class="form-group">
        <label>栏目简介</label>
        <input type="text" name="description" class="form-control">
    </div>
    <div class="form-group">
        <label >选择模型</label>
        <select name="model" class="form-control">
            <option value="" disabled>选择</option>
            <?php if(is_array($types)): foreach($types as $key=>$row3): if($row['typeid']==$row3['id']): ?><option value="<?php echo ($row3[id]); ?>" selected><?php echo ($row3[name]); ?></option>
                    <?php else: ?>
                    <option value="<?php echo ($row3[id]); ?>" ><?php echo ($row3[name]); ?></option><?php endif; endforeach; endif; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-default">确认</button>
</form>
</body>
</html>