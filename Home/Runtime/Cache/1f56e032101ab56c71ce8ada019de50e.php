<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="__TMPL__/Follow/follow.css">
    <script src="__TMPL__/Follow/jquery.js"></script>
    <script>
        var addfollow="<?php echo U('addfollow');?>";
        var userid="<?php echo ($userid); ?>";
        var typeid="<?php echo ($typeid); ?>";
        var id="<?php echo ($tid); ?>";
    </script>
    <script src="__TMPL__/Follow/follow.js"></script>
</head>
<body>
<!--点赞收藏start-->
    <?php if($isfollow == 1): ?><button type="button" class="btn have">已经关注</button>
            <?php else: ?>
            <button type="button" class="btn now">关注</button><?php endif; ?>
<div class="tip"></div>
<!--点赞收藏end-->
</body>
</html>