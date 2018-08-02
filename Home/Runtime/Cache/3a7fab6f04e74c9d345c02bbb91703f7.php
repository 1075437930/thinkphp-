<?php if (!defined('THINK_PATH')) exit();?><div class="chat_heading">
    <span>私信</span>
    <div class="chat_close">X</div>
    <button>新私信</button>
</div>
<div class="chat_item_box">
    <?php if(is_array($chats)): foreach($chats as $key=>$row): ?><figure vid="<?php echo ($row['user']['id']); ?>">
            <?php if(!empty($row['user']['img'])): ?><img src="<?php echo ($row['user']['img']); ?>" >
                <?php else: ?>
                <img src="__TMPL__/Chat/po.jpg" /><?php endif; ?>
            <figcaption><?php echo ($row['user']['username']); ?></figcaption>
            <div class="clear"></div>
        </figure><?php endforeach; endif; ?>
</div>