<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>首页</title>
    <link rel="stylesheet" href="../Public/Css/header.css">
    <link rel="stylesheet" href="../Public/Css/index.css">
    <script src="__PUBLIC__/Js/jquery.js"></script>
    <script src="../Public/Js/html5shiv.js"></script>
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
                <li><a href="">登录</a> </li>
                <li><a href="">注册</a> </li>
            </ul>
            <div class="clear"></div>
        </div>
        <!--头部导航栏end-->
        <!--搜索栏start-->
        <div class="search">
            <div class="site_name">
                欧威
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" name="key">
                    <input type="submit" value="">
                    <div class="clear"></div>
                </div>
            </form>
            <div class="hot_search">
                <span class="red">今日热门搜索:</span>
                <a href="">郑州</a>
                <a href="">叔叔</a>
                <a href="">小星星</a>
            </div>
            <div class="clear"></div>
        </div>
        <!--搜索栏end-->
    </header>

<div class="Separator"></div>
<div class="container">
    <!--导航start-->
    <div class="music_nav">
        <a href="__URL__/music/id/<?php echo ($_GET['id']); ?>">发现</a>
        <?php if(is_array($channels)): foreach($channels as $key=>$row): ?><a href=""><?php echo ($row['name']); ?></a><?php endforeach; endif; ?>
    </div>
    <!--导航end-->

    <article>

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