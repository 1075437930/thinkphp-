<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/16
 * Time: 18:13
 */
class ArticleModel extends Model{
    protected $_validate=array(
        array('title','require','标题不能为空'),
        array('keywords','require','关键词不能为空'),
        array('source','require','来源不能为空'),
        array('content','require','内容不能为空'),
    );
}