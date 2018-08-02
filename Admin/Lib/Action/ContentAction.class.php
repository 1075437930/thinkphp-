<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 16:03
 */
class ContentAction extends CheckAction
{
    //管理栏目
    public function column()
    {
        import('ORG.Util.Page');
        $class = M('class');
        $count = $class->count();
        $length = 10;
        $page = new Page($count, $length);
        $this->show = $page->show();
        $type = M('type');
        $rows = $class->order("concat(path,'-',id)")->limit($page->firstRow, $length)->select();
        foreach ($rows as &$row) {
            $num = substr_count($row['path'], '-');
            if ($row['pid'] > 0) {
                $pre = str_repeat('&emsp;&emsp;', $num) . '|_';
            } else {
                $pre = '';
            }
            $row['tree'] = $pre . $row['name'];
            $t = $type->find($row['typeid']);
            $row['type'] = $t['name'];
        }
        $this->rows = $rows;
        $this->display();
    }

    //添加栏目
    public function addcolumn()
    {
        $class = M('class');
        $type = M('type');
        $this->types = $type->select();
        $rows = $class->order("concat(path,'-',id)")->select();
        foreach ($rows as &$row) {
            $num = substr_count($row['path'], '-');
            if ($row['pid'] > 0) {
                $pre = str_repeat('&emsp;&emsp;', $num) . '|_';
            } else {
                $pre = '';
            }
            $row['tree'] = $pre . $row['name'];
        }
        $this->rows = $rows;
        $this->display();
    }

    //获取模型
    public function getmodel()
    {
        $class = M('class');
        $type = M('type');
        if ($_GET['id'] != 0) {
            $row = $class->find($_GET['id']);
            $this->t = $type->find($row['typeid']);
        } else {
            $this->rows = $type->select();
        }
        $this->display();
    }

    public function insertcolumn()
    {
        $class = D('Class');
        $_POST['name'] = $this->_post('name');
        $_POST['typeid'] = $this->_post('model');
        if ($_POST['father'] != 0) {
            $row = $class->select($_POST['father']);
            $_POST['pid'] = $row[0]['id'];
            $_POST['path'] = $row[0]['path'] . '-' . $row[0]['id'];
        } elseif ($_POST['father'] == 0) {
            $_POST['pid'] = 0;
            $_POST['path'] = 0;
        }
        if ($class->create()) {
            $class->add();
            $this->success('添加成功', U('column'));
        } else {
            $this->error($class->getError());
        }
    }

    public function editcolumn()
    {
        $class = M('class');
        $type = M('type');
        $this->row = $class->find($_GET['id']);

        $rows = $class->order("concat(path,'-',id)")->select();
        foreach ($rows as &$row) {
            $num = substr_count($row['path'], '-');
            if ($row['pid'] > 0) {
                $pre = str_repeat('&emsp;&emsp;', $num) . '|_';
            } else {
                $pre = '';
            }
            $row['tree'] = $pre . $row['name'];
        }
        $this->rows = $rows;

        $this->types = $type->select();
        $this->display();
    }

    public function updatecolumn()
    {
        import("ORG.Net.UploadFile");
        $up=new UploadFile();
        $up->savePath='Public/Uploads/column/';
        $class = D('Class');
        $_POST['name'] = $this->_post('name');
        $_POST['typeid'] = $this->_post('model');
        $_POST['description']=$this->_post('description');
        if ($_POST['father'] != 0) {
            $row = $class->select($_POST['father']);
            $_POST['pid'] = $row[0]['id'];
            $_POST['path'] = $row[0]['path'] . '-' . $row[0]['id'];
        } elseif ($_POST['father'] == 0) {
            $_POST['pid'] = 0;
            $_POST['path'] = 0;
        }
        if ($class->create()) {
            $up->upload();
            $name=$up->getUploadFileInfo()[0]['savename'];
            $class->img=$name;
            if ($class->save()) {
                /**
                 * o用递归函数把刚刚修改的栏目下所有的后代栏目全部修改
                 * @param $id  刚刚修改的栏目的id
                 */
                function son($id)
                {
                    $class = D('Class');
                    $yuan = $class->find($id);
                    $rows = $class->where("pid={$id}")->select();
                    foreach ($rows as $row2) {
                        $modi['id'] = $row2['id'];
                        $modi['typeid'] = $yuan['typeid'];
                        $modi['path'] = $yuan['path'] . '-' . $yuan['id'];
                        $class->save($modi);
                        son($modi['id']);
                    }
                }

                //使用递归函数son(),将刚刚修改的栏目的id传入
                son($_POST['id']);


                $this->success('修改成功', U('column'));
            }
        } else {
            $this->error($class->getError());
        }
    }

