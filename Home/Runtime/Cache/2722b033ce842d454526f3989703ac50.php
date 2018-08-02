<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="__TMPL__/Comment/index.css">
    <script src="__TMPL__/Comment/jquery-1.10.2.min_65682a2.js"></script>
</head>
<body>
<script>
    var addcomment="<?php echo U('addcomment');?>";
    var getmorecomment="<?php echo U('getmorecomment');?>";
    var type="<?php echo ($_GET['type']); ?>";
    var td="<?php echo ($_GET['id']); ?>";
    var ord="<?php echo ($_GET['order']); ?>";
    var getmorereplay="<?php echo U('getmorereplay');?>";
    var addcommfab="<?php echo U('addcommfab');?>";
</script>
<script src="__TMPL__/Comment/comment.js"></script>
<!--评论start-->
<section class="comment_box">
    <p class="heading"><span><?php echo ($comm_num); ?></span>条评论</p>
    <div class="comment">
        <?php if(!empty($_SESSION['img'])): ?><img src="<?php echo ($_SESSION['img']); ?>">
            <?php else: ?>
            <img src="__TMPL__/Comment/po.jpg"><?php endif; ?>
        <form>
            <div class="form-group">
                <textarea name="content" placeholder="我要说几句"></textarea>
            </div>
            <div class="form-group_t one">
                <span></span>
                <input type="submit" value="评论">
                <div class="clear"></div>
            </div>
            <input type="hidden" value="0" name="pid">
            <input type="hidden" value="<?php echo ($_GET['id']); ?>" name="tid">
            <input type="hidden" value="<?php echo ($_GET['type']); ?>" name="typeid">
        </form>
        <div class="clear"></div>
    </div>
    <?php if(!empty($comms)): ?><div class="order">
        <?php if($_GET['order'] == 'new' OR $_GET['order'] == ''): ?><a href="?order=new" class="new active">最新</a>
            <?php else: ?>
            <a href="?order=new">最新</a><?php endif; ?>
        <?php if($_GET['order'] == 'hot'): ?><a href="?order=hot" class="active">最热</a>
            <?php else: ?>
            <a href="?order=hot">最热</a><?php endif; ?>
    </div>
    <div class="comment_info">
        <?php if(is_array($comms)): foreach($comms as $key=>$row): ?><div class="item">
                <?php if(!empty($row['user']['img'])): ?><img src="<?php echo ($row['user']['img']); ?>">
                    <?php else: ?>
                    <img src="__TMPL__/Comment/po.jpg"><?php endif; ?>
                <div class="item_con">
                    <p><a href=""><?php echo ($row['user']['username']); ?></a><time><?php echo date('Y-m-d H:i',$row['time']);?></time></p>
                    <p><?php echo ($row['content']); ?></p>
                    <div class="fab_tip"></div>
                    <p><a href="javascript:" class="replay">回复</a><a href="javascript:" class="showreplay"><?php echo ($row['num']); ?>条回复<span>∨</span></a>
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
                        <input type="hidden" value="<?php echo ($_GET['type']); ?>" name="typeid">
                    </form>
                    <div class="replay_info">
                        <?php if(is_array($row['res'])): foreach($row['res'] as $key=>$row2): ?><div class="item">
                                <?php if(!empty($row2['user']['img'])): ?><img src="<?php echo ($row2['user']['img']); ?>">
                                    <?php else: ?>
                                    <img src="__TMPL__/Comment/po.jpg"><?php endif; ?>
                                <div class="item_con">
                                    <p><a href=""><?php echo ($row2['user']['username']); ?></a><time><?php echo date('Y-m-d H:i',$row2['time']);?></time></p>
                                    <p><?php echo ($row2['content']); echo ($row2['ait']); ?></p>
                                    <div class="fab_tip"></div>
                                    <p><a href="javascript:" class="replay" pid="<?php echo ($row2['id']); ?>" user="<?php echo ($row2['user']['username']); ?>">回复</a>
                                        <?php if($row2['isfab'] == 1): ?><a href="javascript:" class="comm_fab" cid="<?php echo ($row2['id']); ?>"><i style="background-position: -40px -2px"></i><span>(<?php echo ($row2['fabnum']); ?>)</span></a>
                                            <?php else: ?>
                                            <a href="javascript:" class="comm_fab" cid="<?php echo ($row2['id']); ?>"><i></i><span>(<?php echo ($row2['fabnum']); ?>)</span></a><?php endif; ?>
                                    </p>
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
                                        <input type="hidden" value="<?php echo ($_GET['id']); ?>" name="tid">
                                        <input type="hidden" value="<?php echo ($_GET['type']); ?>" name="typeid">
                                    </form>
                                </div>
                                <div class="clear"></div>
                            </div><?php endforeach; endif; ?>
                        <a class="more" href="javascript:" cid="<?php echo ($row['id']); ?>">查看更多回复</a>
                    </div>
                </div>
                <div class="clear"></div>
            </div><?php endforeach; endif; ?>
    </div>
    <a class="more" href="javascript:">查看更多评论</a>
        <?php else: ?>
        <p class="no_comm">暂无评论</p><?php endif; ?>
</section>
<!--评论end-->

</body>
</html>