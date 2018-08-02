<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/19
 * Time: 16:56
 */
class SayModel extends Model{
    protected $_validate=array(
        array('title','require','标题不能为空'),
        array('content','require','内容不能为空'),

    );
}