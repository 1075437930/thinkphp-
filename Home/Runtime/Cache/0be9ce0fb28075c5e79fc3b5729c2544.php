<?php if (!defined('THINK_PATH')) exit();?><figure class="sat_item">
    <img src="<?php echo ($_SESSION['img']); ?>">
    <figcaption>
        <p class="say_heading"><a><?php echo ($_SESSION['username']); ?></a><time><?php echo date('Y-m-d H:i:s',time());?></time></p>
        <p><?php echo htmlspecialchars_decode($_POST['content']);?></p>
        <div class="source">
            <?php echo htmlspecialchars_decode($_POST['source']);?>
        </div>
        <?php if(!empty($row['forward'])): ?><div class="forward" vid="<?php echo ($row['forward']['id']); ?>">
                <img src="<?php echo ($row['forward']['user']['img']); ?>">
                <figcaption>
                    <p class="say_heading"><a><?php echo ($row['forward']['user']['username']); ?></a><time><?php echo date('Y-m-d H:i:s',$row['forward']['inputtime']);?></time></p>
                    <p><?php echo ($row['forward']['content']); ?></p>
                    <div class="source">
                        <?php echo htmlspecialchars_decode($row['forward']['source']);?>
                    </div>
                </figcaption>
                <div class="clear"></div>
            </div><?php endif; ?>
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
</figure>