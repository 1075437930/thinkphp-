<?php if (!defined('THINK_PATH')) exit(); if(is_array($arrs)): foreach($arrs as $key=>$row): if($row['id'] == $_SESSION['userid']): ?><div class="chat_item_from">
             <?php if(!empty($row['user']['img'])): ?><img src="<?php echo ($row['user']['img']); ?>" class="headport">
                  <?php else: ?>
                  <img src="../Public/Images/po.jpg" class="headport" /><?php endif; ?>
            <div class="chat_text">
                 <div>
                      <?php echo htmlspecialchars_decode($row['content']);?>
                 </div>
                 <time><?php echo date('Y-m-d H:i:s',$row['time']);?></time>
             </div>
            <div class="clear"></div>
        </div>
        <?php else: ?>
        <div class="chat_item_to">
            <?php if(!empty($row['user']['img'])): ?><img src="<?php echo ($row['user']['img']); ?>" class="headport">
                <?php else: ?>
                <img src="../Public/Images/po.jpg" class="headport" /><?php endif; ?>
            <div class="chat_text">
                <div>
                    <?php echo htmlspecialchars_decode($row['content']);?>
                </div>
                <time><?php echo date('Y-m-d H:i:s',$row['time']);?></time>
            </div>
            <div class="clear"></div>
        </div><?php endif; endforeach; endif; ?>