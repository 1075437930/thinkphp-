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
<link rel="stylesheet" href="../Public/Css/Content/videocolumn.css">
<div class="Separator"></div>
<div class="container">
    <article>
        <!--三级导航start-->
        <section>
            <h1><?php echo ($column['name']); ?></h1>
            <p>
                <span>分类</span>
                <?php if($_GET['type'] == 'all' || $_GET['type'] == ''): ?><a href="__URL__/videocolumn/id/<?php echo ($_GET['id']); ?>/column/<?php echo ($row['id']); ?>/type/all" style="color: #6ED56C">全部</a>
                    <?php else: ?>
                    <a href="__URL__/videocolumn/id/<?php echo ($_GET['id']); ?>/column/<?php echo ($row['id']); ?>/type/all">全部</a><?php endif; ?>
                <?php if(is_array($bots)): foreach($bots as $key=>$row): if($_GET['type'] == $row['id']): ?><a href="__URL__/videocolumn/id/<?php echo ($_GET['id']); ?>/column/<?php echo ($_GET['column']); ?>/type/<?php echo ($row['id']); ?>" style="color: #6ED56C"><?php echo ($row['name']); ?></a>
                        <?php else: ?>
                        <a href="__URL__/videocolumn/id/<?php echo ($_GET['id']); ?>/column/<?php echo ($_GET['column']); ?>/type/<?php echo ($row['id']); ?>"><?php echo ($row['name']); ?></a><?php endif; endforeach; endif; ?>
            </p>
        </section>
        <!--三级导航end-->
        <!--列表start-->
        <section>
            <?php if(is_array($videos)): foreach($videos as $key=>$row): ?><div class="item">
                    <div class="limit">
                        <a href="__URL__/videcon/id/<?php echo ($_GET['id']); ?>/vid/<?php echo ($row['id']); ?>">
                            <img src="<?php echo ($row['img']); ?>">
                        </a>
                    </div>

                    <p><a href="__URL__/videcon/id/<?php echo ($_GET['id']); ?>/vid/<?php echo ($row['id']); ?>"> <?php echo ($row['title']); ?></a></p>

                    <p class="info">
                        <a href="__URL__/videocolumn/id/<?php echo ($_GET['id']); ?>/column/<?php echo ($_GET['column']); ?>/type/<?php echo ($row['cate']['id']); ?>" class="cate"><?php echo ($row['cate']['name']); ?></a>
                        <span>|</span>
                        <a href="" class="fab"><i></i><span>(233)</span></a>
                    </p>
                </div><?php endforeach; endif; ?>
            <div class="clear"></div>
            <div class="showpage">
                <?php echo ($show); ?>
            </div>
        </section>
        <!--列表end-->
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