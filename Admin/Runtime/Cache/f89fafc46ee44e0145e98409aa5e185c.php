<?php if (!defined('THINK_PATH')) exit(); if(isset($t)): ?><option value="" disabled>选择</option>
    <option value="<?php echo ($t[id]); ?>"><?php echo ($t[name]); ?></option>
    <?php else: ?>
    <option value="" disabled>选择</option>
    <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><option value="<?php echo ($row[id]); ?>" ><?php echo ($row[name]); ?></option><?php endforeach; endif; endif; ?>