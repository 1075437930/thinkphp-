<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/20
 * Time: 16:33
 */
class AdvertisementModel extends Model{
    protected $_validate=array(
        array('title','require','标题不能为空'),
        array('url','require','广告链接不能为空'),
    );
}