<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/3 0003
 * Time: 下午 19:10
 */
class FollowAction extends Action{
    public function index(){
//        查询当前用户有没点关注过此事物（比如另一个用户）
        $follow=M('follow');

//        $condition['userid']就是当前登录用户的id
        $condition['userid']=$_SESSION['userid'];
        $this->userid=$condition['userid'];

//        $_GET['id']就是当前内容（比如文章）的id
        $condition['tid']=$_GET['id'];
        $this->tid=$condition['tid'];

//      $condition['typeid']就是当前事物所属类型的id
        $condition['typeid']=$_GET['type'];
        $this->typeid=$condition['typeid'];

        $this->isfollow=$follow->where($condition)->count();

 //        查询当前事物的关注数
        $numarr['tid']=$_GET['id'];
        $numarr['typeid']=$_GET['type'];
        $this->fabnum=$follow->where($numarr)->count();


        $this->display();
    }

    // 关注
    public function addfollow(){
        if(!session('login') || !session('userid')){
            echo "no";
            exit;
        }
        $follow=M('follow');
        $_POST['tid']=$this->_get('thing');
        $_POST['userid']=$this->_get('user');
        $_POST['typeid']=$this->_get('type');
        if($this->_get('fab')){
            $follow->create();
            $follow->add();
            echo 1;
        }else {
            $follow->where($_POST)->delete();
            echo 0;
        }
    }

}