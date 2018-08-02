<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 11:50
 */
class User1Model extends Model{
    protected $tableName="user";

    protected $_validate=array(
        array('password','require','原密码不能为空')
    );
}