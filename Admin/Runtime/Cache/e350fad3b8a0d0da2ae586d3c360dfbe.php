<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>修改内容</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Public/Css/showcons.css">
    <link rel="stylesheet" href="../Public/Js/kindeditor/themes/default/default.css" />
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <script charset="utf-8" src="../Public/Js/kindeditor/kindeditor-min.js"></script>
    <script charset="utf-8" src="../Public/Js/kindeditor/lang/zh_CN.js"></script>
    <script src="../Public/Js/addcons.js"></script>
    <script src="../Public/js/showupload.js"></script>
    <script>
        var ins="<?php echo U('updatecons');?>";
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
    <p class="menu"><a href="javascript:" class="btn btn-danger" onclick="history.back();">返回管理内容</a> </p>
    <!--修改文章start-->
    <?php if($_GET['type'] == 1): ?><h1><span class="glyphicon glyphicon-wrench"></span>修改文章</h1>
    <form action="__URL__/updatecons" method="post"  target="">
        <div class="form-group">
            <label >文章标题</label>
            <input type="text" class="form-control" name="title" value="<?php echo ($row['title']); ?>">
        </div>
        <input type="hidden" name="type" value="<?php echo ($_GET['type']); ?>">
        <input type="hidden" name="id" value="<?php echo ($row['id']); ?>">
        <div class="form-group">
            <label >关键词</label>
            <input type="text" class="form-control" name="keywords" value="<?php echo ($row['keywords']); ?>">
        </div>
        <div class="form-group">
            <label >来源</label>
            <input type="text" class="form-control" name="source" value="<?php echo ($row['source']); ?>">
        </div>

        <div class="form-group">
            <label>选择专题</label>
            <select class="form-control" name="special">
                <?php if(is_array($rows2)): foreach($rows2 as $key=>$row2): if($row2['id'] == $row['specialid']): ?><option value="<?php echo ($row2['id']); ?>" selected><?php echo ($row2['name']); ?></option>
                        <?php else: ?>
                        <option value="<?php echo ($row2['id']); ?>"><?php echo ($row2['name']); ?></option><?php endif; endforeach; endif; ?>
            </select>
        </div>

        <div class="form-group">
            <label >文章内容</label>
            <textarea class="form-control" name="content">
                <?php echo htmlspecialchars_decode($row['content']);?>
            </textarea>
        </div>
        <div class="form-group">
            <label>推荐位选择</label>
            <div class="checkbox">
                <?php if(is_array($pos)): foreach($pos as $key=>$row2): ?><label>
                        <?php if(in_array($row2['id'],$posi)): ?><input type="checkbox" value="<?php echo ($row2['id']); ?>" checked> <?php echo ($row2['name']); ?>
                            <?php else: ?>
                            <input type="checkbox" value="<?php echo ($row2['id']); ?>"> <?php echo ($row2['name']); endif; ?>
                    </label>
                    &nbsp;<?php endforeach; endif; ?>
            </div>
        </div>
        <input type="hidden" name="position" value="">
        <button type="submit" class="btn btn-default">确认</button>
    </form>
        <!--修改文章end-->

        <!--修改音乐start-->
      <?php elseif($_GET['type'] == 2): ?>
        <form action="__URL__/updatecons" method="post" target="" enctype="multipart/form-data">
            <div class="form-group">
                <label>歌曲名</label>
                <input type="text" class="form-control" name="title" value="<?php echo ($row['title']); ?>">
            </div>

            <div class="form-group">
                <label>歌手名</label>
                <input type="text" class="form-control" name="source" value="<?php echo ($row['artist']); ?>">
            </div>
            <input type="hidden" name="type" value="<?php echo ($_GET['type']); ?>">
            <input type="hidden" name="id" value="<?php echo ($row['id']); ?>">

            <div class="form-group">
                <label>简介</label>
            <textarea class="form-control" name="description">
              <?php echo htmlspecialchars_decode($row['description']);?>
            </textarea>
            </div>

            <div class="form-group">
                <label>音乐缩略图</label>
                <input type="file" class="form-control" name="img">
                <img src="<?php echo ($row['img']); ?>"  width="100px" height="100px" alt=""><span>替换为</span><img src="" class="view" width="100px" height="100px" alt="">
                <input type="hidden" name="head" value="<?php echo ($row['img']); ?>" >
                <input type="hidden" value="<?php echo ($row['img']); ?>" class="help">
                <p class="text-danger">(*如不需要改变缩略图可以不用上传)</p>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                    音频
                </button>
                <span class="showmusic"></span>
                <br/>
                <span>已有音频:</span><?php echo ($row['url']); ?>
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
                                        <input type="text" class="form-control" name="link" value="">
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
                    <?php if(is_array($pos)): foreach($pos as $key=>$row2): ?><label>
                            <?php if(in_array($row2['id'],$posi)): ?><input type="checkbox" value="<?php echo ($row2['id']); ?>" checked> <?php echo ($row2['name']); ?>
                                <?php else: ?>
                                <input type="checkbox" value="<?php echo ($row2['id']); ?>"> <?php echo ($row2['name']); endif; ?>
                        </label>
                        &nbsp;<?php endforeach; endif; ?>
                </div>
            </div>
            <input type="hidden" name="position" value="">
            <button type="submit" class="btn btn-default">确认</button>
        </form>
        <iframe name="uploadbox"></iframe>
        <!--修改音乐end-->

        <!--修改说说start-->
        <?php elseif($_GET['type'] == 3): ?>
        <h1><span class="glyphicon glyphicon-wrench"></span>修改说说</h1>
        <form action="__URL__/updatecons" method="post"  target="">
            <div class="form-group">
                <label >说说标题</label>
                <input type="text" class="form-control" name="title" value="<?php echo ($row['title']); ?>">
            </div>
            <input type="hidden" name="type" value="<?php echo ($_GET['type']); ?>">
            <input type="hidden" name="id" value="<?php echo ($row['id']); ?>">
            <div class="form-group">
                <label >发表人</label>
                <input type="text" class="form-control" name="source" value="<?php echo ($user); ?>" disabled>
            </div>
            <div class="form-group">
                <label >说说内容</label>
        <textarea class="form-control" name="content">
            <?php echo htmlspecialchars_decode($row['content']);?>
        </textarea>
            </div>
            <div class="form-group">
                <label>推荐位选择</label>
                <div class="checkbox">
                    <?php if(is_array($pos)): foreach($pos as $key=>$row2): ?><label>
                            <?php if(in_array($row2['id'],$posi)): ?><input type="checkbox" value="<?php echo ($row2['id']); ?>" checked> <?php echo ($row2['name']); ?>
                                <?php else: ?>
                                <input type="checkbox" value="<?php echo ($row2['id']); ?>"> <?php echo ($row2['name']); endif; ?>
                        </label>
                        &nbsp;<?php endforeach; endif; ?>
                </div>
            </div>
            <input type="hidden" name="position" value="">
            <button type="submit" class="btn btn-default">确认</button>
        </form>
        <!--修改说说end-->
        <!--修改视频start-->
        <?php elseif($_GET['type'] == 4): ?>
        <form action="__URL__/updatecons" method="post" target="" enctype="multipart/form-data">
            <div class="form-group">
                <label>视频标题</label>
                <input type="text" class="form-control" name="title" value="<?php echo ($row['title']); ?>">
            </div>

            <input type="hidden" name="type" value="<?php echo ($_GET['type']); ?>">
            <input type="hidden" name="id" value="<?php echo ($row['id']); ?>">

            <div class="form-group">
                <label>简介</label>
            <textarea class="form-control" name="description">
              <?php echo htmlspecialchars_decode($row['description']);?>
            </textarea>
            </div>

            <div class="form-group">
                <label>视频缩略图</label>
                <input type="file" class="form-control" name="img">
                <img src="<?php echo ($row['img']); ?>"  width="100px" height="100px" alt=""><span>替换为</span><img src="" class="view" width="100px" height="100px" alt="">
                <input type="hidden" name="head" value="<?php echo ($row['img']); ?>" >
                <input type="hidden" value="<?php echo ($row['img']); ?>" class="help">
                <p class="text-danger">(*如不需要改变缩略图可以不用上传)</p>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                    视频
                </button>
                <span class="showmusic"></span>
                <br/>
                <span>已有音频:</span><?php echo ($row['url']); ?>
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
                                        <input type="text" class="form-control" name="link" value="">
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
                    <?php if(is_array($pos)): foreach($pos as $key=>$row2): ?><label>
                            <?php if(in_array($row2['id'],$posi)): ?><input type="checkbox" value="<?php echo ($row2['id']); ?>" checked> <?php echo ($row2['name']); ?>
                                <?php else: ?>
                                <input type="checkbox" value="<?php echo ($row2['id']); ?>"> <?php echo ($row2['name']); endif; ?>
                        </label>
                        &nbsp;<?php endforeach; endif; ?>
                </div>
            </div>
            <input type="hidden" name="position" value="">
            <button type="submit" class="btn btn-default">确认</button>
        </form>
        <iframe name="uploadbox"></iframe>
        <!--修改视频end--><?php endif; ?>
</div>
</body>
</html>