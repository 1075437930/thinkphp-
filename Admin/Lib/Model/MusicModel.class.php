<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/17
 * Time: 12:25
 */
class MusicModel extends Model{
    protected $_validate=array(
        array('title','require','歌曲名不能为空'),
        array('img','require','缩略图不能为空'),
        array('source','require','来源不能为空'),
        array('description','require','简介不能为空'),
        array('img','require','缩略图不能为空'),

   );
}