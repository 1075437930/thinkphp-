<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 7:26
 */
class HeadUploadAction extends Action{
    public function index(){
        $this->display();
    }
//    ajax上传头像
    public function ajaxupload(){
        import('ORG.Net.UploadFile');
        $up=new UploadFile();
        $up->savePath='Public/Uploads/headport/';
        if($up->upload()){
            $info=$up->getUploadFileInfo();
            $tpath='Public/Uploads/headport/'.$info[0]['savename'];
            thumb($tpath,350,350);
            unlink($tpath);
            echo 'thumb_'.$info[0]['savename'];
        }else{
            echo $up->getErrorMsg();
        }
    }

//    裁剪头像并保存
    public function cutimg(){

        $user=M('user');
        $modi['id']=$_SESSION['userid'];
        $modi['img']= __ROOT__.'/'.cut($_POST['file'],66,66,$_POST['x'],$_POST['y'],$_POST['w'],$_POST['h']);
        unlink($_POST['file']);
        if($user->save($modi)){
            $_SESSION['img']=$modi['img'];
            $this->display();
        }
    }

//    删除刚刚上传的图片
    public function imgdel(){
//        首先删除缩略图
        unlink($_POST['file']);
//    然后删除与其对应的原图
        unlink(str_replace('thumb_','',$_POST['file']));
    }

//    撤销头像
    public function revokeimg(){
        $arr=explode('/',$_POST['file']);
        $name=array_pop($arr);
        $path='Public/Uploads/headport/'.$name;
        unlink($path);
        $modi['img']='';
        $modi['id']=$_SESSION['userid'];
        $user=M('user');
        $user->save($modi);
        $_SESSION['img']='';
        $this->display();
    }
}