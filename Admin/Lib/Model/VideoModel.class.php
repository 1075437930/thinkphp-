<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/19
 * Time: 17:26
 */
class VideoModel extends Model{
    protected $_validate=array(
        array('title','require','视频标题不能为空'),
//        array('img','require','缩略图不能为空')
    );
}