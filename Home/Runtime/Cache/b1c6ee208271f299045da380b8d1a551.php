<?php if (!defined('THINK_PATH')) exit(); if(is_array($says)): foreach($says as $key=>$row): ?><figure class="sat_item">
        <img src="<?php echo ($row['user']['img']); ?>">
        <figcaption>
            <p class="say_heading"><a><?php echo ($row['user']['username']); ?></a><time><?php echo date('Y-m-d H:i:s',$row['inputtime']);?></time></p>
            <p><?php echo ($row['content']); ?></p>
            <div class="source">
                <?php echo htmlspecialchars_decode($row['source']);?>
            </div>
            <div class="forward"><?php echo htmlspecialchars_decode($row['forward']);?></div>
            <div class="opt">
                <i class="replay_tb" vid="<?php echo ($row['id']); ?>"></i>
                <i class="share_tb"></i>
                <!--加载点赞分享模块start-->
                <iframe class='fabcoll' src="__APP__/Fabcoll/index/id/<?php echo ($row['id']); ?>/type/3"  scrolling="no">
                </iframe>
                <!--加载点赞分享模块end-->
                <div class="clear"></div>
            </div>
        </figcaption>
        <div class="clear"></div>
    </figure><?php endforeach; endif; ?>