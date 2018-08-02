<?php if (!defined('THINK_PATH')) exit();?><div class="chatwindow_heading">
    <i class="reback"></i>
    <?php if(!empty($row['img'])): ?><img src="<?php echo ($row['img']); ?>">
        <?php else: ?>
        <img src="../Public/Images/po.jpg"><?php endif; ?>
    <span><?php echo ($row['username']); ?></span>
    <div class="clear"></div>
</div>

<div  class="chat_con">

</div>

<div class="chat_bot" vid="<?php echo ($row['id']); ?>">
    <div contenteditable="true" id="saytext3"></div>
    <i class="chat_expression"></i>
    <button class="chat_btn">发送</button>
    <div class="clear"></div>
</div>