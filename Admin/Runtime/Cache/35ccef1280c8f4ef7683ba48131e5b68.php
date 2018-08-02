<?php if (!defined('THINK_PATH')) exit(); if(is_array($rows)): foreach($rows as $key=>$row): ?><div class="item">
        <img src="<?php echo ($row['url']); ?>" width="100px" height="100px"><span class="del">X</span><input type="hidden" name="item" value="<?php echo ($row['url']); ?>" >
    </div><?php endforeach; endif; ?>