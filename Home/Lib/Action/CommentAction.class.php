<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/7 0007
 * Time: 下午 15:01
 */
class CommentAction extends Action{
    public function index(){
//       查询当前内容的所有评论
        $comment=M('comment');
        $user=M('user');
        $comcondi['typeid']=$_GET['type'];
        $comcondi['tid']=$_GET['id'];
        $comcondi['pid']=0;
        $rows = $comment->order("time desc")->where($comcondi)->select();
        $this->comm_num=count($rows);
        foreach($rows as &$row){
            $row['user']=$user->find($row['userid']);
            $arr=json_decode($row['fabuser'],true);
            $row['fabnum']=count($arr);
            if(in_array($_SESSION['userid'],$arr)){
                $row['isfab']=1;
            }else{
                $row['isfab']=0;
            }
            $res=array();
            $time=array();
            son($row['id'],$res,$time);
            array_multisort($time,SORT_DESC,$res);
            $row['res']=array_slice($res,0,5);
            $row['num']=count($res);
            $num[]=$row['num']+$row['fabnum'];
        }
        if($_GET['order']=='new'|| !isset($_GET['order'])) {
            $this->comms = array_slice($rows, 0, 5);
        }else{
            array_multisort($num,SORT_DESC,$rows);
            $this->comms = array_slice($rows, 0, 5);
        }
        $this->display();
    }

    //    添加评论
    public function addcomment(){
        if(!session('login') || !session('userid')){
            echo "no";
            exit;
        }
        if($_POST['content']==''){
            echo 0;
            exit;
        }else{
            $comment=M('comment');
            $user=M('user');
            $_POST['userid']=$_SESSION['userid'];
            $_POST['time']=time();
            $_POST['ait']=$this->_post('contact');
            $_POST['content']=$this->_post('content');
            $row=$comment->find($_POST['pid']);
            if($row) {
                $_POST['path'] = $row['path'] . '-' . $row['id'];
                $comment->add($_POST);
                $this->comm=$comment->where($_POST)->find();
                $this->u=$user->find($_POST['userid']);
//                返回回复的模板
                $this->display('replay');
            }else{
                $_POST['path']=0;
                $comment->add($_POST);
                $this->comm=$comment->where($_POST)->find();
                $this->u=$user->find($_POST['userid']);

//                返回评论的模板
                $this->display();
            }
        }
    }

//    加载更多评论
    public function getmorecomment(){
        $comment=M('comment');
        $user=M('user');
        $comcondi['typeid']=$_POST['typeid'];
        $comcondi['tid']=$_POST['tid'];
        $comcondi['pid']=0;
        $rows=$comment->order("time desc")->where($comcondi)->select();
        foreach($rows as &$row){
            $row['user']=$user->find($row['userid']);
            $arr=json_decode($row['fabuser'],true);
            $row['fabnum']=count($arr);
            if(in_array($_SESSION['userid'],$arr)){
                $row['isfab']=1;
            }else{
                $row['isfab']=0;
            }
            $res=array();
            $time=array();
            son($row['id'],$res,$time);
            array_multisort($time,SORT_DESC,$res);
            $row['res']=array_slice($res,0,5);
            $row['num']=count($res);
            $num[]=$row['num']+$row['fabnum'];
        }
        if($_POST['order']=='hot'){
            array_multisort($num,SORT_DESC,$rows);
        }
        $index=$_POST['index']+1;
        $this->comms=array_slice($rows,$index,5);
        $this->display();
    }

//    加载更多回复
    public function getmorereplay(){
        $res=array();
        $time=array();
        son($_POST['id'],$res,$time);
        array_multisort($time,SORT_DESC,$res);
        $this->res=array_slice($res,$_POST['index']+1,5);
        $this->display();
    }

//    评论点赞
    public function addcommfab(){
        if(!session('login') || !session('userid')){
            echo "no";
            exit;
        }
        $comment=M('comment');
        $row=$comment->find($_POST['id']);
        $arr=json_decode($row['fabuser'],true);
        if(in_array($_SESSION['userid'],$arr)){
            echo 0;
        }else{
            $arr[]=$_SESSION['userid'];
            $str=json_encode($arr);
            $_POST['fabuser']=$str;
            $comment->save($_POST);
            echo 1;
        }
    }
}