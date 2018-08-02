<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>欧威</title>
    <link rel="stylesheet" href="../Public/Css/header.css">
    <!-- <link rel="stylesheet" href="../Public/Css/index.css"> -->
    <script src="__PUBLIC__/Js/jquery.js"></script>
    <script src="../Public/Js/html5shiv.js"></script>
    <script src="../Public/Js/Login/dist/jquery.validate.js"></script>
    <script src="../Public/Js/Login/dist/localization/messages_zh.js"></script>
    <script>
        var check="<?php echo U('Login/logincheck');?>";
    </script>
    <script src="../Public/Js/header.js"></script>

</head>
<body>
    <header>
        <!--头部导航栏start-->
        <div class="top">
            <ul class="top_left">
                <li><a href="<?php echo U('Index/index');?>">首页</a> </li>
                <?php if(is_array($columns)): foreach($columns as $key=>$row): ?><li>
                        <?php if($row['typeid'] == 1): ?><a href="__APP__/Content/article/id/<?php echo ($row['id']); ?>"><?php echo ($row['name']); ?></a>
                            <?php elseif($row['typeid'] == 2): ?>
                            <a href="__APP__/Content/music/id/<?php echo ($row['id']); ?>"><?php echo ($row['name']); ?></a>
                            <?php elseif($row['typeid'] == 3): ?>
                            <a href="__APP__/Content/say/id/<?php echo ($row['id']); ?>"><?php echo ($row['name']); ?></a>
                            <?php elseif($row['typeid'] == 4): ?>
                            <a href="__APP__/Content/video/id/<?php echo ($row['id']); ?>"><?php echo ($row['name']); ?></a><?php endif; ?>
                    </li><?php endforeach; endif; ?>
            </ul>
            <ul class="top_right">
                <li>
                    <?php if(isset($_SESSION['username'])): ?><span class="wel">欢迎您</span><span><?php echo ($_SESSION['username']); ?></span>
                        <a href="">个人中心</a>
                        <a href="__APP__/Login/loginout">退出</a>
                        <?php else: ?>
                        <a href="javascript:" class="log_btn">登录</a><?php endif; ?>
                </li>
                <?php if(!isset($_SESSION['username'])): ?><li><a href="__APP__/Login/register">注册</a> </li><?php endif; ?>
            </ul>
            <div class="clear"></div>
        </div>
        <!--头部导航栏end-->
        <!--登录框start-->
        <div class="login">
            <img src="../Public/Images/t1.png" class="sign">
            <div class="login_separator">
            </div>
            <p class="backerror"></p>
            <form action="__APP__/Login/logincheck" method="post">
                <div class="form-group">
                    <input type="text" placeholder="用户名" name="user">
                </div>
                <p class="error">

                </p>
                <div class="form-group">
                    <input type="password" placeholder="密码" name="password">
                </div>
                <p class="error">

                </p>
                <div class="form-group">
                    <input type="submit" value="登录">
                </div>
            </form>
        </div>
        <div class="modal"></div>
        <!--登录框end-->
        <?php if($action != 'video' AND $action != 'videocolumn' AND $action != 'register' AND $action != 'say'): ?><!--搜索栏start-->

        <div class="search">
            <div class="site_name">
                欧威
            </div>
            <form action="__APP__/Search/index" method="get">
                <div class="form-group">
                    <?php if(isset($_GET['key'])): ?><input type="text" name="key" value="<?php echo ($_GET['key']); ?>">
                        <?php else: ?>
                        <input type="text" name="key"><?php endif; ?>
                    <input type="hidden" name="type" value="all">
                    <input type="submit" value="">
                    <div class="clear"></div>
                </div>
            </form>
            <div class="clear"></div>
        </div><?php endif; ?>
        <!--搜索栏end-->
    </header>
    <!--视频右侧导航start-->
    <?php if($action == 'video' || $action == 'videcon' || $action == 'videocolumn'): ?><nav class="nav_ri">
            <ul>
                <li><a href="__URL__/video/id/<?php echo ($_GET['id']); ?>">热门视频</a> </li>
                <?php if(is_array($sons)): foreach($sons as $key=>$row): ?><li><a href="__URL__/videocolumn/id/<?php echo ($_GET['id']); ?>/column/<?php echo ($row['id']); ?>"><?php echo ($row['name']); ?></a> </li><?php endforeach; endif; ?>
            </ul>

        </nav><?php endif; ?>
    <!--视频右侧导航end-->

