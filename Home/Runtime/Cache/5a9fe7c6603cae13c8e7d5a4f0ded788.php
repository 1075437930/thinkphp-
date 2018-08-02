<?php if (!defined('THINK_PATH')) exit(); if(is_array($remens)): foreach($remens as $key=>$row): if($key == 0): ?><figure class="hot_fr">
            <a href="__URL__/artcon/id/<?php echo ($row['id']); ?>">
                <?php echo ($row['img']); ?>
                <figcaption><?php echo ($row['title']); ?></figcaption>
            </a>
        </figure>
        <?php else: ?>
        <figure class="hot_item">
            <a href="__URL__/artcon/id/<?php echo ($row['id']); ?>">  <?php echo ($row['img']); ?></a>
            <figcaption>
                <p><a href="__URL__/artcon/id/<?php echo ($row['id']); ?>"><?php echo ($row['title']); ?></a></p>
                <span class="category"><?php echo ($row['cate']); ?></span><i></i>
                <span class="source"><?php echo htmlspecialchars_decode($row['source']);?></span>
            </figcaption>
            <div class="clear"></div>
        </figure><?php endif; endforeach; endif; ?>