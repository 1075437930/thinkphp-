<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script src="__TMPL__/HeadUpload/jquery-1.10.2.min_65682a2.js"></script>
    <script src="__TMPL__/HeadUpload/ajaxfileupload.js"></script>
    <!--加载jcrop图片裁剪插件start-->
    <link rel="stylesheet"
          href="__TMPL__/HeadUpload/jcrop/css/jquery.Jcrop.css">
    <script src="__TMPL__/HeadUpload/jcrop/js/jquery.Jcrop.js"></script>
    <!--加载jcrop图片裁剪插件end-->
    <script>
        var ajaxupload = "<?php echo U('ajaxupload');?>";
        var cutimg = "<?php echo U('cutimg');?>";
        var imgdel = "<?php echo U('imgdel');?>";
        var revokeimg="<?php echo U('revokeimg');?>";
    </script>
    <link href="__TMPL__/HeadUpload/headupload.css" rel="stylesheet">
    <script src="__TMPL__/HeadUpload/headupload.js"></script>
</head>
<body>
<?php if($_SESSION['login'] == 1): ?><div class="blue">
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
    <?php else: ?>
    <p>请先登录</p><?php endif; ?>
    <div class="modal"></div>
</body>
</html>