    public function deletecolumn()
    {
        $class = M('class');
        if ($_GET['id']) {
            if ($class->delete($_GET['id'])) {

                /**
                 * o用递归函数把刚刚修改的栏目下所有的后代栏目全部删除
                 * @param $id  刚刚删除的栏目的id
                 */
                function son($id)
                {
                    $class = D('Class');
                    $rows = $class->where("pid={$id}")->select();
                    foreach ($rows as $row2) {
                        $class->delete($row2['id']);
                        son($row2['id']);
                    }
                }

                //使用递归函数son(),将刚刚修改的栏目的id传入
                son($_GET['id']);

                $this->success('删除成功', U('column'));
            }
        } elseif ($_GET['all']) {
            $arr = explode(',', $_GET['all']);
            /**
             * 用递归函数把刚刚修改的栏目下所有的后代栏目全部删除
             * @param $id  刚刚删除的栏目的id
             */
            function son($id)
            {
                $class = D('Class');
                $rows = $class->where("pid={$id}")->select();
                foreach ($rows as $row2) {
                    $class->delete($row2['id']);
                    son($row2['id']);
                }
            }

            foreach ($arr as &$val) {
                if ($class->delete($val)) {
                    //使用递归函数son(),将刚刚修改的栏目的id传入
                    son($val);
                }
            }
            echo "删除成功";
        }
    }

    //添加子栏目
    public function addson()
    {
        $class = M('class');
        $type = M('type');
        $row = $class->find($_GET['id']);
        $t = $type->find($row['typeid']);
        $this->row = $row;
        $this->t = $t;
        $this->display();
    }

    //管理内容
    public function substance()
    {
        $class = M('class');
        $rows = $class->order("concat(path,'-',id)")->select();
        foreach ($rows as &$row) {
            $num = substr_count($row['path'], '-');
            if ($row['pid'] > 0) {
                $pre = str_repeat('&emsp;&emsp;', $num) . '|_';
            } else {
                $pre = '';
            }
            $row['tree'] = $pre . $row['name'];
            $rows2 = $class->where("pid={$row['id']}")->select();
            if (!empty($rows2)) {
                $row['haveson'] = 1;
            }
        }
        $this->rows = $rows;
        $this->display();
    }

    //查看栏目下的内容
    public function showcons()
    {
        import("ORG.Util.Page");
        $length = 10;
        $order = isset($_GET['seq']) ? $_GET['seq'] : 0;
        //查询文章模型的内容
        if ($_GET['type'] == 1) {
            $article = M('article');
            $count = $article->where("classid={$_GET['classid']}")->count();
            $page = new Page($count, $length);
            $this->show = $page->show();
            if ($order == 1) {
                $this->rows = $article->where("classid={$_GET['classid']}")->limit($page->firstRow, $length)->order('inputtime')->select();
            } else {
                $this->rows = $article->where("classid={$_GET['classid']}")->limit($page->firstRow, $length)->order('inputtime desc')->select();
            }
        }

        //查询音乐模型的内容
        if ($_GET['type'] == 2) {
            $music = M('music');
            $count = $music->where("classid={$_GET['classid']}")->count();
            $page = new Page($count, $length);
            $this->show = $page->show();
            if ($order == 1) {
                $this->rows = $music->where("classid={$_GET['classid']}")->limit($page->firstRow, $length)->order('inputtime')->select();
            } else {
                $this->rows = $music->where("classid={$_GET['classid']}")->limit($page->firstRow, $length)->order('inputtime desc')->select();
            }
        }

        //查询说说模型的内容
        if ($_GET['type'] == 3) {
            $say = M('say');
            $user=M('user');
            $fab=M('fabulous');
            $count = $say->where("classid={$_GET['classid']}")->count();
            $page = new Page($count, $length);
            $this->show = $page->show();
            if ($order == 1) {
                $rows = $say->where("classid={$_GET['classid']}")->limit($page->firstRow, $length)->order('inputtime')->select();
            }else{
                $rows = $say->where("classid={$_GET['classid']}")->limit($page->firstRow, $length)->order('inputtime desc')->select();
            }
            foreach($rows as &$row){
                $row['user']=$user->find($row['userid'])['username'];
                $row['num']=$fab->where("sayid={$row['id']}")->count();
            }
            $this->rows=$rows;
        }

        //查询视频模型的内容
        if ($_GET['type'] == 4) {
            $video = M('video');
            $count = $video->where("classid={$_GET['classid']}")->count();
            $page = new Page($count, $length);
            $this->show = $page->show();
            if ($order == 1) {
                $this->rows = $video->where("classid={$_GET['classid']}")->limit($page->firstRow, $length)->order('inputtime')->select();
            } else {
                $this->rows = $video->where("classid={$_GET['classid']}")->limit($page->firstRow, $length)->order('inputtime desc')->select();
            }
        }

        $this->order = $order;

        $this->display();
    }

