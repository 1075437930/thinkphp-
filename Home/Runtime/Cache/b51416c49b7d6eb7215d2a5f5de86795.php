<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>

    <link rel="stylesheet" href="__TMPL__/Fabcoll/fabcoll.css">
    <script src="__TMPL__/Fabcoll/jquery.js"></script>
    <script>
        var addfab="<?php echo U('addfab');?>";
        var userid="<?php echo ($userid); ?>";
        var typeid="<?php echo ($typeid); ?>";
        var id="<?php echo ($tid); ?>";
        var collhand="<?php echo U('collhand');?>";
    </script>
    <script src="__TMPL__/Fabcoll/fabcoll.js"></script>

</head>
<body>
<!--点赞收藏start-->
<div class="fabcoll">
    <a href="javascript:" class="fabulous">
        <?php if($isfab == 1): ?><i class="fab_tb" style="background-position: -58px  -165px;"></i>
            <?php else: ?>
            <i class="fab_tb" style="background-position: -40px -165px;"></i><?php endif; ?>
        <span>(<?php echo ($fabnum); ?>)</span>
    </a>
    <a href="javascript:" class="coll">
        <?php if($iscoll == 1): ?><i class="coll_tb" style="background-position: -98px  -165px;"></i>
            <?php else: ?>
            <i class="coll_tb" style="background-position: -80px -165px;"></i><?php endif; ?>
        <span>(<?php echo ($collnum); ?>)</span>
    </a>
</div>
<div class="tip"></div>
<!--点赞收藏end-->
</body>
</html>