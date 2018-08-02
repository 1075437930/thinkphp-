<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>添加内容</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Public/Css/showcons.css">
    <link rel="stylesheet" href="../Public/Js/kindeditor/themes/default/default.css"/>
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <script charset="utf-8" src="../Public/Js/kindeditor/kindeditor-min.js"></script>
    <script charset="utf-8" src="../Public/Js/kindeditor/lang/zh_CN.js"></script>
    <script src="../Public/Js/addcons.js"></script>
    <!--<script src="../Public/js/showupload.js"></script>-->
    <script>
        var ins="<?php echo U('insertcons');?>";
        var upload="<?php echo U('upload');?>";
    </script>
    <style>
        iframe[name=uploadbox]{
            display: none;
        }
    </style>
</head>
<body>
<div class="container">
    <p class="menu"><a href="javascript:" class="btn btn-danger" onclick="history.back();">返回管理内容</a></p>
    <!--添加文章start-->
    <?php if($_GET[type] == 1): ?><form action="__URL__/insertcons" method="post" target="">
            <div class="form-group">
                <label>文章标题</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
                <label>关键词</label>
                <input type="text" class="form-control" name="keywords">
            </div>
            <div class="form-group">
                <label>来源</label>
                <input type="text" class="form-control" name="source">
            </div>
            <div class="form-group">
                <label>选择专题</label>
                <select class="form-control" name="special">
                    <?php if(is_array($rows2)): foreach($rows2 as $key=>$row): ?><option value="<?php echo ($row['id']); ?>"><?php echo ($row['name']); ?></option><?php endforeach; endif; ?>
                </select>
            </div>

            <input type="hidden" name="classid" value="<?php echo ($_GET['id']); ?>">
            <input type="hidden" name="type" value="<?php echo ($_GET['type']); ?>">

            <div class="form-group">
                <label>文章内容</label>
            <textarea class="form-control" name="content">

            </textarea>
            </div>
            <div class="form-group">
                <label>推荐位选择</label>
                <div class="checkbox">
                    <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><label>
                            <input type="checkbox" value="<?php echo ($row['id']); ?>"> <?php echo ($row['name']); ?>
                        </label>
                        &nbsp;<?php endforeach; endif; ?>
                </div>
            </div>
            <input type="hidden" name="position" value="">
            <button type="submit" class="btn btn-default">确认</button>
        </form>
        <!--添加文章end-->

        <!--添加音乐start-->
        <?php elseif($_GET['type'] == 2): ?>
        <form action="__URL__/insertcons" method="post" target="" enctype="multipart/form-data">
            <div class="form-group">
                <label>歌曲名</label>
                <input type="text" class="form-control" name="title">
            </div>

            <div class="form-group">
                <label>歌手名</label>
                <input type="text" class="form-control" name="source">
            </div>
            <input type="hidden" name="classid" value="<?php echo ($_GET['id']); ?>">
            <input type="hidden" name="type" value="<?php echo ($_GET['type']); ?>">

            <div class="form-group">
                <label>简介</label>
            <textarea class="form-control" name="description">

            </textarea>
            </div>

            <div class="form-group">
                <label>音乐缩略图</label>
                <input type="file" class="form-control" name="img">
                <img src="" class="view" width="100px" height="100px" alt="">
                <input type="hidden" name="head" value="" >
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                    添加音频
                </button>
                <span class="showmusic"></span>
            </div>

            <!--上传模态框start-->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">上传</a></li>
                                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">超链接</a></li>
                            </ul>

                        </div>
                        <div class="modal-body">

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="form-group">
                                        <label>上传</label>
                                        <input type="file" class="form-control" name="music">
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile">
                                    <div class="form-group">
                                        <label>URL:</label>
                                        <input type="text" class="form-control" name="link">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">确认</button>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            <!--上传模态框end-->

            <div class="form-group">
                <label>推荐位选择</label>

                <div class="checkbox">
                    <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><label>
                            <input type="checkbox" value="<?php echo ($row['id']); ?>"> <?php echo ($row['name']); ?>
                        </label>
                        &nbsp;<?php endforeach; endif; ?>
                </div>
            </div>
            <input type="hidden" name="position" value="">
            <button type="submit" class="btn btn-default">确认</button>
        </form>
        <iframe name="uploadbox"></iframe>
        <!--添加音乐end-->
        <!--添加视频start-->
        <?php elseif($_GET['type'] == 4): ?>
        <form action="__URL__/insertcons" method="post"  >
            <div class="form-group">
                <label>视频标题</label>
                <input type="text" class="form-control" name="title">
            </div>
            <input type="hidden" name="classid" value="<?php echo ($_GET['id']); ?>">
            <input type="hidden" name="type" value="<?php echo ($_GET['type']); ?>">

            <div class="form-group">
                <label>简介</label>
            <textarea class="form-control" name="description">

            </textarea>
            </div>

            <div class="form-group">
                <label>视频缩略图</label>
                <!--<input type="file" class="form-control" name="img">-->
                <img src="" class="view" width="100px" height="100px" alt="">
                <input type="hidden" name="head" value="" >
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1">
                    添加视频
                </button>
                <span class="showmusic"></span>
            </div>

            <!--上传模态框start-->
            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home1" aria-controls="home" role="tab" data-toggle="tab">上传</a></li>
                                <li role="presentation"><a href="#profile1" aria-controls="profile" role="tab" data-toggle="tab">超链接</a></li>
                            </ul>

                        </div>
                        <div class="modal-body">

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home1">
                                    <div class="form-group">
                                        <label>上传</label>
                                        <!--<input type="file" class="form-control" name="music">-->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile1">
                                    <div class="form-group">
                                        <label>URL:</label>
                                        <input type="text" class="form-control" name="link">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">确认</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--上传模态框end-->

            <div class="form-group">
                <label>推荐位选择</label>

                <div class="checkbox">
                    <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><label>
                            <input type="checkbox" value="<?php echo ($row['id']); ?>"> <?php echo ($row['name']); ?>
                        </label>
                        &nbsp;<?php endforeach; endif; ?>
                </div>
            </div>
            <input type="hidden" name="position" value="">
            <button type="submit" class="btn btn-default">确认</button>
        </form>
        <iframe name="uploadbox"></iframe>
        <!--添加视频start--><?php endif; ?>
</div>
</body>
</html>