    //添加内容
    public function addcons()
    {
        //查询推荐位
        $posi = M('posi');
        $this->rows = $posi->select();

//        查询专题
        $artispecial=M('artispecial');
        $this->rows2=$artispecial->select();


        $this->display();
    }


    public function insertcons()
    {
        //添加文章
        if ($_POST['type'] == 1) {
            $article = D('Article');
            $_POST['positionid'] = $this->_post('position');
            $_POST['title'] = $this->_post('title');
            $_POST['keywords'] = $this->_post('keywords');
            $_POST['source'] = $this->_post('source');
            $_POST['content'] = $this->_post('content');
            $_POST['classid'] = $this->_post('classid');
            $_POST['specialid']=$this->_post('special');
            if ($article->create()) {
                $article->inputtime = time();
                $article->add();
                $this->success('添加成功', U('substance'));
            } else {
                $this->error($article->getError());
            }
        }

         //添加音乐
        if ($_POST['type'] == 2) {
            import('ORG.Net.UploadFile');
            import("ORG.Net.mp3file");
            $up = new UploadFile();
            $music = D('Music');
            $_POST['positionid'] = $this->_post('position');
            $_POST['title'] = $this->_post('title');
            $_POST['artist'] = $this->_post('source');
            $_POST['description'] = $this->_post('description');
            $_POST['img'] = $this->_post('head');
            $_POST['inputtime'] = time();

            $up->savePath = 'Public/Uploads/music/';

            $up->allowExts=array('mp3');
            if ($music->create()) {
                if ($up->upload()) {
                    $info=$up->getUploadFileInfo();
                    $music->url='http://'.$_SERVER['SERVER_NAME'].__ROOT__.'/'.$info[0]['savepath'].$info[0]['savename'];
                    $m = new mp3file("Public/Uploads/music/".$up->getUploadFileInfo()[0]['savename']);
                    $a = $m->get_metadata();
                    $music->time=$a['Length mm:ss'];

                    $music->add();
                    $this->success('添加成功', U('substance'));
                }else{
                    $music->url=$this->_post('link');
                    if($music->url!=''){
                        $m = new mp3file($music->url);
                        $a = $m->get_metadata();
                        $music->time=$a['Length mm:ss'];
                        $music->add();
                        $this->success('添加成功', U('substance'));
                    }else{
                        $this->error('音源不能为空');
                    }
                }
            } else {
                $this->error($music->getError());
            }
        }

        //添加视频
        if ($_POST['type'] == 4) {
//            import('ORG.Net.UploadFile');
//            $up = new UploadFile();
            $video = D('Video');
            $_POST['positionid'] = $this->_post('position');
            $_POST['title'] = $this->_post('title');
            $_POST['description'] = $this->_post('description');
            $_POST['img'] = $this->_post('head');
            $_POST['inputtime'] = time();

//            $up->savePath = 'Public/Uploads/video/';
//
//            $up->allowExts=array('mp4','avi','flv');
            if ($video->create()) {
//                if ($up->upload()) {
//                    $info=$up->getUploadFileInfo();
//                    $video->url='http://'.$_SERVER['SERVER_NAME'].__ROOT__.'/'.$info[0]['savepath'].$info[0]['savename'];
//                    $video->add();
//                    $this->success('添加成功', U('substance'));
//                }else{
//                    $video->url=$this->_post('link');
//                    if($video->url!=''){
//                        $video->add();
//                        $this->success('添加成功', U('substance'));
//                    }else{
//                        $this->error('视频不能为空');
//                    }
//                }
                $video->url=$this->_post('link');
                $video->add();
                $this->success('添加成功', U('substance'));
            } else {
                $this->error($video->getError());
            }
        }
    }



