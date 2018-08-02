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
<link rel="stylesheet" href="../Public/Css/Content/musicon.css">
<link rel="stylesheet" href="../Public/Js/Content/jQuery media/css/style.css"/>
<link rel="stylesheet" href="../Public/Js/Content/jQuery media/css/styles.css"/>
<script src="../Public/Js/Content/jQuery media/js/ttw-clarity-player.js"></script>
<script src="../Public/Js/Content/jQuery media/js/yepnope.js"></script>

<link rel="stylesheet" href="../Public/Js/Content/fabcoll/fabcoll.css">
<script>
    var addfab="<?php echo U('addfab');?>";
    var userid="<?php echo ($_SESSION['userid']); ?>";
    var typeid=2;
    var id="<?php echo ($_GET['id']); ?>";
    var collhand="<?php echo U('collhand');?>";
</script>
<script src="../Public/Js/Content/fabcoll/fabcoll.js"></script>

<div class="Separator"></div>
<div class="container">
    <article>
        <section>
            <div class="yin_top">
                <a href="" class="goback" onclick="history.back()"><span> <</span>返回</a>
                <!--点赞收藏start-->
                <iframe id='fabcoll' src="__APP__/Fabcoll/index/id/<?php echo ($_GET['id']); ?>/type/2"  scrolling="no" style="float: right">
                </iframe>
                <!--点赞收藏end-->
                <!--分享start-->
                <div class="share_box">
                    <div class="share">
                        <div class="bdsharebuttonbox" data-tag="share_1">
                            <a class="bds_mshare" data-cmd="mshare"></a>
                            <a class="bds_qzone" data-cmd="qzone" href="#"></a>
                            <a class="bds_tsina" data-cmd="tsina"></a>
                            <a class="bds_baidu" data-cmd="baidu"></a>
                            <a class="bds_renren" data-cmd="renren"></a>
                            <a class="bds_tqq" data-cmd="tqq"></a>
                            <a class="bds_more" data-cmd="more">更多</a>
                            <a class="bds_count" data-cmd="count"></a>
                        </div>
                        <script>
                            window._bd_share_config = {
                                common: {
                                    bdText: "<?php echo ($art['title']); ?>",
                                    bdDesc: '',
                                    bdUrl: "",
                                    bdPic: ''
                                },
                                share: [{
                                    "bdSize": 16
                                }],
                                selectShare: [{
                                    "bdselectMiniList": ['qzone', 'tqq', 'kaixin001', 'bdxc', 'tqf']
                                }]
                            }
                            with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=' + ~(-new Date() / 36e5)];
                        </script>
                    </div>
                </div>
                <!--分享end-->
                <div class="clear"></div>
            </div>
            <div id="example-wrapper">
                <div id="example-outer">
                    <div id="example" data-size="large">

                    </div>
                </div>
            </div>

            <script>
                $(function () {
                    var myPlaylist = [
                        {
                           mp3: "<?php echo ($yin[url]); ?>",
                            duration: "<?php echo ($yin[time]); ?>",
                            cover: "<?php echo ($yin[img]); ?>",
                            title: "<?php echo ($yin[title]); ?>",
                            artist:"<?php echo ($yin[source]); ?>",
                            background: 'playlist/covers/bg.jpg'
                        }

                    ];
                    "<?php if(is_array($list)): foreach($list as $key=>$row): ?>";
                        json={
                            mp3: "<?php echo ($row[url]); ?>",
                            duration: "<?php echo ($row[time]); ?>",
                            cover: "<?php echo ($row[img]); ?>",
                            title: "<?php echo ($row[title]); ?>",
                            artist:"<?php echo ($row[source]); ?>",
                            background: 'playlist/covers/bg.jpg'
                        }
                        myPlaylist.push(json);
                    "<?php endforeach; endif; ?>";
                    var clarity = $('#example').ttwClarityPlayer(myPlaylist, {
                        jPlayer: {
                            supplied: 'mp3',
                            errorAlerts: true,
                            autoPlay: true,
                            warningAlerts: true,
                            consoleAlerts: true
                        }
                    });

//                自动播放
                    t = setTimeout(function () {
                        $('.play').click()
                    }, 2000)
                })
            </script>
        </section>
        <div class="Separator"></div>
        <section class="bot">
            <!--简介start-->
            <article class="introduction">
                <h2>简介</h2>
                <div class="introduction_con">
                    <?php echo htmlspecialchars_decode($yin['description']);?>
                </div>
            </article>
            <!--简介end-->
            <!--评论start-->
            <aside>
                <iframe class='iframeId' src="__APP__/Comment/index/id/<?php echo ($_GET['id']); ?>/type/2" width="100%" scrolling="no">
                </iframe>
            </aside>
            <!--评论end-->
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