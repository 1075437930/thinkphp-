<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script>
       window.parent.document.getElementsByClassName('view')[0].src="<?php echo ($path); ?>";
       window.parent.document.getElementsByTagName('form')[0].head.value="<?php echo ($path); ?>";
    </script>
</head>
<body>

</body>
</html>