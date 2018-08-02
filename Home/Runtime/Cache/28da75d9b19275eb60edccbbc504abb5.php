<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <style>
        *{
            margin: 0;
            padding: 0;
            outline:none ;
            text-decoration: none;
            font-family: '微软雅黑';
            border: 0;
        }
        .clear{
            clear: both;
        }
        /*回复弹框样式start*/
        .wrap{
            background-color: white;
            position: relative;
            width: 580px;
            padding: 30px;
            margin: 0 auto;
            border-radius: 10px;
            z-index: 20;
            margin-top: 70px;
        }
        .close {
            color: white;
            position: absolute;
            right: -29px;
            top: 0;
            font-size: 21px;
            cursor: pointer;
        }

        .replay_heading img+a {
            float: left;
            margin-left: 14px;
            color: #14171A;
            font-size: 21px;
        }
        .replay_heading img+a:hover{
            color: #0084B4;
            text-decoration: underline;
        }
        .replay_heading img {
            width: 40px;
            height: 40px;
            float: left;
        }
        .replay_box_con {
            font-size: 2em;
            color: #14171A;
            word-wrap: break-word;
            border-bottom: 1px solid #E6ECF0;
            line-height: 68px;
        }

        .replay_heading iframe {
            float: right;
            margin-top: 4px;
        }
        .wraptime {
            color: #657786;
            display: block;
            margin-top: 8px;

        }
        .modal{
            background-color: #000000;
            position:fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.5;
            z-index: 19;
        }
        .source video,.source img{
            width: 100%;
        }
        /*推文列表样式start*/
        .sat_item_b{
            border: 1px solid #ededed;
            padding: 10px;
            cursor: pointer;
        }
        .sat_item_b:hover{
            background-color: #F5F8FA;
        }
        .sat_item_b>img,.sat_item_b figcaption{
            float: left;
        }
        .sat_item_b>img{
            width: 40px;
            height: 40px;
        }
        .sat_item_b figcaption {
            margin-left: 10px;
        }
        .sat_item{
            border: 1px solid #ededed;
            padding: 10px;
            cursor: pointer;
        }
        .sat_item:hover{
            background-color: #F5F8FA;
        }
        .sat_item>img,.sat_item figcaption{
            float: left;
        }
        .sat_item>img{
            width: 40px;
            height: 40px;
        }
        .source>img,.source>video{
            width: 60%;
        }
        .source{
            margin-top: 10px;
        }
        .sat_item figcaption {
            width: 92%;
            margin-left: 10px;
        }
        .say_heading a {
            color: #000000;
            font-weight: bold;
            font-size: 15px;
        }
        .say_heading a+time {
            color: #657786;
            margin-left: 10px;
            font-size: 13px;
        }
        .say_heading+p {
            color: #14172F;
            line-height: 25px;
            font-size: 14px;
            word-wrap: break-word;
        }
        .sat_item_b figcaption{
            width: 70%!important;
        }
        .share_con+div button {
            background-color: #2F9AC3;
            color: #ffffff;
            float: right;
            width: 103px;
            height: 33px;
            cursor: pointer;
        }
        .forward>img{
            float: left;
            width: 40px;
            height: 40px;
        }

        .forward figcaption {
            width: 42%;
            margin-left: 10px;
            float: left;
        }

        .forward:hover{
            background-color: #ffffff;
        }
        /*推文列表样式end*/

        /*回复弹框样式end*/

    </style>
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script>
        $(function(){
            $(document).click(function(){
                $(window.parent.document).find('.replay_box').hide();
                $(window.parent.document).find('body').css({'overflow':'auto'})
            });
            $('.wrap').click(function(e){
                e.stopPropagation();
            })
        })
    </script>
</head>
<body>
    <div class="modal"></div>
    <div class="wrap">
     <span class="close"></span>
    <div class="replay_heading">
        <img src="<?php echo ($row['user']['img']); ?>">
        <a href=""><?php echo ($row['user']['username']); ?></a>
        <!--加载关注模块start-->
        <iframe class='follow' src="__APP__/Follow/index/id/<?php echo ($row['user']['id']); ?>/type/1"
                width="100px" scrolling="no">
        </iframe>
        <!--加载关注模块end-->
        <div class="clear"></div>
    </div>
    <div class="replay_box_con">
        <?php echo htmlspecialchars_decode($row['content']);?>
    </div>
    <div class="source">
        <?php echo htmlspecialchars_decode($row['source']);?>
    </div>
    <?php if(!empty($row['forward'])): ?><div class="forward">
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
    <time><?php echo date('Y-m-d H:i:s',$row['inputtime']);?></time>
    <!--加载评论模块start-->
    <iframe class='iframeId' src="__APP__/Comment/index/id/<?php echo ($row['id']); ?>/type/3"
            width="100%" scrolling="no">
    </iframe>
    <!--加载评论模块end-->
    </div>
</body>
</html>