    //上传图片实时显示
    public function upload(){
        import('ORG.Net.UploadFile');
        $up=new UploadFile();
        if($_POST['type']==2) {
            $up->savePath = "Public/Uploads/music/";
        }
        if($_POST['type']==4) {
            $up->savePath = "Public/Uploads/video/";
        }
        $up->allowExts=array('jpg','png','gif');
        $up->upload();
        $info=$up->getUploadFileInfo();
        $this->path='http://'.$_SERVER['SERVER_NAME'].__ROOT__.'/'.$info[0]['savepath'].$info[0]['savename'];
        $this->display();
    }

    //修改内容
    public function editcons()
    {
        $position = M('posi');
        $this->pos = $position->select();
        if ($_GET['type'] == 1) {
            $article = D('Article');
            $row = $article->find($_GET['id']);
            $posi = explode('-', $row['positionid']);
            $this->row = $row;
            $this->posi = $posi;
            // 查询专题
            $artispecial=M('artispecial');
            $this->rows2=$artispecial->select();
        }

        if ($_GET['type'] == 2) {
            $music = D('Music');
            $row = $music->find($_GET['id']);
            $posi = explode('-', $row['positionid']);
            $this->row = $row;
            $this->posi = $posi;
        }

        if ($_GET['type'] == 3) {
            $say = D('Say');
            $user=M('user');
            $row = $say->find($_GET['id']);
            $posi = explode('-', $row['positionid']);
            $this->user=$user->where("id={$row['userid']}")->find()['username'];
            $this->row = $row;
            $this->posi = $posi;
        }

        //修改视频表单
        if ($_GET['type'] == 4) {
            $video = D('Video');
            $row = $video->find($_GET['id']);
            $posi = explode('-', $row['positionid']);
            $this->row = $row;
            $this->posi = $posi;
        }

        $this->display();
    }
    public function test(){
        $this->display();
    }

    public function uploadimg(){
        import('ORG.Net.UploadFile');
        $up = new UploadFile();
        $up->savePath = 'Public/Uploads/';
         if($up->upload()){
             $rows=$up->getUploadFileInfo();
             foreach($rows as &$row){
                 $row['url']='http://'.$_SERVER['SERVER_NAME'].__ROOT__.'/'.$row['savepath'].$row['savename'];
             }
             $this->rows=$rows;
             $this->display();
         }else{
             echo $up->getErrorMsg();
         }
    }

    public function insert1(){
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
    }

