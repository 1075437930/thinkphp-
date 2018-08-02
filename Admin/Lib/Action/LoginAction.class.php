<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/20
 * Time: 18:49
 */
class LoginAction extends Action{
    public function login(){

        $this->display();

    }
    public function check(){
        $user=D('User2');
        $_POST['password']=md5($this->_post('password'));
        if($user->create()){
            $row=$user->where($_POST)->find();
            if(!empty($row)){
                if($row['admin']==1) {
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['login'] = 1;
                    $_SESSION['admin'] = 1;
                    $_SESSION['img']=$row['img'];
                    $this->success('登录成功',U('Index/index'));
                }else{
                    $this->error('用户权限不足');
                }
            }else{
                $this->error('用户名或密码错误');
            }
        }else{
            $this->error($user->getError());
        }
    }

    public function verify(){
        import("ORG.Util.Image");
        Image::buildImageVerify(4,1,'png');
    }

    //修改登录管理员的密码
    public function update(){
        $user=D('User');
        $row=$user->find($_SESSION['userid']);
        if(md5($_POST['password'])==$row['password']){
            if($_POST['newpassword']!=''){
                $_POST['password']=md5($_POST['newpassword']);
                $_POST['id']=$_SESSION['userid'];
                if($user->save($_POST)){
                    $this->success('密码修改成功');
                }
            }else{
                $this->error('新密码不能为空');
            }
        }else{
            $this->error('原密码输入错误');
        }
    }

    //退出登录
    public function loginout(){
        session(null);
        session('[destroy]');
        cookie(session_name(),null);
        $this->success('退出成功',U('login'));
    }
}