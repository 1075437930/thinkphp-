<?php if (!defined('THINK_PATH')) exit();?><div class="item">
    <img src="<?php echo ($_SESSION['img']); ?>">
    <div class="item_con">
        <p><a href=""><?php echo ($_SESSION['username']); ?></a><time><?php echo date('Y-m-d H:i',time());?></time></p>
        <p><?php echo ($_POST['content']); ?></p>
        <p><a href="javascript:" class="replay">回复</a><a href="javascript:" class="showreplay">0条回复<span>∨</span></a>
            <?php if($row['isfab'] == 1): ?><a href="javascript:" class="comm_fab" cid="<?php echo ($comm['id']); ?>"><i style="background-position: -40px -2px"></i><span>(0)</span></a>
                <?php else: ?>
                <a href="javascript:" class="comm_fab" cid="<?php echo ($comm['id']); ?>"><i></i><span>(0)</span></a><?php endif; ?>
        </p>
        <form class="replay_form">
            <div class="form-group">
                <textarea name="content" placeholder="回复:"></textarea>
            </div>
            <div class="form-group_t two">
                <span></span>
                <input type="submit" value="回复">
                <div class="clear"></div>
            </div>
            <input type="hidden" value="<?php echo ($comm['id']); ?>" name="pid">
            <input type="hidden" value="<?php echo ($_POST['tid']); ?>" name="tid">
            <input type="hidden" value="<?php echo ($_POST['typeid']); ?>" name="typeid">
        </form>
        <div class="replay_info">
        </div>
    </div>
    <div class="clear"></div>
</div>