<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/13
 * Time: 15:18
 */
class UserAction extends CheckAction{
    public function admin(){
        import('ORG.Util.Page');
        $user=M('user');
        $count=$user->where('admin=1')->count();
        $length=10;
        $page=new Page($count,$length);
        $this->show=$page->show();
        $this->rows=$user->where('admin=1')->limit($page->firstRow,$length)->select();
        $this->display();
    }

    public function add(){
        $this->display();
    }

    public function upload(){
        import('ORG.Net.UploadFile');
        $up=new UploadFile();
        $up->savePath="Public/Uploads/headport/";
        $up->upload();
        $info=$up->getUploadFileInfo();
        $path="Public/Uploads/headport/".$info[0]['savename'];
        $tpath=__ROOT__.'/'.thumb($path,66,66);
        $this->path=$tpath;
        $this->display();
    }

    public function insert(){
        $user=D('User');
        $_POST['username']=$this->_post('username');
        $_POST['password']=$this->_post('password');
        $_POST['email']=$this->_post('email');
        $_POST['img']=$this->_post('head');
        if($user->create()){
            $user->password=md5($user->password);
            $user->regtime=time();
            $user->lastred=time();
            $user->add();
            if($this->_post('admin')==1) {
                $this->success('添加成功', U('admin'));
            }else{
                $this->success('添加成功', U('manage'));
            };

        }else{
            $this->error($user->getError());
        }
    }

    public function edit(){
        $user=M('user');
        $this->row=$user->find($this->_get('id'));
        $this->display();
    }

    public function update(){
        $user=D('User1');
        $row=$user->select($this->_post('id'));
        $_POST['email']=$this->_post('email');
        $_POST['img']=$this->_post('head');
        if($row[0]['password']==md5($this->_post('password'))){
            if($this->_post('newpassword')!='') {
                if($_POST['email']!='') {
                    $_POST['password'] = md5($this->_post('newpassword'));
                    $user->save($_POST);
                    if($this->_post('admin')==1) {
                        $this->success('修改成功', U('admin'));
                    }else{
                        $this->success('修改成功', U('manage'));
                    }
                }else{
                    $this->error('邮箱不能为空');
                }
            }else{
                $this->error('新密码不能为空');
            }
        }else{
            $this->error('原密码输入错误');
        }
    }

    public function delete(){
        $user=M('user');
        if($_GET['id']) {
            if ($user->delete($this->_get('id'))) {
                $this->success('删除成功');
            }
        }elseif($_GET['all']){
            if ($user->delete($this->_get('all'))) {
               echo "删除成功";
            }
        }
    }

    public function manage(){
        import('ORG.Util.Page');
        $user=M('user');
        $count=$user->where('admin=0')->count();
        $length=10;
        $page=new Page($count,$length);
        $this->show=$page->show();
        $order=isset($_GET['seq'])?$_GET['seq']:1;
        if($order==1){
            $this->rows=$user->where('admin=0')->limit($page->firstRow,$length)->select();
        }else{
            $this->rows=$user->where('admin=0')->order('id desc')->limit($page->firstRow,$length)->select();
        }
        $this->order=$order;
        $this->display();
    }

    public function adduser(){

        $this->display();
    }
    public function edituser(){
        $user=M('user');
        $this->row=$user->find($this->_get('id'));
        $this->display();
    }


}