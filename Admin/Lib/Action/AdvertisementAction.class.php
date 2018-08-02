<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/20
 * Time: 13:04
 */
class AdvertisementAction extends CheckAction{
    public function index(){
        import("ORG.Util.Page");
        $advertisement=M('advertisement');
        $count=$advertisement->count();
        $length=10;
        $page=new Page($count,$length);
        $this->show=$page->show();
        $order = isset($_GET['seq']) ? $_GET['seq'] : 0;
        if ($order == 1) {
            $this->rows = $advertisement->limit($page->firstRow, $length)->select();
        }else{
            $this->rows = $advertisement->order('inputtime desc')->limit($page->firstRow, $length)->select();
        }
        $this->order=$order;

        $this->display();
    }

    public function add(){
        $adverposition=M('adverpo');
        $this->pos=$adverposition->select();
        $this->display();
    }

    public function insert(){
        import("ORG.Net.UploadFile");
        $up=new UploadFile();
        $up->savePath='Public/Uploads/adver/';
        $up->allowExts=array('jpg','png','gif');
        $advertisement=D('Advertisement');
        $_POST['title']=$this->_post('title');
        $_POST['url']=$this->_post('link');
        $_POST['inputtime']=time();
        $_POST['posid']=$this->_post('position');
        if($advertisement->create()){
            if($up->upload()){
                $info=$up->getUploadFileInfo();
                $name=$info[0]['savename'];
                $advertisement->img=$name;
                if($advertisement->add()){
                    $this->success('添加成功',U('index'));
                }
            }else{
                $this->error($up->getErrorMsg());
            }
        }else{
            $this->error($advertisement->getError());
        }
    }

    public function edit(){
        $advertisement=D('Advertisement');
        $adverposition=M('adverpo');
        $this->pos=$adverposition->select();
        $this->row=$advertisement->find($_GET['id']);
        $this->posi=explode('-',$this->row['posid']);

        $this->display();
    }

    public function update(){
        import("ORG.Net.UploadFile");
        $up=new UploadFile();
        $up->savePath='Public/Uploads/adver/';
        $up->allowExts=array('jpg','png','gif');
        $advertisement=D('Advertisement');
        $_POST['posid']=$this->_post('position');
        $_POST['title']=$this->_post('title');
        $_POST['url']=$this->_post('link');
        if($advertisement->create()){
            if($up->upload()){
                $info=$up->getUploadFileInfo();
                $name=$info[0]['savename'];
                $advertisement->img=$name;
                if($advertisement->save()){
                    $this->success('修改成功',U('index'));
                }
            }else{
                if($advertisement->save()){
                    $this->success('修改成功',U('index'));
                }
            }
        }else{
            $this->error($advertisement->getError());
        }
    }

    public function delete(){
        $advertisement=D('Advertisement');
        if($_GET['id']){
            $row=$advertisement->find($_GET['id']);
            if ($advertisement->delete($_GET['id'])) {
                unlink('Public/Uploads/adver/'. $row['img']);
                $this->success('删除成功');
            }
        }elseif($_GET['all']){
            $rows=$advertisement->select($_GET['all']);
            if ($advertisement->delete($_GET['all'])) {
                foreach ($rows as $row) {
                    unlink('Public/Uploads/adver/'. $row['img']);
                }
                echo '删除成功';
            }
        }
    }

    //广告位置管理
    public function recommend(){
        import("ORG.Util.Page");
        $position=M('adverpo');
        $count = $position->count();
        $length=10;
        $page = new Page($count, $length);
        $this->show = $page->show();
        $this->rows=$position->limit($page->firstRow,$length)->select();
        $this->display();
    }

    //添加推荐位
    public function addrecommend(){

        $this->display();
    }

    public function insertrecommend(){
        $position=M('adverpo');
        $_POST['name']=$this->_post('name');
        if($_POST['name']!=''){
            $position->add($_POST);
            $this->success('添加成功',U('recommend'));
        }else{
            $this->error('名称不能为空');
        }
    }

    //修改推荐位
    public function editrecommend(){
        $position=M('adverpo');
        $this->row=$position->find($_GET['id']);
        $this->display();
    }

    public function updaterecommend(){
        $position=M('adverpo');
        $_POST['name']=$this->_post('name');
        if($_POST['name']!=''){
            $position->save($_POST);
            $this->success('修改成功',U('recommend'));
        }else{
            $this->error('名称不能为空');
        }
    }
    //删除推荐位
    public function deleterecommend(){
        $position=M('adverpo');
        if($_GET['id']){
            $position->delete($_GET['id']);
            $this->success('删除成功',U('recommend'));
        }elseif($_GET['all']){
            $position->delete($_GET['all']);
            echo '删除成功';
        }
    }
}