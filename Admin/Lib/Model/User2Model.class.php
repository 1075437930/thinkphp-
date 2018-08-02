<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/20
 * Time: 19:11
 */
class User2Model extends Model{
    protected $tableName="user";

    protected $_validate=array(
        array('username','require','用户名不能为空'),
        array('password','require','密码不能为空'),
        array('verify','require','验证码不能为空'),
        array('verify','checkverify','验证码有误',3,'callback')
    );

    function checkverify($v){
        if(md5($v)!=$_SESSION['verify']){
            return false;
        }

    }
}