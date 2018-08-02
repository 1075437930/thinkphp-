<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/19
 * Time: 22:14
 */
class CommentAction extends CheckAction{
    public function index(){
        import("ORG.Util.Page");
        $comment=M('comment');
        $count=$comment->count();
        $length=10;
        $page=new Page($count,$length);
        $this->show=$page->show();
        $user=M('user');
        $article=M('article');
        $music=M('music');
        $say=M('say');
        $video=M('video');
        $order = isset($_GET['seq']) ? $_GET['seq'] : 0;
        if ($order == 1) {
            $rows = $comment->limit($page->firstRow, $length)->select();
        }else{
            $rows = $comment->limit($page->firstRow, $length)->order('time desc')->select();
        }
        foreach($rows as &$row){
            $row['user']=$user->find($row['userid'])['username'];
            if($row['typeid']==1){
                $row['title']=$article->find($row['tingid'])['title'];
                $row['type']='文章';
            }
            if($row['typeid']==2){
                $row['title']=$music->find($row['tingid'])['title'];
                $row['type']='音乐';
            }
            if($row['typeid']==3){
                $row['title']=$say->find($row['tingid'])['title'];
                $row['type']='说说';
            }
            if($row['typeid']==4){
                $row['title']=$video->find($row['tingid'])['title'];
                $row['type']='视频';
            }
        }
        $this->order=$order;
        $this->rows=$rows;
        $this->display();
    }

    public function look(){
        $comment=M('comment');
        $user=M('user');
        $article=M('article');
        $music=M('music');
        $say=M('say');
        $video=M('video');
        $row=$comment->find($_GET['id']);
        $row['user']=$user->find($row['userid'])['username'];
        if($row['typeid']==1){
            $row['title']=$article->find($row['tingid'])['title'];
            $row['type']='文章';
        }
        if($row['typeid']==2){
            $row['title']=$music->find($row['tingid'])['title'];
            $row['type']='音乐';
        }
        if($row['typeid']==3){
            $row['title']=$say->find($row['tingid'])['title'];
            $row['type']='说说';
        }
        if($row['typeid']==4){
            $row['title']=$video->find($row['tingid'])['title'];
            $row['type']='视频';
        }
        $this->row=$row;
        $this->display();
    }

    public function deletecomment(){
        $comment=M('comment');
        if($_GET['id']){
            $comment->delete($_GET['id']);
            $this->success('删除成功',U('index'));
        }elseif($_GET['all']){
            $comment->delete($_GET['all']);
            echo "删除成功";
        }
    }
}