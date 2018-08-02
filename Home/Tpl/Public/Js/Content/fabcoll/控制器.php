<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/3 0003
 * Time: 下午 19:10
 */
class ContentAction extends Action{
    public function artcon(){
//        查询当前用户有没点赞过此内容
        $fabulous=M('fabulous');

//        $condition['userid']就是当前登录用户的id
        $condition['userid']=$_SESSION['userid'];
        $this->userid=$condition['userid'];

//        $_GET['id']就是当前内容（比如文章）的id
        $condition['tid']=$_GET['id'];
        $this->tid=$condition['tid'];

//      $condition['typeid']就是当前内容所属模型的id
        $condition['typeid']=1;
        $this->typeid=$condition['typeid'];

        $this->isfab=$fabulous->where($condition)->count();

 //        查询当前内容的点赞数
        $numarr['tid']=$_GET['id'];
        $numarr['typeid']=1;
        $this->fabnum=$fabulous->where( $numarr)->count();

//         查询当前用户有没收藏过此篇文章
        $coll=M('coll');
        $this->iscoll=$coll->where($condition)->count();

 //       查询当前内容的收藏数
        $this->collnum=$coll->where( $numarr)->count();

        $this->display();
    }

    // 点赞
    public function addfab(){
        if(!session('login') || !session('userid')){
            echo "no";
            exit;
        }
        $fabulous=M('fabulous');
        $_POST['tid']=$this->_get('thing');
        $_POST['userid']=$this->_get('user');
        $_POST['typeid']=$this->_get('type');
        if($this->_get('fab')){
            $fabulous->create();
            $fabulous->add();
            echo 1;
        }else {
            $fabulous->where($_POST)->delete();
            echo 0;
        }
    }

//    收藏
    public function collhand(){
        if(!session('login') || !session('userid')){
            echo "no";
            exit;
        }
        $coll=M('coll');
        $_POST['tid']=$this->_get('thing');
        $_POST['userid']=$this->_get('user');
        $_POST['typeid']=$this->_get('type');
        if($this->_get('fab')){
            $coll->create();
            $coll->add();
            echo 1;
        }else {
            $coll->where($_POST)->delete();
            echo 0;
        }
    }
}