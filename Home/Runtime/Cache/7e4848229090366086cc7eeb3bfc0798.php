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
<link rel="stylesheet" href="../Public/Css/index.css">
<script type="text/javascript" src="../Public/Js/indexslide.js"></script>
<div class="container">
    <article>
        <!--幻灯片展示start-->
        <section class="slidesec">
            <div class="main">
                <ul class="imgbox">
                    <?php if(is_array($all)): foreach($all as $key=>$row): ?><li>
                        <a href="__APP__/Content/artcon/id/<?php echo ($row['id']); ?>"><?php echo ($row['img']); ?></a>
                        <p><?php echo ($row['title']); ?></p>
                        </li><?php endforeach; endif; ?>
                </ul>
                <ul class="num"></ul>
                <div class="btn btn-le"><</div>
                <div class="btn btn-ri">></div>
            </div>
        </section>
        <!--幻灯片展示end-->
        <section class="con">
            <article>
                <!--热门文章start-->
                <section>
                    <p class="sec_heading">热门文章</p>
                    <div class="hot_art">
                        <?php if(is_array($remens)): foreach($remens as $key=>$val): ?><figure>
                                <a href="__APP__/Content/artcon/id/<?php echo ($val['id']); ?>">
                                <?php echo ($val['img']); ?>
                                <figcaption><?php echo mb_substr($val['title'],0,20,'utf-8');?>
                                </figcaption>
                                </a>
                            </figure><?php endforeach; endif; ?>
                        <div class="clear"></div>
                    </div>
                </section>
                <!--热门文章end-->

                <!--热门视频start-->
                <section>
                    <p class="sec_heading">热门视频</p>
                    <div class="hot_video">
                    <?php if(is_array($rvids)): foreach($rvids as $key=>$val2): ?><figure>
                            <img src="<?php echo ($val2['img']); ?>">
                            <a href="__APP__/Content/videcon/vid/<?php echo ($val2['id']); ?>/id/7" class="play"></a>
                            <figcaption><a href="__APP__/Content/videcon/vid/<?php echo ($val2['id']); ?>/id/7">

                            <?php echo mb_substr($val2['title'],0,20,'utf-8');?></a>

                            </figcaption>
                        </figure><?php endforeach; endif; ?>   
                        <div class="clear"></div>
                    </div>
                </section>
                <!--热门视频end-->

                <!--热门单曲start-->
                <section>
                    <p class="sec_heading">热门单曲</p>
                    <div class="hot_music">
                    <?php if(is_array($mus)): foreach($mus as $key=>$val3): ?><figure>
                            <img src="<?php echo ($val3['img']); ?>">
                            <figcaption>
                                <a href="__APP__/Content/musicon/id/<?php echo ($val3['id']); ?>"><?php echo ($val3['title']); ?></a>
                                <p><?php echo mb_substr($val3['description'],0,20,'utf-8');?></p>
                            </figcaption>
                            <div class="clear"></div>
                        </figure><?php endforeach; endif; ?>
                        <div class="clear"></div>
                    </div>
                </section>
                <!--热门单曲end-->
                

            </article>
            <aside>
                <section>
                    <p class="sec_heading">最新动态</p>
                    <div class="hot_dynamic">
                    <?php if(is_array($dys)): foreach($dys as $key=>$val4): ?><figure>
                            <figcaption>
                                <p><?php echo ($val4['username']); ?></p>
                                <div class="dynamic_con"><?php echo ($val4['content']); ?></div>
                            </figcaption>
                            <img src="<?php echo ($val4['img']); ?>">
                            <div class="clear"></div>
                        </figure><?php endforeach; endif; ?>
                    </div>
                </section>

                 <!-- 广告位start -->
                <div class="advertisement">广告位X1</div>
                <!-- 广告位end -->
            </aside>
            <div class="clear"></div>
        </section>
    </article>

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