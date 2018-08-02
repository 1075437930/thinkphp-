<?php if (!defined('THINK_PATH')) exit(); if(is_array($comms)): foreach($comms as $key=>$row): ?><div class="item">
        <img src="<?php echo ($row['user']['img']); ?>">
        <div class="item_con">
            <p><a href=""><?php echo ($row['user']['username']); ?></a><time><?php echo date('Y-m-d H:i',$row['time']);?></time></p>
            <p><?php echo ($row['content']); ?></p>
            <p><a href="javascript:" class="replay">回复</a><a href="javascript:" class="showreplay"><?php echo ($row['num']); ?>条回复<span>∨</span> </a>
                <?php if($row['isfab'] == 1): ?><a href="javascript:" class="comm_fab" cid="<?php echo ($row['id']); ?>"><i style="background-position: -40px -2px"></i><span>(<?php echo ($row['fabnum']); ?>)</span></a>
                    <?php else: ?>
                    <a href="javascript:" class="comm_fab" cid="<?php echo ($row['id']); ?>"><i></i><span>(<?php echo ($row['fabnum']); ?>)</span></a><?php endif; ?>
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
                <input type="hidden" value="<?php echo ($row['id']); ?>" name="pid">
                <input type="hidden" value="<?php echo ($_GET['id']); ?>" name="tid">
                <input type="hidden" value="1" name="typeid">
            </form>
            <div class="replay_info">
                <?php if(is_array($row['res'])): foreach($row['res'] as $key=>$row2): ?><div class="item">
                        <img src="<?php echo ($row2['user']['img']); ?>">
                        <div class="item_con">
                            <p><a href=""><?php echo ($row2['user']['username']); ?></a><time><?php echo date('Y-m-d H:i',$row2['time']);?></time></p>
                            <p><?php echo ($row2['content']); echo ($row2['ait']); ?></p>
                            <p><a href="javascript:" class="replay" pid="<?php echo ($row2['id']); ?>" user="<?php echo ($row2['user']['username']); ?>">回复</a></p>
                            <form class="replay_form">
                                <div class="form-group">
                                    <textarea name="content" placeholder="回复:"></textarea>
                                </div>
                                <div class="form-group_t three">
                                    <span></span>
                                    <input type="submit" value="回复" user="<?php echo ($row2['user']['username']); ?>" con="<?php echo ($row2['content']); ?>">
                                    <div class="clear"></div>
                                </div>
                                <input type="hidden" value="<?php echo ($row2['id']); ?>" name="pid">
                                <input type="hidden" value="<?php echo ($_POST['tid']); ?>" name="tid">
                                <input type="hidden" value="<?php echo ($_POST['typeid']); ?>" name="typeid">
                            </form>
                        </div>
                        <div class="clear"></div>
                    </div><?php endforeach; endif; ?>
                <a class="more" href="javascript:" cid="<?php echo ($row['id']); ?>">查看更多回复</a>
            </div>
        </div>
        <div class="clear"></div>
    </div><?php endforeach; endif; ?>