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
<link rel="stylesheet" href="../Public/Css/Content/say.css">
<style>
    .qqFace table td {
        padding: 0px;
    }

    .qqFace table td img {
        cursor: pointer;
        border: 1px #fff solid;
    }

    .qqFace table td img:hover {
        border: 1px #0066cc solid;
    }
</style>
<script src="__PUBLIC__/Js/jquery-migrate-1.2.1.min.js"></script>
<script>
    var sayinsert="<?php echo U('sayinsert');?>";
</script>
<script src="../Public/Js/Content/say.js"></script>
<script src="../Public/Js/jQuery-qqFace933020160323/qqFace/js/jquery.qqFace.js"></script>
<div class="Separator"></div>
<div class="container">
    <article>
        <!--导航start-->
        <section class="say_nav">
            <nav>
                <ul>
                    <li>
                        <a href=""><i class="square_tb"></i> <span>广场</span></a>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <a href="javascript:" class="letter"><i class="si_tb"></i><span>私信</span></a>
                        <div class="clear"></div>
                    </li>
                </ul>
            </nav>

            <!--加载文件start-->
            <link rel="stylesheet" href="__TMPL__/Chat/chat.css">
            <script src="__TMPL__/Chat/chat.js"></script>
            <script src="__TMPL__/Chat/jQuery-qqFace933020160323/qqFace/js/jquery-migrate-1.2.1.min.js"></script>
            <script src="__TMPL__/Chat/jQuery-qqFace933020160323/qqFace/js/jquery.qqFace.js"></script>
            <!--加载文件end-->

            <script>
                var login="<?php echo ($_SESSION['login']); ?>";
                var getchatwindow="<?php echo U('Chat/getchatwindow');?>";
                var addorsavechat="<?php echo U('Chat/addorsavechat');?>";
                var getchat="<?php echo U('Chat/getchat');?>";
                var getchatlist="<?php echo U('Chat/getchatlist');?>";
                var chooseuserwindow="<?php echo U('Chat/chooseuserwindow');?>";
                var getuser="<?php echo U('Chat/getuser');?>";
                //        qq表情插件的网站绝对路径
                var headpath='/tp/Home/Tpl/Chat/jQuery-qqFace933020160323/qqFace/arclist/';
            </script>

            <!--弹出框模板start-->
            <div class="chat">
                <div class="chat_heading">
                    <span>私信</span>
                    <div class="chat_close">X</div>
                    <button>新私信</button>
                </div>
                <div class="chat_item_box">
                    <?php if(is_array($chats)): foreach($chats as $key=>$row): ?><figure vid="<?php echo ($row['user']['id']); ?>">
                            <?php if(!empty($row['user']['img'])): ?><img src="<?php echo ($row['user']['img']); ?>">
                                <?php else: ?>
                                <img src="__TMPL__/Chat/po.jpg"><?php endif; ?>
                            <figcaption><?php echo ($row['user']['username']); ?></figcaption>
                            <div class="clear"></div>
                        </figure><?php endforeach; endif; ?>
                </div>
            </div>
            <div class="chat_modal"></div>
            <div class="chat_tip"></div>
            <!--弹出框模板end-->

            <form>
                <div class="form-group">
                    <input type="text" placeholder="搜索">
                    <i></i>
                </div>
            </form>
            <div class="clear"></div>
        </section>
        <!--导航end-->
        <!--主体部分start-->
        <section class="main">
            <article class="wrap_ar">
                <aside>
                    <!--当前用户框start-->
                    <script src="__TMPL__/HeadUpload/ajaxfileupload.js"></script>
                    <!--加载jcrop图片裁剪插件start-->
                    <link rel="stylesheet"
                          href="__TMPL__/HeadUpload/jcrop/css/jquery.Jcrop.css">
                    <script src="__TMPL__/HeadUpload/jcrop/js/jquery.Jcrop.js"></script>
                    <!--加载jcrop图片裁剪插件end-->
                    <script>
                        var site='/jin';

                        var ajaxupload = "<?php echo U('HeadUpload/ajaxupload');?>";
                        var cutimg = "<?php echo U('HeadUpload/cutimg');?>";
                        var imgdel = "<?php echo U('HeadUpload/imgdel');?>";
                        var revokeimg="<?php echo U('HeadUpload/revokeimg');?>";
                    </script>
                    <link href="__TMPL__/HeadUpload/headupload.css" rel="stylesheet">
                    <script src="__TMPL__/HeadUpload/headupload.js"></script>
                    <section class="user_box">
                        <?php if($_SESSION['login'] == 1): ?><div class="xblue">
                            <?php if(($_SESSION['login']) == "1"): ?><div class="blue">
                                    <?php if(empty($_SESSION['img'])): ?><figure class="upload">
                                            <img src="../Public/Images/2017-04-11_082227.png">

                                            <div class="prompt">上传头像</div>
                                            <ul>
                                                <i></i>
                                                <li>上传照片</li>
                                                <input type="file" name="img" id="file1">
                                                <li class="del">取消</li>
                                            </ul>
                                        </figure>
                                        <?php else: ?>
                                        <figure class="head">
                                            <img src="<?php echo ($_SESSION['img']); ?>">
                                            <ul>
                                                <i></i>
                                                <li class="revoke">撤销头像</li>
                                                <li class="del">取消</li>
                                            </ul>
                                        </figure><?php endif; ?>
                                    <div class="cutpop">
                                        <p>裁剪头像 <span class="cutclose">X</span></p>

                                        <div class="cutoperation">
                                            <img id="element_id" src="" class="original">

                                            <div class="preview">
                                                <p>裁剪预览</p>

                                                <div class="preview_contain">
                                                    <img src="" class="jcrop-preview">
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="cut_bot">
                                            <form>
                                                <input type="hidden" name="file">
                                                <input type="hidden" id="x" name="x"/>
                                                <input type="hidden" id="y" name="y"/>
                                                <input type="hidden" id="w" name="w"/>
                                                <input type="hidden" id="h" name="h"/>
                                                <button type="button" class="cutbtn cutdel">取消</button>
                                                <button type="button" class="cutbtn cutok">应用</button>
                                            </form>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="headupmodal"></div><?php endif; ?>
                        </div>
                        <div>
                            <span class="Sq"></span>
                            <a href=""><?php echo ($_SESSION['username']); ?></a>
                        </div>
                        <p>
                            <a href="">
                                <span class="fi">推文</span>
                                <span><?php echo ($saynum); ?></span>
                            </a>
                            <a href="">
                                <span class="fi">正在关注</span>
                                <span><?php echo ($folnum); ?></span>
                            </a>
                            <a href="">
                                <span class="fi">关注者</span>
                                <span><?php echo ($myfolnum); ?></span>
                            </a>
                        </p>
                            <?php else: ?>
                            <p class="quick_hd"></p>
                            <p class="quick">赶紧登录发表自己的动态吧</p><?php endif; ?>
                    </section>
                    <!--当前用户框end-->
                    <!--热门推文start-->
                    <section class="hot_tui">
                        <p>热门话题</p>
                        <ul>
                            <?php if(is_array($hotweets)): foreach($hotweets as $key=>$row): ?><li><a href=""><?php echo ($row['content']); ?></a></li><?php endforeach; endif; ?>
                        </ul>
                    </section>
                    <!--热门推文end-->
                </aside>
                <article>
                    <!--发表推文start-->
                    <section class="Publish_box">
                        <?php if(!empty($_SESSION['img'])): ?><img src="<?php echo ($_SESSION['img']); ?>">
                            <?php else: ?>
                            <img src="../Public/Images/po.jpg"><?php endif; ?>
                        <form class="form_a">
                            <div class="form-group">
                                <input type="text" value="有什么新鲜事?">
                                <i></i>
                            </div>
                        </form>

                        <script src="/jin/Public/Js/ajaxuploadpreview/multipleimg.js"></script>
                        <link rel="stylesheet" href="/jin/Public/Js/ajaxuploadpreview/multipleimg.css">
                        <script>
                            $(function(){

                                multipleimg('.source_show','/jin/Public/Js/ajaxuploadpreview/');
                            });
                        </script>
                        <div class="tip"></div>
                        <form class="form_b" method="post">
                            <div class="form-group">
                                <div contenteditable="true"  class="input" id="saytext"  maxlength="400"></div>
                                <i class="expression_tb"></i>
                            </div>
                            <div class="source_show">

                            </div>
                            <input type="file" id='file2' name="file">

                            <div class="form-group">
                                <div class="mask"></div>
                                <div class="btn_mask"></div>
                                <i class="video_tb"></i>
                                <i class="pic_tb"></i>
                                <i class="mus_tb"></i>
                                <a href="javascript:"><span>#</span>话题</a>
                                <input type="button" value="发表">
                                <span class="font_num">400</span>
                            </div>
                        </form>
                        <div class="clear"></div>
                    </section>
                    <!--发表推文end-->
                    <script>
                        var getmoresay="<?php echo U('getmoresay');?>"
                    </script>

                    <!--推文列表start-->
                    <section class="says_box">
                        <?php if(is_array($says)): foreach($says as $key=>$row): ?><figure class="sat_item" vid="<?php echo ($row['id']); ?>">
                                <?php if(empty($row['user']['img'])): ?><img src="../Public/Images/po.jpg">
                                    <?php else: ?>
                                    <img src="<?php echo ($row['user']['img']); ?>"><?php endif; ?>
                                <figcaption>
                                    <p class="say_heading"><a><?php echo ($row['user']['username']); ?></a>
                                        <time><?php echo date('Y-m-d H:i:s',$row['inputtime']);?></time>
                                    </p>
                                    <p><?php echo htmlspecialchars_decode($row['content']);?></p>
                                    <div class="source">
                                        <?php echo htmlspecialchars_decode($row['source']);?>
                                    </div>
                                    <?php if(!empty($row['forward'])): ?><div class="forward" vid="<?php echo ($row['forward']['id']); ?>">
                                            <img src="<?php echo ($row['forward']['user']['img']); ?>">
                                            <figcaption>
                                                <p class="say_heading"><a><?php echo ($row['forward']['user']['username']); ?></a><time><?php echo date('Y-m-d H:i:s',$row['forward']['inputtime']);?></time></p>
                                                <p><?php echo ($row['forward']['content']); ?></p>
                                                <div class="source">
                                                    <?php echo htmlspecialchars_decode($row['forward']['source']);?>
                                                </div>
                                            </figcaption>
                                            <div class="clear"></div>
                                        </div><?php endif; ?>
                                    <div class="opt">
                                        <i class="replay_tb" vid="<?php echo ($row['id']); ?>"></i>
                                        <i class="share_tb"></i>
                                        <!--加载点赞分享模块start-->
                                        <iframe class='fabcoll' src="__APP__/Fabcoll/index/id/<?php echo ($row['id']); ?>/type/3"
                                                scrolling="no">
                                        </iframe>
                                        <!--加载点赞分享模块end-->
                                        <div class="clear"></div>
                                    </div>
                                </figcaption>
                                <div class="clear"></div>
                            </figure><?php endforeach; endif; ?>
                    </section>

                    <!--分享弹框start-->
                    <div class="share_box">
                        <p class="share_box_heading">转发动态</p>
                        <div class="share_comm">
                            <div contenteditable="true" id="saytext1">
                                评论几句
                            </div>
                            <i class="expression"></i>
                        </div>
                        <div class="share_con">

                        </div>
                        <div>
                            <button>转发</button>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!--分享弹框end-->

                    <script>
                        var replaybox="<?php echo U('replaybox');?>";
                    </script>
                    <!--回复弹框start-->
                    <iframe class="replay_box" ></iframe>
                    <!--回复弹框end-->
                    <!--推文列表end-->
                </article>
            </article>
            <aside>
                <!--推荐关注start-->
                <section class="recomm_follow">
                    <div class="recomm_follow_hd"><span>推荐关注</span></div>
                    <?php if(is_array($recomms)): foreach($recomms as $key=>$row): ?><figure class="recomm_item">
                            <?php if(empty($row['img'])): ?><img src="../Public/Images/po.jpg">
                                  <?php else: ?>
                                  <img src="<?php echo ($row['img']); ?>"><?php endif; ?>
                            <figcaption>
                                <p><a href=""><?php echo ($row['username']); ?></a></p>
                                <iframe class='follow' src="__APP__/Follow/index/id/<?php echo ($row['id']); ?>/type/1"
                                        scrolling="no" style="float: right">
                                </iframe>
                            </figcaption>
                            <div class="clear"></div>
                        </figure><?php endforeach; endif; ?>
                </section>
                <!--推荐关注end-->
            </aside>
            <div class="clear"></div>
        </section>
        <!--主体部分end-->
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