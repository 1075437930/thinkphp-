<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/13
 * Time: 18:29
 */
class UserModel extends Model{
    protected $_validate=array(
        array('username','require','用户名不能为空'),
        array('password','require','密码不能为空'),
        array('email','email','邮箱地址有误'),
        array('repassword','password','两次密码不一致',3,'confirm')
    );
}