<?php if (!defined('THINK_PATH')) exit();?>
<div class="replay_heading">
    <img src="<?php echo ($row['user']['img']); ?>">
    <a href=""><?php echo ($row['user']['username']); ?></a>
    <!--加载关注模块start-->
    <iframe class='follow' src="__APP__/Follow/index/id/<?php echo ($row['user']['id']); ?>/type/1"
            width="100px" scrolling="no">
    </iframe>
    <!--加载关注模块end-->
    <div class="clear"></div>
</div>
<div class="replay_box_con">
    <?php echo ($row['content']); ?>
</div>
<div class="source">
    <?php echo htmlspecialchars_decode($row['source']);?>
</div>
<time><?php echo date('Y-m-d H:i:s',$row['inputtime']);?></time>
<!--加载评论模块start-->
<iframe class='iframeId' src="__APP__/Comment/index/id/<?php echo ($row['id']); ?>/type/3"
        width="100%" scrolling="no">
</iframe>
<!--加载评论模块end-->