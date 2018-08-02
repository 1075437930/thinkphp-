<?php
/**
 * @param $file  原图的路径
 * @param $minw  裁剪后图片的最大宽度
 * @param $minh  裁剪后图片的最大高度
 * @param $cutx  截取开始的x坐标（也就是截取的图像的左上点在原图的x坐标）
 * @param $cuty  裁剪开始的y坐标 （也就是截取的图像的左上点在原图的y坐标）
 * @param $cutw  裁剪的宽度
 * @param $cuth  裁剪的高度
 */
function cut($file,$minw,$minh,$cutx,$cuty,$cutw,$cuth){
//    获取大图的图像信息
     $imgarr=getimagesize($file);
     $maxw=$imgarr[0];
     $maxh=$imgarr[1];
     $maxt=$imgarr[2];
     $dir=dirname($file);
     $basename=basename($file);
     $minpath=$dir.'/cut_'.$basename;
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

//    根据裁剪后图片的最大宽高计算缩放比例（等比例）
    $scale=($maxw/$minw)>($maxh/$minh)?($maxw/$minw):($maxh/$minh);

//    计算裁剪后图片的真实宽高
    $minw=floor($maxw/$scale);
    $minh=floor($maxh/$scale);

//    创建目标画布
    $min=imagecreatetruecolor($minw,$minh);

//    对大图进行等比例裁剪
    imagecopyresampled($min,$max,0,0,$cutx,$cuty,$minw,$minh,$cutw,$cuth);

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

//    保存裁剪后的图片
    $imgour($min,$minpath,90);

//    返回裁剪图的网站相对路径
    return $minpath;
}