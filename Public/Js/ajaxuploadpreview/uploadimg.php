<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/16
 * Time: 22:11
 */
include "GD.php";
$tmp=$_FILES['file']['tmp_name'];
$name=$_FILES['file']['name'];
$type=$_FILES['file']['type'];
$typearr=explode('/',$type);
$ty=$typearr[0];
$arr=explode('.',$name);
$hz=array_pop($arr);
//    文件保存名
$cl=time().mt_rand().'.'.$hz;
//    文件保存路径
$path="../../Uploads/say/".$cl;
if($ty=='application') {
    echo "格式不支持";
    exit;
}else{
    move_uploaded_file($tmp, $path);
}
$url="/jin/Public/Uploads/say/".$cl;
if($ty=='image'){
    $tanme=thumb($path,300,300);
    $turl="/jin/Public/Uploads/say/". $tanme;
}
echo "<div class='uploaditem'>";
if($ty=='image') {
    echo "<img src='{$turl}'>";
    echo "<div><img src='{$turl}'></div>";
}elseif($ty=='audio'){
    echo "<audio src='{$url}' controls></audio>";
    echo "<div><audio src='{$url}' controls></audio></div>";
}elseif($ty=='video'){
    echo "<video src='{$url}' controls></video>";
    echo "<div><video src='{$url}' controls></video></div>";
}
echo "<span class='del' dur='{$path}'>X</span>";

echo "</div>";

