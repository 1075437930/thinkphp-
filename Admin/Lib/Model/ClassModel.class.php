<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 18:51
 */
class ClassModel extends Model{
    protected $_validate=array(
        array('name','require','栏目名称不能为空',),
        array('pid','require','请选择父栏目'),
        array('typeid','require','请选择模型'),
    );
}