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
<link rel="stylesheet" href="../Public/Css/Content/videcon.css">
<script type="text/javascript" src="../Public/Js/videcon.js"></script>
<script src="../Public/Js/videoslide.js"></script>
<script>
    $(function () {
        slide('.slide', ".imgbox", '.imgbox li', '.page', '.page li', 'k', 'tal', 'now', 'i', 'T', 'siz', 'wid', 'le', '3000', '.le', '.ri');
    });
</script>
<link rel="stylesheet" href="../Public/Js/Content/fabcoll/fabcoll.css">
<script>
    var addfab="<?php echo U('addfab');?>";
    var userid="<?php echo ($userid); ?>";
    var typeid="<?php echo ($typeid); ?>";
    var id="<?php echo ($tid); ?>";
    var collhand="<?php echo U('collhand');?>";
</script>
<script src="../Public/Js/Content/fabcoll/fabcoll.js"></script>


<div class="Separator"></div>
<div class="container">
    <article>
        <section class="v_top">
            <h1><?php echo ($video['title']); ?></h1>
            <div>
            <time><?php echo date('Y-m-d H:i',$video['inputtime']);?></time><span>|</span><a class="cate"><?php echo ($colu['name']); ?></a>
                <!--点赞收藏start-->
                <iframe class='fabcoll' src="__APP__/Fabcoll/index/id/<?php echo ($_GET['vid']); ?>/type/4"  scrolling="no" style="float: right">
                </iframe>
                <!--点赞收藏end-->
                <div class="clear"></div>
            </div>
        </section>
        <section style="position: relative;margin-top: 20px;">
            <div class="cover_plate">广告位</div>
            <div class="Separator"></div>
            <iframe src="<?php echo ($video['url']); ?>" scrolling='no' allowScriptAccess='always' class="vdf"></iframe>
            <!--视频简介start-->
            <div class="intro">
                <h2>视频简介:</h2>
                <p>
                <?php echo htmlspecialchars_decode($video['description']);?>
                 </p>
            </div>
            <!--视频简介end-->
            <!--相关视频start-->
            <div class="about">
                <p>相关视频</p>
                <div class="about_box">
                    <!--幻灯片start-->
                    <div class="slide">
                        <ul class="imgbox">
                            <?php if(is_array($about)): foreach($about as $key=>$row): ?><li>
                                    <a href="__URL__/videcon/id/<?php echo ($_GET['id']); ?>/vid/<?php echo ($row['id']); ?>">
                                        <img src="<?php echo ($row['img']); ?>">
                                        <p><?php echo mb_substr($row['title'],0,20,'utf-8');?></p>
                                    </a>
                                </li><?php endforeach; endif; ?>
                            <div class="clear"></div>
                        </ul>
                        <ul class="page">

                        </ul>
                        <div class="btn le">
                            <
                        </div>
                        <div class="btn ri">
                            >
                        </div>
/
                    </div>
                    <!--幻灯片end-->
                </div>
            </div>
            <!--相关视频end-->
        </section>
        <!--评论start-->
        <iframe class='iframeId' src="__APP__/Comment/index/id/<?php echo ($_GET['vid']); ?>/type/4" width="100%" scrolling="no"></iframe>

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