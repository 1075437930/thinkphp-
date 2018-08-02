<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/20
 * Time: 21:00
 */
class CheckAction extends Action{
    public function _initialize(){
        if($_SESSION['login']!=1 || $_SESSION['admin']!=1){
            $this->error('权限不足',U('Login/login'));
            exit;
        }
    }
}