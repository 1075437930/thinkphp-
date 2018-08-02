<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>欧威</title>
    <link rel="stylesheet" href="../Public/Css/header.css">
    <link rel="stylesheet" href="../Public/Css/index.css">
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
<link rel="stylesheet" href="../Public/Css/Search/index.css">
<div class="container">
    <aside>
        <ul>
            <li>
                <?php if($_GET['type'] == 'all'): ?><a href="__URL__/index/key/<?php echo ($_GET['key']); ?>/type/all" class="select">全部</a>
                    <?php else: ?>
                    <a href="__URL__/index/key/<?php echo ($_GET['key']); ?>/type/all">全部</a><?php endif; ?>
            </li>
            <?php if(is_array($columns)): foreach($columns as $key=>$row2): if($row2['typeid'] == $_GET['type']): ?><li><a href="__URL__/index/key/<?php echo ($_GET['key']); ?>/type/<?php echo ($row2['typeid']); ?>" class="select"><?php echo ($row2['name']); ?></a></li>
                   <?php else: ?>
                  <li><a href="__URL__/index/key/<?php echo ($_GET['key']); ?>/type/<?php echo ($row2['typeid']); ?>"><?php echo ($row2['name']); ?></a></li><?php endif; endforeach; endif; ?>
        </ul>
    </aside>
    <article>
        <?php if($_GET['type'] == 'all'): if(empty($rows)): ?><p>没有搜索到任何结果</p>
            <?php else: ?>
            <?php if(is_array($rows)): foreach($rows as $key=>$row3): if(($row3['type']) == "1"): ?><figure>
                        <figcaption>
                            <P><a href="__APP__/Content/artcon/id/<?php echo ($row3['id']); ?>"><span>[文章]</span><span><?php echo ($row3['title']); ?></span></a> </P>
                            <div class="describe">
                                <?php echo mb_substr($row3['content'],0,70,'utf-8');?>
                            </div>
                        </figcaption>
                       <?php echo ($row3['img']); ?>
                        <div class="clear"></div>
                    </figure>
                    <?php elseif($row3['type'] == 2): ?>
                    <figure>
                        <figcaption>
                            <P><a href="__APP__/Content/musicon/id/<?php echo ($row3['id']); ?>"><span>[音乐]</span><span><?php echo ($row3['title']); ?></span></a></P>
                            <div class="describe">
                                <?php echo mb_substr($row3['description'],0,70,'utf-8');?>
                            </div>
                        </figcaption>
                        <img src="<?php echo ($row3['img']); ?>">
                        <div class="clear"></div>
                    </figure>
                    <?php elseif($row3['type'] == 3): ?>
                    <figure>
                        <figcaption>
                            <p><span>[动态]</span><span><?php echo ($row3['title']); ?></span></p>
                            <div class="describe">
                              <?php echo ($row3['content']); ?>
                            </div>
                        </figcaption>
                        <div class="clear"></div>
                    </figure>
                    <?php elseif($row3['type'] == 4): ?>
                    <figure>
                        <figcaption>
                            <P><a href="__APP__/Content/videcon/id/7/vid/<?php echo ($row3['id']); ?>"><span>[视频]</span><span><?php echo ($row3['title']); ?></span></a></P>
                            <div class="describe">
                                <?php echo mb_substr($row3['description'],0,70,'utf-8');?>
                            </div>
                        </figcaption>
                        <img src="<?php echo ($row3['img']); ?>">
                        <div class="clear"></div>
                    </figure><?php endif; endforeach; endif; endif; ?>
            <?php elseif($_GET['type'] == 1): ?>
            <?php if(empty($arts)): ?><p>没有搜索到任何结果</p>
            <?php else: ?>
            <?php if(is_array($arts)): foreach($arts as $key=>$row3): ?><figure>
                    <figcaption>
                        <P><a href="__APP__/Content/artcon/id/<?php echo ($row3['id']); ?>"><span>[文章]</span><span><?php echo ($row3['title']); ?></span></a></P>
                        <div class="describe">
                            <?php echo mb_substr($row3['content'],0,70,'utf-8');?>
                        </div>
                    </figcaption>
                    <?php echo ($row3['img']); ?>
                    <div class="clear"></div>
                </figure><?php endforeach; endif; endif; ?>
            <?php elseif($_GET['type'] == 2): ?>
            <?php if(empty($mus)): ?><p>没有搜索到任何结果</p>
                <?php else: ?>
            <?php if(is_array($mus)): foreach($mus as $key=>$row3): ?><figure>
                    <figcaption>
                        <P><a href="__APP__/Content/musicon/id/<?php echo ($row3['id']); ?>"><span>[音乐]</span><span><?php echo ($row3['title']); ?></span></a></P>
                        <div class="describe">
                            <?php echo mb_substr($row3['description'],0,70,'utf-8');?>
                        </div>
                    </figcaption>
                    <img src="<?php echo ($row3['img']); ?>">
                    <div class="clear"></div>
                </figure><?php endforeach; endif; endif; ?>
            <?php elseif($_GET['type'] == 3): ?>
            <?php if(empty($says)): ?><p>没有搜索到任何结果</p>
                <?php else: ?>
            <?php if(is_array($says)): foreach($says as $key=>$row3): ?><figure class="say">
                    <figcaption>
                        <p><span>[动态]</span></p>
                        <p>
                            <img src="<?php echo ($row3['user']['img']); ?>" class="say_head"/>
                            <a href=""><?php echo ($row3['user']['username']); ?></a>
                            <div class="clear"></div>
                        </p>
                        <div class="describe">
                            <?php echo ($row3['content']); ?>
                        </div>
                    </figcaption>
                    <div class="clear"></div>
                </figure><?php endforeach; endif; endif; ?>
            <?php elseif($_GET['type'] == 4): ?>
            <?php if(empty($vids)): ?><p>没有搜索到任何结果</p>
                <?php else: ?>
            <?php if(is_array($vids)): foreach($vids as $key=>$row3): ?><figure>
                    <figcaption>
                        <P><a href="__APP__/Content/videcon/id/7/vid/<?php echo ($row3['id']); ?>"><span>[视频]</span><span><?php echo ($row3['title']); ?></span></a></P>
                        <div class="describe">
                            <?php echo mb_substr($row3['description'],0,70,'utf-8');?>
                        </div>
                    </figcaption>
                    <img src="<?php echo ($row3['img']); ?>">
                    <div class="clear"></div>
                </figure><?php endforeach; endif; endif; endif; ?>
        <div class="showpage"><?php echo ($show); ?><div class="clear"></div></div>
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