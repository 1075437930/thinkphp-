<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/1
 * Time: 16:55
 */
class LoginAction extends Action{
    public function logincheck(){
        $user=M('user');
        $_POST['username']=$_POST['user'];
        $_POST['password']=md5($_POST['password']);
        $row=$user->where($_POST)->find();
        if($row){
            session('username',$row['username']);
            session('userid',$row['id']);
            session('img',$row['img']);
            session('login',1);

            echo 1;
        }else{
            echo "用户名或密码错误";
        }
    }

    public function loginout(){
        session('username',null);
        session('userid',null);
        session('img',null);
        session('login',null);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function register(){
        $class = M('class');
//        查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();

//       将当前的操作名分配到模板
        $this->action = ACTION_NAME;


        $this->display();
    }

//    注册处理
    public function registerHandle(){
        $user=M('user');
        $_POST['username']=$this->_post('user');
        $_POST['password']=md5($this->_post('password'));
        $_POST['email']=$this->_post('email');
       if(md5($_POST['verify'])==$_SESSION['verify']){
           $user->add($_POST);
            echo 1;
       }else{
           echo "验证码错误";
       }
    }

//    注册成功页面
    public function success(){
        $class = M('class');
//        查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();



        $this->display();
    }

//    验证码
    public function verify(){
        import("ORG.Util.Image");
        Image::buildImageVerify(4,1,'png');
    }

//    检查注册用户名是否已经存在
    public function isexistence(){
        $user=M('user');
        $row=$user->where("username={$_POST['user']}")->find();
        if($row){
//            返回字符串false代表用户名已经存在
            echo "false";
        }else{
            echo "true";
        }
    }
}