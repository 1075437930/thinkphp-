<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/17
 * Time: 19:41
 */
include "GD.php";
echo cut($_POST['file'],200,200,$_POST['x'],$_POST['y'],$_POST['w'],$_POST['h']);