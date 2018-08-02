<?php if (!defined('THINK_PATH')) exit();?><div class="item">
    <img src="<?php echo ($_SESSION['img']); ?>">
    <div class="item_con">
        <p><a href=""><?php echo ($_SESSION['username']); ?></a><time><?php echo date('Y-m-d H:i',time());?></time></p>
        <p><?php echo ($comm['content']); echo ($comm['ait']); ?></p>
        <p><a href="javascript:" class="replay">回复</a> <a href="javascript:" class="comm_fab" cid="<?php echo ($comm['id']); ?>"><i></i><span>(0)</span></a></p>
        <form class="replay_form">
            <div class="form-group">
                <textarea name="content" placeholder="回复:"></textarea>
            </div>
            <div class="form-group_t three">
                <span></span>
                <input type="submit" value="回复" user="<?php echo ($u['username']); ?>" con="<?php echo ($comm['content']); ?>">
                <div class="clear"></div>
            </div>
            <input type="hidden" value="<?php echo ($comm['id']); ?>" name="pid">
            <input type="hidden" value="<?php echo ($_POST['tid']); ?>" name="tid">
            <input type="hidden" value="<?php echo ($_POST['typeid']); ?>" name="typeid">
        </form>
    </div>
    <div class="clear"></div>
</div>