    public function updatecons()
    {
        //修改文章
        if ($_POST['type'] == 1) {
            $article = D('Article');
            $_POST['positionid'] = $this->_post('position');
            $_POST['title'] = $this->_post('title');
            $_POST['keywords'] = $this->_post('keywords');
            $_POST['source'] = $this->_post('source');
            $_POST['content'] = $this->_post('content');
            $_POST['specialid']=$this->_post('special');
            if ($article->create()) {
                $article->save();
                $this->success('修改成功',U('substance'));
            }else{
                $this->error($article->getError());
            }
        }

        //修改音乐
        if ($_POST['type'] == 2) {
            import('ORG.Net.UploadFile');
            $up = new UploadFile();
            $music = D('Music');
            $_POST['positionid'] = $this->_post('position');
            $_POST['title'] = $this->_post('title');
            $_POST['artist'] = $this->_post('source');
            $_POST['description'] = $this->_post('description');
            $_POST['inputtime'] = time();
            $_POST['img'] = $this->_post('head');
            $up->savePath = 'Public/Uploads/music/';
            $up->allowExts=array('mp3');
            if ($music->create()) {
                if ($up->upload()) {
                    $info=$up->getUploadFileInfo();
                    $music->url='http://'.$_SERVER['SERVER_NAME'].__ROOT__.'/'.$info[0]['savepath'].$info[0]['savename'];
                    $m = new mp3file("Public/Uploads/music/".$up->getUploadFileInfo()[0]['savename']);
                    $a = $m->get_metadata();
                    $music->time=$a['Length mm:ss'];
                    $music->save();
                    $this->success('修改成功',U('substance'));
                } else {
                    if($_POST['link']!=''){
                        $music->url=$this->_post('link');
                        $music->save();
                        $this->success('修改成功',U('substance'));
                    }else{
                        $music->save();
                        $this->success('修改成功',U('substance'));
                    }
                }
            } else {
                $this->error($music->getError());
            }
        }

        //修改说说
        if ($_POST['type'] == 3) {
            $say = D('Say');
            $_POST['positionid'] = $this->_post('position');
            $_POST['title'] = $this->_post('title');
            $_POST['content'] = $this->_post('content');
            $_POST['inputtime'] = time();
            if ($say->create()) {
                $say->save();
                $this->success('修改成功',U('substance'));
            } else {
                $this->error($say->getError());
            }
        }

        //修改视频
        if ($_POST['type'] == 4) {
            import('ORG.Net.UploadFile');
            $up = new UploadFile();
            $video = D('Video');
            $_POST['positionid'] = $this->_post('position');
            $_POST['title'] = $this->_post('title');
            $_POST['description'] = $this->_post('description');
            $_POST['inputtime'] = time();
            $_POST['img'] = $this->_post('head');
            $up->savePath = 'Public/Uploads/music/';
            $up->allowExts=array('mp4','avi','flv');
            if ($video->create()) {
                if ($up->upload()) {
                    $info=$up->getUploadFileInfo();
                    $video->url='http://'.$_SERVER['SERVER_NAME'].__ROOT__.'/'.$info[0]['savepath'].$info[0]['savename'];
                    $video->save();
                    $this->success('修改成功',U('substance'));
                } else {
                    if($_POST['link']!=''){
                        $video->url=$this->_post('link');
                        $video->save();
                        $this->success('修改成功',U('substance'));
                    }else{
                        $video->save();
                        $this->success('修改成功',U('substance'));
                    }
                }
            } else {
                $this->error($music->getError());
            }
        }
    }

