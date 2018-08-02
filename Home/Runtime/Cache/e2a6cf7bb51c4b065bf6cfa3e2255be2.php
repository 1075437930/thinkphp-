<?php if (!defined('THINK_PATH')) exit();?><figure class="head">
    <img src="<?php echo ($_SESSION['img']); ?>">
    <ul>
        <i></i>
        <li class="revoke">撤销头像</li>
        <input type="file" name="img" id="file1">
        <li class="del">取消</li>
    </ul>
</figure>