<link rel="stylesheet" href="../Public/Css/Content/article.css">
<script src="../Public/Js/fadeslide.js"></script>
<script src="../Public/Js/fadeslide1.js"></script>
<script>
    $(function () {
        slide('.slide', ".imgbox", '.imgbox li', '.page', '.page li', 'k', 'tal', 'now', 'i', 'T', 'siz', 'wid', 'le', '3000', '.le', '.ri');

        fadeslide1('.special_box','.special_box ul','.special_page','.special_page li','k1','special_initial','special_now','i2','T2','siz2','3000');
    });
</script>
<script>
    var sign = "<?php echo ($_GET['category']); ?>";
    var URL = "<?php echo U('morenews');?>";
</script>
<script src="../Public/Js/Content/article.js"></script>
<div class="Separator"></div>
<div class="container">
    <!--文章首页侧边导航栏start-->
    <aside class="wrap_aside">
        <nav>
            <ul>
                <li><a href="__URL__/article/id/<?php echo ($_GET['id']); ?>/category/recommend" sign="recommend">推荐</a></li>
                <li><a href="__URL__/article/id/<?php echo ($_GET['id']); ?>/category/hot" sign="hot">热点</a></li>
                <?php if(is_array($sons)): foreach($sons as $key=>$row2): ?><li><a href="__URL__/article/id/<?php echo ($_GET['id']); ?>/category/<?php echo ($row2['id']); ?>" sign="<?php echo ($row2['id']); ?>"><?php echo ($row2['name']); ?></a></li><?php endforeach; endif; ?>
            </ul>
        </nav>
    </aside>
    <!--文章首页侧边导航栏end-->
    <article class="wrap_article">
        <!--中间主体部分start-->
        <article class="main">
            <section>
                <!--幻灯片start-->
                <div class="slide">
                    <ul class="imgbox">
                        <?php if(is_array($slides)): foreach($slides as $key=>$row): ?><li>
                                <a href="__URL__/artcon/id/<?php echo ($row['id']); ?>">
                                    <?php echo ($row['img']); ?>
                                    <p><?php echo mb_substr($row['title'],0,20,'utf-8');?></p>
                                </a>
                            </li><?php endforeach; endif; ?>
                    </ul>
                    <ul class="page">

                    </ul>
                    <div class="btn le">
                        <
                    </div>
                    <div class="btn ri">
                        >
                    </div>
                </div>
                <!--幻灯片end-->
                <!--专题start-->
                <div class="special">
                    <p>
                        <span>热门专题</span>
                        <a href="__URL__/specialist">更多</a>
                    </p>
                    <div class="special_box">
                    <ul>
                        <?php if(is_array($spes)): foreach($spes as $key=>$row): if($key <= 2): ?><li>
                                    <a href="__URL__/specialinfo/id/<?php echo ($row['id']); ?>"><img src="<?php echo ($row['img']); ?>"></a>
                                    <p><?php echo ($row['name']); ?></p>
                                </li><?php endif; endforeach; endif; ?>
                    </ul>
                    <ul>
                        <?php if(is_array($spes)): foreach($spes as $key=>$row): if($key > 2 AND $key <= 5): ?><li>
                                    <a href="__URL__/specialinfo/id/<?php echo ($row['id']); ?>"><img src="<?php echo ($row['img']); ?>"></a>
                                    <p><?php echo ($row['name']); ?></p>
                                </li><?php endif; endforeach; endif; ?>
                    </ul>
                    <ul>
                        <?php if(is_array($spes)): foreach($spes as $key=>$row): if($key > 5 AND $key <= 8): ?><li>
                                    <a href="__URL__/specialinfo/id/<?php echo ($row['id']); ?>"><img src="<?php echo ($row['img']); ?>"></a>
                                    <p><?php echo ($row['name']); ?></p>
                                </li><?php endif; endforeach; endif; ?>
                    </ul>
                    </div>
                    <ul class="special_page">
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <!--专题end-->
                <div class="clear"></div>
            </section>
            <section>
                <!--文章列表start-->
                <?php if(is_array($arts)): foreach($arts as $key=>$row2): if(count($row2['img']) >= 3): ?><div class="item">
                            <a href="__URL__/artcon/id/<?php echo ($row2['id']); ?>">
                                <p><?php echo mb_substr($row2['title'],0,59,'utf-8');?></p>
                                <figure>
                                    <?php echo ($row2['img'][0]); ?>
                                    <?php echo ($row2['img'][1]); ?>
                                    <?php echo ($row2['img'][2]); ?>

                                </figure>
                            </a>
                            <span class="category"><?php echo ($row2['cate']); ?></span>
                            <i></i><span class="source"><?php echo htmlspecialchars_decode($row2['source']);?></span><i></i>
                            <time><?php echo date('Y-m-d H:i',$row2['inputtime']);?></time>
                            <div class="clear"></div>
                        </div>
                        <?php elseif(count($row2['img']) >= 1): ?>
                        <div class="item_b">
                            <figure>
                                <a href="__URL__/artcon/id/<?php echo ($row2['id']); ?>">
                                    <?php echo ($row2['img'][0]); ?>
                                </a>
                            </figure>
                            <div class="item_b_right">
                                <p><a href="__URL__/artcon/id/<?php echo ($row2['id']); ?>"><?php echo mb_substr($row2['title'],0,59,'utf-8');?></a>
                                </p>
                                <span class="category"><?php echo ($row2['cate']); ?></span><i></i>
                                <span class="source"><?php echo htmlspecialchars_decode($row2['source']);?></span><i></i>
                                <time><?php echo date('Y-m-d H:i',$row2['inputtime']);?></time>
                            </div>
                            <div class="clear"></div>
                        </div><?php endif; endforeach; endif; ?>
                <div class="showpage"><?php echo ($show); ?><div class="clear"></div></div>
                <!--文章列表end-->
            </section>
        </article>
        <!--中间主体部分end-->
        <!--右边栏start-->
        <aside class="right_column">
            <!--热门新闻start-->
            <section class="hot">
                <div class="hot_heading">
                    <span>热门新闻</span>
                    <a href="javascript:" class="change">
                        <i></i>
                        <span>换一组</span>
                    </a>
                    <div class="clear"></div>
                </div>
                <div class="box" num="<?php echo ($count); ?>">
                    <?php if(is_array($remens)): foreach($remens as $key=>$row): if($key == 0): ?><figure class="hot_fr">
                                <a href="__URL__/artcon/id/<?php echo ($row['id']); ?>">
                                    <?php echo ($row['img']); ?>
                                    <figcaption><?php echo ($row['title']); ?></figcaption>
                                </a>
                            </figure>
                            <?php else: ?>
                            <figure class="hot_item">
                                <a href="__URL__/artcon/id/<?php echo ($row['id']); ?>"> <?php echo ($row['img']); ?></a>
                                <figcaption>
                                    <p><a href="__URL__/artcon/id/<?php echo ($row['id']); ?>"> <?php echo mb_substr($row['title'],0,60,'utf-8');?></a></p>
                                    <span class="category"><?php echo ($row['cate']); ?></span><i></i>
                                    <span class="source"><?php echo htmlspecialchars_decode($row['source']);?></span>
                                </figcaption>
                                <div class="clear"></div>
                            </figure><?php endif; endforeach; endif; ?>
                </div>
            </section>
            <!--热门新闻end-->
            <!--广告位1 start-->

            <!--广告位1 end-->
            <section class="popular_searches">
                <div class="hot_heading">
                    <span>热门搜索</span>
                    <div class="clear"></div>
                </div>
                <ul>
                    <?php if(is_array($res)): foreach($res as $key=>$row): ?><li><i></i><a href="__URL__/artcon/id/<?php echo ($row['id']); ?>"><?php echo ($row['title']); ?></a>
                            <div class="clear"></div>
                        </li><?php endforeach; endif; ?>
                </ul>
            </section>
        </aside>
        <!--右边栏end-->
    </article>
    <div class="clear"></div>
</div>
<footer>
    <div class="link">
        <p>友情链接:</p>
        <a href="" target="_blank">关于我们</a>
        <a href="" target="_blank">关于我们</a>
        <a href="" target="_blank">关于我们</a>
    </div>
</footer>
</body>
</html>