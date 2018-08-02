<?php if (!defined('THINK_PATH')) exit(); if(is_array($rows)): foreach($rows as $key=>$row): ?><div class="user_item">
        <?php if(!empty($row['img'])): ?><img src="<?php echo ($row['img']); ?>">
            <?php else: ?>
            <img src="__TMPL__/Chat/po.jpg"><?php endif; ?>
        <span><?php echo ($row['username']); ?></span>
        <div class="clear"></div>
    </div><?php endforeach; endif; ?>