    //删除内容
    public function deletecons()
    {
        //删除文章
        if ($_GET['type'] == 1) {
            $article = D('Article');

            if ($_GET['id']) {
                if ($article->delete($_GET['id'])) {
                    $this->success('删除成功');
                }
            } elseif ($_GET['all']) {
                if ($article->delete($_GET['all'])) {
                    echo '删除成功';
                }
            }
        }

        //删除音乐
        if ($_GET['type'] == 2) {
            $music = D('Music');
            if ($_GET['id']) {
                $row=$music->find($_GET['id']);
                if ($music->delete($_GET['id'])) {
                    $arr=explode('/',$row['img']);
                    $imgname=$arr[count($arr)-1];
                    unlink('Public/Uploads/music/'.$imgname);
                    $arr2=explode('/',$row['url']);
                    $musicname=$arr2[count($arr2)-1];
                    unlink('Public/Uploads/music/'.$musicname);
                    $this->success('删除成功');
                }
            } elseif ($_GET['all']) {
                $rows=$music->select($_GET['all']);
                if ($music->delete($_GET['all'])) {
                    foreach($rows as $row){
                        $arr=explode('/',$row['img']);
                        $imgname=$arr[count($arr)-1];
                        unlink('Public/Uploads/music/'.$imgname);
                        $arr2=explode('/',$row['url']);
                        $musicname=$arr2[count($arr2)-1];
                        unlink('Public/Uploads/music/'.$musicname);
                    }
                    echo '删除成功';
                }
            }
        }

        //删除说说
        if ($_GET['type'] == 3) {
            $say = D('Say');
            if ($_GET['id']) {
                if ($say->delete($_GET['id'])) {
                    $this->success('删除成功');
                }
            } elseif ($_GET['all']) {
                if ($say->delete($_GET['all'])) {
                    echo '删除成功';
                }
            }
        }

        //删除视频
        if ($_GET['type'] == 4) {
            $video = D('Video');
            if ($_GET['id']) {
                $row=$video->find($_GET['id']);
                if ($video->delete($_GET['id'])) {
                    $arr=explode('/',$row['img']);
                    $imgname=$arr[count($arr)-1];
                    unlink('Public/Uploads/video/'.$imgname);
                    $arr2=explode('/',$row['url']);
                    $videoname=$arr2[count($arr2)-1];
                    unlink('Public/Uploads/video/'.$videoname);

                    $this->success('删除成功');
                }
            } elseif ($_GET['all']) {
                $rows=$video->select($_GET['id']);
                if ($video->delete($_GET['all'])) {
                    foreach($rows as $row){
                        $arr=explode('/',$row['img']);
                        $imgname=$arr[count($arr)-1];
                        unlink('Public/Uploads/video/'.$imgname);
                        $arr2=explode('/',$row['url']);
                        $videoname=$arr2[count($arr2)-1];
                        unlink('Public/Uploads/video/'.$videoname);
                    }
                    echo '删除成功';
                }
            }
        }
    }
    //推荐位管理
    public function recommend(){
        import("ORG.Util.Page");
        $position=M('posi');
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
        $position=M('posi');
        $_POST['name']=$this->_post('name');
        if($_POST['name']!=''){
            if($position->add($_POST)) {
                $this->success('添加成功', U('recommend'));
            }
        }else{
            $this->error('名称不能为空');
        }
    }

    //修改推荐位
    public function editrecommend(){
        $position=M('posi');
        $this->row=$position->find($_GET['id']);
        $this->display();
    }

    public function updaterecommend(){
        $position=M('posi');
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
        $position=M('posi');
        if($_GET['id']){
           $position->delete($_GET['id']);
           $this->success('删除成功',U('recommend'));
        }elseif($_GET['all']){
            $position->delete($_GET['all']);
            echo '删除成功';
        }
    }

//    文章专题
    public function artispecial(){
         $artispecial=M('artispecial');
         $this->rows=$artispecial->select();
         $this->display();
    }

//    添加专题
    public function addspecial(){
        $this->display();
    }

    public function insertspecial(){
        import('ORG.Net.UploadFile');
        $artispecial=M('artispecial');
        $up=new UploadFile();
        $up->savePath="Public/Uploads/special/";
        if($up->upload()){
            $info=$up->getUploadFileInfo();
            $file=$info[0]['savepath'].$info[0]['savename'];
            $tfile=thumb($file,170,80);
            $path=__ROOT__.'/'.$tfile;
            $_POST['img']=$path;
            $artispecial->add($_POST);
            $this->success('添加成功',U('artispecial'));
        }else{
            $this->error($up->getErrorMsg());
        }
    }

//    修改专题
    public function editspecial(){
        $artispecial=M('artispecial');
        $this->row=$artispecial->find($_GET['id']);
        $this->display();
    }

    public function updatespecial(){
        import('ORG.Net.UploadFile');
        $artispecial=M('artispecial');
        $up=new UploadFile();
        $up->savePath="Public/Uploads/special/";
        if($up->upload()){
            $info=$up->getUploadFileInfo();
            $file=$info[0]['savepath'].$info[0]['savename'];
            $tfile=thumb($file,170,80);
            $path=__ROOT__.'/'.$tfile;
            $_POST['img']=$path;
            $artispecial->save($_POST);
            $this->success('修改成功',U('artispecial'));
        }else{
            $artispecial->save($_POST);
            $this->success('修改成功',U('artispecial'));
        }
    }

    public function delspecial(){
        $artispecial=M('artispecial');
        $artispecial->delete($_GET['id']);
        $this->success('删除成功',U('artispecial'));
    }


}