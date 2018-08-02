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
<link rel="stylesheet" href="../Public/Css/Content/music.css">
<div class="Separator"></div>
<div class="container">
    <!--导航start-->
    <div class="music_nav">
        <a href="__URL__/music/id/<?php echo ($_GET['id']); ?>">发现</a>
        <?php if(is_array($channels)): foreach($channels as $key=>$row): ?><a href="__URL__/musicchannel/id/<?php echo ($_GET['id']); ?>/channel/<?php echo ($row['id']); ?>"><?php echo ($row['name']); ?></a><?php endforeach; endif; ?>
    </div>
    <!--导航end-->
    <article>
        <!--头部推荐start-->
        <section>
            <?php if(is_array($toprecommend)): foreach($toprecommend as $key=>$row): ?><figure class="toprecommend_item">
                    <a href="__URL__/musicon/id/<?php echo ($row['id']); ?>">
                        <img src="<?php echo ($row['img']); ?>">
                        <figcaption>
                            <?php echo ($row['title']); ?>-<?php echo ($row['artist']); ?>
                        </figcaption>
                    </a>
                </figure><?php endforeach; endif; ?>
            <div class="clear"></div>
        </section>
        <!--头部推荐end-->

        <!--广告位start-->
        <!--广告位end-->

        <!--热门音乐start-->
        <section class="hot">
            <p class="hot_heading"><span>热门音乐榜</span></p>

            <div class="hot_box">
                <p class="hot_label">
                    <a href="">
                        <span class="big">热门</span>
                        <span class="sma">音乐榜</span>
                    </a>
                </p>
                <figure class="hot_box_mid">
                    <a href="__URL__/musicon/id/<?php echo ($hots[0]['id']); ?>">
                       <img src="<?php echo ($hots[0]['img']); ?>">
                    </a>
                    <figcaption>
                        <a href="__URL__/musicon/id/<?php echo ($hots[0]['id']); ?>">
                            <span class="pink">TOP</span><span>1</span>
                            <p><?php echo ($hots[0]['title']); ?>-<?php echo ($hots[0]['artist']); ?></p>
                        </a>
                        <a href="" class="cate"><?php echo ($hots[0]['channel']['name']); ?></a>
                    </figcaption>

                </figure>
                <div class="hot_box_right">
                    <figure>
                        <a href="__URL__/musicon/id/<?php echo ($hots[1]['id']); ?>">
                            <img src="<?php echo ($hots[1]['img']); ?>">
                        </a>
                        <figcaption>
                            <a href="__URL__/musicon/id/<?php echo ($hots[1]['id']); ?>">
                                <p><span class="pink_b">2</span><?php echo ($hots[1]['title']); ?>-<?php echo ($hots[1]['artist']); ?></p>
                            </a>
                            <a href="" class="cate"><?php echo ($hots[1]['channel']['name']); ?></a>
                        </figcaption>
                    </figure>
                    <figure>
                        <a href="__URL__/musicon/id/<?php echo ($hots[2]['id']); ?>">
                            <img src="<?php echo ($hots[2]['img']); ?>">
                        </a>
                        <figcaption>
                            <a href="__URL__/musicon/id/<?php echo ($hots[2]['id']); ?>">
                                <p><span class="pink_b">3</span><?php echo ($hots[2]['title']); ?>-<?php echo ($hots[2]['artist']); ?></p>
                            </a>
                            <a href="" class="cate"><?php echo ($hots[2]['channel']['name']); ?></a>
                        </figcaption>
                    </figure>
                </div>
                <div class="clear"></div>
            </div>
        </section>
        <!--热门音乐end-->
        <div class="Separator"></div>
        <!--原创音乐start-->
        <section class="hot">
            <p class="hot_heading"><span>原创音乐榜</span></p>

            <div class="hot_box">
                <p class="hot_label original_label">
                    <a href="">
                        <span class="big">原创</span>
                        <span class="sma">音乐榜</span>
                    </a>
                </p>
                <figure class="hot_box_mid">
                    <a href="">
                        <img src="../Public/Images/u=951366582,2055930928&fm=23&gp=0.jpg">
                    </a>
                    <figcaption>
                        <a href="">
                            <span class="pink">TOP</span><span>1</span>
                            <p>陈洁仪献唱「嫌疑人x的献身」主题曲「清白」</p>
                        </a>
                        <a href="" class="cate">echo娱乐</a>
                    </figcaption>

                </figure>
                <div class="hot_box_right">
                    <figure>
                        <a href="">
                            <img src="../Public/Images/u=951366582,2055930928&fm=23&gp=0.jpg">
                        </a>
                        <figcaption>
                            <a href="">
                                <p><span class="pink_b">2</span>陈洁仪献唱「嫌疑人x的献身」主题曲「清白」</p>
                            </a>
                            <a href="" class="cate">echo娱乐</a>
                        </figcaption>
                    </figure>
                    <figure>
                        <a href="">
                            <img src="../Public/Images/u=951366582,2055930928&fm=23&gp=0.jpg">
                        </a>
                        <figcaption>
                            <a href="">
                                <p><span class="pink_b">2</span>陈洁仪献唱「嫌疑人x的献身」主题曲「清白」</p>
                            </a>
                            <a href="" class="cate">echo娱乐</a>
                        </figcaption>
                    </figure>
                </div>
                <div class="clear"></div>
            </div>
        </section>
        <!--原创音乐end-->
        <div class="Separator"></div>
        <!--今日推荐start-->
        <section>
            <div class="todayrecomm_heading">
                今日推荐
            </div>
            <?php if(is_array($todayrecomm)): foreach($todayrecomm as $key=>$row): ?><figure class="todayrecomm_item">
                    <a href="__URL__/musicon/id/<?php echo ($row['id']); ?>">
                        <img src="<?php echo ($row['img']); ?>">
                        <figcaption>
                            <?php echo ($row['title']); ?>- <?php echo ($row['artist']); ?>
                        </figcaption>
                    </a>
                </figure><?php endforeach; endif; ?>
            <div class="clear"></div>
        </section>
        <!--今日推荐end-->
    </article>
    <aside>
        <!--每日精选start-->
        <section class="everyday">
            <p class="everyday_heading">每日精选</p>
            <?php if(is_array($everyday)): foreach($everyday as $key=>$row): ?><figure class="everyday_item">
                    <a href="__URL__/musicon/id/<?php echo ($row['id']); ?>">
                        <img src="<?php echo ($row['img']); ?>">
                        <figcaption>
                            <p class="ti"><?php echo ($row['title']); ?>- <?php echo ($row['artist']); ?></p>
                            <p><?php echo ($row['channel']['name']); ?></p>
                        </figcaption>
                    </a>
                    <div class="clear"></div>
                </figure><?php endforeach; endif; ?>
        </section>
        <!--每日精选end-->
    </aside>
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