<?php
/**
 * @param $file  原图的路径
 * @param $minw  缩略图最大宽度
 * @param $minh  缩略图最大高度
 */
function thumb($file,$minw,$minh){
//    获取大图的图像信息
     $imgarr=getimagesize($file);
     $maxw=$imgarr[0];
     $maxh=$imgarr[1];
     $maxt=$imgarr[2];
     $dir=dirname($file);
     $basename=basename($file);
     $minpath=$dir.'/thumb_'.$basename;
//     变量函数(就是把函数名赋值给一个变量) 判断大图的格式，然后将对应的获取图片资源的函数赋值给变量
     switch($maxt){
         case 1:
             $imgfun='imagecreatefromgif';
             break;
         case 2:
             $imgfun='imagecreatefromjpeg';
             break;
         case 3:
             $imgfun='imagecreatefrompng';
             break;
     }

//    获取大图资源
    $max=$imgfun($file);

//    根据缩略图的最大宽高计算缩放比例（等比例）
    $scale=($maxw/$minw)>($maxh/$minh)?($maxw/$minw):($maxh/$minh);

//    计算缩略图的真实宽高
    $minw=floor($maxw/$scale);
    $minh=floor($maxh/$scale);

//    创建目标画布
    $min=imagecreatetruecolor($minw,$minh);

//    对大图进行等比例缩放
    imagecopyresampled($min,$max,0,0,0,0,$minw,$minh,$maxw,$maxh);

//    判断大图的格式，然后将对应的保存图片的函数赋值给变量
    switch($maxt){
        case 1:
            $imgour='imagegif';
            break;
        case 2:
            $imgour='imagejpeg';
            break;
        case 3:
            $imgour='imagepng';
            break;
    }
//    保存缩略图
    $imgour($min,$minpath,90);

//    返回缩略图的网站相对路径
    return 'thumb_'.$basename;
}