
<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22
 * Time: 14:04
 */
class ContentAction extends Action
{
    public function article()
    {
        $class = M('class');
//        查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();

//        查询当前文章栏目下的子栏目
        $this->sons = $class->where("pid={$_GET['id']}")->select();

        $article = M('article');
        $arts = $article->order('inputtime desc')->select();
//        查询推荐位是焦点图的文章
        $slides = array();
        foreach ($arts as &$row) {
            $posarr = explode('-', $row['positionid']);
            if (in_array(6, $posarr)) {
                $row['content'] = htmlspecialchars_decode($row['content']);
                preg_match("/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i", $row['content'], $arr);
                $row['img'] = $arr[0];
                $slides[] = $row;
            }
        }
        $this->slides = $slides;


        import('ORG.Util.Page');
//    查询推荐位是文章栏目首页推荐的文章
        if (!isset($_GET['category']) || $_GET['category'] == 'recommend') {
            $recommends = array();
            foreach ($arts as &$row2) {
                $posarr = explode('-', $row2['positionid']);
                if (in_array(4, $posarr)) {
                    $row2['content'] = htmlspecialchars_decode($row2['content']);
                    preg_match_all("/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i", $row2['content'], $arr);
                    $row2['img'] = $arr[0];
                    $row2['cate'] = $class->find($row2['classid'])['name'];
                    $recommends[] = $row2;
                }
            }
            $count = count($recommends);
            $length = 10;
            $page = new Page($count, $length);
            $page->setConfig('theme', "%nowPage%/%totalPage% 页 %first% %prePage% %linkPage%  %end%"
            );
            $this->show = $page->show();
            $this->arts = array_slice($recommends, $page->firstRow, $length);
        } elseif ($_GET['category'] == 'hot') {
            //        查询推荐位是文章栏目热点推荐的文章
            $hots = array();
            foreach ($arts as &$row) {
                $posarr = explode('-', $row['positionid']);
                if (in_array(5, $posarr)) {
                    $row['content'] = htmlspecialchars_decode($row['content']);
                    preg_match_all("/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i", $row['content'], $arr);
                    $row['img'] = $arr[0];
                    $row['cate'] = $class->find($row['classid'])['name'];
                    $hots[] = $row;
                }
            }
            $count = count($hots);
            $length = 10;
            $page = new Page($count, $length);
            $page->setConfig('theme', "%nowPage%/%totalPage% 页 %first% %prePage% %linkPage%  %end%"
            );
            $this->show = $page->show();
            $this->arts = array_slice($hots, $page->firstRow, $length);
        } else {
//            查询每个子栏目下的文章
            $soncolumnarts = $article->order('inputtime desc')->where("classid={$_GET['category']}")->select();
            foreach ($soncolumnarts as &$row) {
                $row['content'] = htmlspecialchars_decode($row['content']);
                preg_match_all("/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i", $row['content'], $arr);
                $row['cate'] = $class->find($row['classid'])['name'];
                $row['img'] = $arr[0];
            }
            $count = count($soncolumnarts);
            $length = 10;
            $page = new Page($count, $length);
            $page->setConfig('theme', "%nowPage%/%totalPage% 页 %prePage% %linkPage% %nextPage% "
            );
            $this->show = $page->show();
            $this->arts = array_slice($soncolumnarts, $page->firstRow, $length);
        }

//        查询热门文章
        $remens = $article->order('weekviews desc')->limit(0, 5)->select();
        $this->count = $article->count();
        foreach ($remens as &$row) {
            $row['content'] = htmlspecialchars_decode($row['content']);
            preg_match("/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i", $row['content'], $arr);
            $row['cate'] = $class->find($row['classid'])['name'];
            $row['img'] = $arr[0];
        }
        $this->remens = $remens;

//        查询专题
        $artispecial=M('artispecial');
        $this->spes=$artispecial->select();

//       热门搜索
        $search=M('search');
        $seaarr=$search->select();
        $arr2=array();
        foreach($seaarr as &$row4){
            $arr1=json_decode($row4['searecord'],true);
            foreach($arr1 as &$row5){
//                要对哪个类型的内容的搜索记录进行排序
                if($row5['type']==1){
                    $arr2[]=$row5;
                }
            }
        }
        $res= array();
        foreach($arr2 as $value){
            if(!isset($res[$value['id']])){
                $res[$value['id']] = $value;
                $res[$value['id']]['num']=1;
            }else{
                $res[$value['id']]['num']++;
            }
        }
       $nums=array();
       foreach($res as $row){
           $nums[]=$row['num'];
       }
       array_multisort($nums,SORT_DESC,$res);
       $this->res=array_slice($res,0,10);

       $this->display();
    }

//    换一批热门新闻
    public function morenews()
    {
        $article = M('article');
        $class = M('class');
        $remens = $article->order("weekviews desc")->limit($_GET['index'], 5)->select();
        foreach ($remens as &$row) {
            $row['content'] = htmlspecialchars_decode($row['content']);
            preg_match("/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i", $row['content'], $arr);
            $row['cate'] = $class->find($row['classid'])['name'];
            $row['img'] = $arr[0];
        }
        $this->remens = $remens;
        $this->display();
    }

//    文章内容页
    public function artcon()
    {
        $this->URL=__ROOT__;
        $class = M('class');
//        查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();

//      查询该文章
        $article = M('article');
        $art = $article->find($_GET['id']);

//        更新浏览量
        Statistics($article, $art['lastred'], $art['dayviews'], $art['weekviews'], $art['views'], get_client_ip());

//        查询当前文章所属栏目
        $cate = $class->find($art['classid']);
        $arr = explode('-', $cate['path']);
        array_shift($arr);
        $nav = array();
        foreach ($arr as $row) {
            $nav[] = $class->find($row);
        }
        $this->cate = $cate;
        $this->nav = $nav;
        $this->art = $art;

//        根据当前文章的关键词查询相关文章
        $keyarr = explode(' ', $art['keywords']);
        $arts = $article->order('rand()')->select();
        $recommends = array();
        foreach ($arts as &$row) {
            $row['content'] = htmlspecialchars_decode($row['content']);
            preg_match("/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i", $row['content'], $arr);
            $row['img'] = $arr[0];
            $row['cate'] = $class->find($row['classid'])['name'];
//         将每篇文章的关键词都分割成数组
            $arr2 = explode(' ', $row['keywords']);
            $inter = array_intersect($keyarr, $arr2);
            if (!empty($inter)) {
                $recommends[] = $row;
            }
        }
        $this->recommends = array_slice($recommends, 0, 10);

        $this->display();
    }

//    音乐首页
    public function music()
    {
        $class = M('class');
//        查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();


//    查询所有频道
        $this->channels = $class->where("pid={$_GET['id']}")->select();

//    头部音乐推荐
        $music = M('music');
        $all = $music->select();
        $toprecommend = array();
        foreach ($all as &$row) {
            $arr = explode('-', $row['positionid']);
            if (in_array(7, $arr)) {
                $toprecommend[] = $row;
            }
        }
        $this->toprecommend = $toprecommend;

//        热门音乐
        $hots = $music->order('weekviews desc')->limit('0,3')->select();
        foreach ($hots as &$row) {
            $channel = $class->find($row['classid']);
            $row['channel'] = $channel;
        }
        $this->hots = $hots;
//        今日推荐
        $todayrecomm = array();
        foreach ($all as &$row) {
            $arr = explode('-', $row['positionid']);
            if (in_array(8, $arr)) {
                $todayrecomm[] = $row;
            }
        }
        $this->todayrecomm = array_slice($todayrecomm, 0, 16);


//        每日精选
        $everyday = array();
        foreach ($all as &$row) {
            $channel = $class->find($row['classid']);
            $row['channel'] = $channel;
            $arr = explode('-', $row['positionid']);
            if (in_array(9, $arr)) {
                $everyday[] = $row;
            }
        }
        $this->everyday = $everyday;

        $this->display();
    }

    public function musicchannel()
    {
        import('ORG.Util.Page');
        $class = M('class');
//        查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();


//    查询所有频道
        $this->channels = $class->where("pid={$_GET['id']}")->select();

//       查询当前频道的子频道
        $count = $class->where("pid={$_GET['channel']}")->count();
        $length = 4;
        $page = new Page($count, $length);
        $page->setConfig('theme', "%nowPage%/%totalPage% 页 %first% %prePage% %linkPage%  %end%"
        );
        $this->show = $page->show();
        $sons = $class->where("pid={$_GET['channel']}")->limit($page->firstRow, $length)->select();
        $music = M('music');
        foreach ($sons as &$row) {
            $rows = $music->where("classid={$row['id']}")->select();
            $row['mus'] = $rows;
        }
        $this->sons = $sons;

        $this->display();
    }

//    音乐内容页
    public function musicon()
    {
        $class = M('class');
//        查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();

        $music = M('music');
        $yin = $music->find($_GET['id']);
        $this->yin = $yin;

//        更新浏览量
        Statistics($music, $yin['lastred'], $yin['dayviews'], $yin['weekviews'], $yin['views'], get_client_ip());

//        播放历史
        $this->list = $_SESSION['music'];
        $same = 0;
        foreach ($_SESSION['music'] as &$row) {
            if ($row['title'] == $yin['title']) {
                $same++;
            }
        }
        if ($same == 0) {
            $_SESSION['music'][] = $yin;
        }

//        查询当前用户有没点赞过此内容
        $fabulous=M('fabulous');

//        $condition['userid']就是当前登录用户的id
        $condition['userid']=$_SESSION['userid'];
        $this->userid=$condition['userid'];

//        $_GET['id']就是当前内容（比如文章）的id
        $condition['tid']=$_GET['id'];
        $this->tid=$condition['tid'];

//      $condition['typeid']就是当前内容所属模型的id
        $condition['typeid']=2;
        $this->typeid=$condition['typeid'];

        $this->isfab=$fabulous->where($condition)->count();

        //        查询当前内容的点赞数
        $numarr['tid']=$_GET['id'];
        $numarr['typeid']=2;
        $this->fabnum=$fabulous->where( $numarr)->count();

//         查询当前用户有没收藏过此篇文章
        $coll=M('coll');
        $this->iscoll=$coll->where($condition)->count();

        //       查询当前内容的收藏数
        $this->collnum=$coll->where( $numarr)->count();

        $this->display();

    }

//    频道列表页
    public function channelist()
    {
        import('ORG.Util.Page');
        $class = M('class');
//        查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();

//      查询当前频道
        $this->channel = $class->find($_GET['id']);

        $music = M('music');
        $order = $_GET['order'] ? $_GET['order'] : 'hot';
        $this->order = $order;
//        查询当前频道下的音乐

        $count = $music->where("classid={$_GET['id']}")->count();
        $length = 15;
        $page = new Page($count, $length);
        $page->setConfig('theme', "%nowPage%/%totalPage% 页 %first% %prePage% %linkPage%  %end%"
        );
        $this->show = $page->show();
        if ($order == 'hot') {
            $this->mus = $music->where("classid={$_GET['id']}")->limit($page->firstRow, $length)->order('weekviews desc')->select();
        } elseif ($order == 'new') {
            $this->mus = $music->where("classid={$_GET['id']}")->limit($page->firstRow, $length)->order('inputtime desc')->select();
        }

        $this->display();
    }



//  视频栏目首页
    public function video()
    {
        $class = M('class');
//    查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();
//        将当前的操作名分配到模板
        $this->action = ACTION_NAME;

        $video = M('video');
        $videos = $video->order('inputtime desc')->select();

//      头部推荐视频
        $toprecommends = array();
        foreach ($videos as &$row) {
            $row['cate'] = $class->find($row['classid']);
//            查询其栏目的上一级栏目
            $row['two']=$class->where("id={$row['cate']['pid']}")->find();
            $arr = explode('-', $row['positionid']);
            if (in_array(10, $arr)) {
                $toprecommends[] = $row;
            }
        }
        $this->toprecommends = array_slice($toprecommends, 0, 5);

//       为你推荐
        $fors = array();
        foreach ($videos as &$row) {
            $row['cate'] = $class->find($row['classid']);
//            查询其栏目的上一级栏目
            $row['two']=$class->where("id={$row['cate']['pid']}")->find();
            $arr = explode('-', $row['positionid']);
            if (in_array(11, $arr)) {
                $fors[] = $row;
            }
        }
        $this->fors = array_slice($fors, 0, 4);


//        查询视频下的所有子栏目
        $sons = $class->where("pid={$_GET['id']}")->select();
//        查询每个子栏目下的热门视频

        foreach ($sons as &$row) {
            $views = array();
            $clas = $class->where("pid={$row['id']}")->select();
            foreach ($clas as &$row2) {
                $vs = $video->where("classid={$row2['id']}")->select();
                foreach ($vs as &$row3) {
                    $row3['cate'] = $row2;
 //            查询其栏目的上一级栏目
                    $row3['two']=$class->where("id={$row3['cate']['pid']}")->find();
                    $row['videos'][] = $row3;
                    $views[] = $row3['views'];
                }
            }
            array_multisort($views, SORT_DESC, $row['videos']);
            $row['videos'] = array_slice($row['videos'], 0, 5);

        }

        $this->sons = $sons;
        $this->display();
    }

//    视频内容页
    public function videcon()
    {
        $class = M('class');
//    查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();
//        将当前的操作名分配到模板
        $this->action = ACTION_NAME;
//        查询视频栏目下的所有子栏目
        $this->sons = $class->where("pid={$_GET['id']}")->select();

        $video = M('video');
//        查询当前视频
        $this->video = $video->find($_GET['vid']);
//        查询视频的栏目
        $this->colu = $class->find($this->video['classid']);

//        查询相关视频
        $about =$video->where("classid={$this->colu['id']}")->select();
        foreach($about as &$row){
            $row['cate']=$class->find($row['classid']);
        }
        $this->about=$about;

//        查询当前用户有没点赞过此篇文章
        $fabulous=M('fabulous');

//        $condition['userid']就是当前登录用户的id
        $condition['userid']=$_SESSION['userid'];
        $this->userid=$condition['userid'];

//        $_GET['id']就是当前内容（比如文章）的id
        $condition['tid']=$_GET['vid'];
        $this->tid=$condition['tid'];

//      $condition['typeid']就是当前内容所属模型的id
        $condition['typeid']=4;
        $this->typeid=$condition['typeid'];

        $this->isfab=$fabulous->where($condition)->count();

//        查询当前视频的点赞数
        $numarr['tid']=$_GET['vid'];
        $numarr['typeid']=4;
        $this->fabnum=$fabulous->where( $numarr)->count();

//         查询当前用户有没收藏过此篇文章
        $coll=M('coll');
        $this->iscoll=$coll->where($condition)->count();

//       查询当前视频的收藏数
        $numarr['tid']=$_GET['vid'];
        $numarr['typeid']=4;
        $this->collnum=$coll->where( $numarr)->count();

        $this->display();
    }

//  视频子栏目页
    public function videocolumn()
    {
        import('ORG.Util.Page');
        $class = M('class');
//    查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();
//        将当前的操作名分配到模板
        $this->action = ACTION_NAME;
//        查询视频栏目下的所有子栏目
        $this->sons = $class->where("pid={$_GET['id']}")->select();

//       查询当前栏目的信息
        $this->column = $class->find($_GET['column']);

//        查询三级栏目
        $this->bots=$class->where("pid={$this->column['id']}")->select();
        $video=M('video');
//       查询当前二级栏目下所有视频
        if($_GET['type']=='all' || $_GET['type']==''){
            $videos=array();
            foreach($this->bots as $row){
                $rows=$video->where("classid={$row['id']}")->order('inputtime desc')->select();
                foreach($rows as &$row2){
                    $row2['cate']=$row;
                    $videos[]=$row2;
                }
            }
            $count=count($videos);
            $length=28;
            $page=new Page($count,$length);
            $page->setConfig('theme', "%nowPage%/%totalPage% 页 %first% %prePage% %linkPage%  %end%"
            );
            $this->show=$page->show();
            $this->videos=array_slice($videos,$page->firstRow,$length);
        }else{
//            查询当前三级栏目下的视频
            $videos=array();
            $rows=$video->where("classid={$_GET['type']}")->order('inputtime desc')->select();
            foreach($rows as &$row2){
                $row2['cate']=$class->find($_GET['type']);
                $videos[]=$row2;
            }
            $count=count($videos);
            $length=28;
            $page=new Page($count,$length);
            $page->setConfig('theme', "%nowPage%/%totalPage% 页 %first% %prePage% %linkPage%  %end%"
            );
            $this->show=$page->show();
            $this->videos=array_slice($videos,$page->firstRow,$length);
        }
        $this->display();
    }

//    动态栏目首页
    public function say()
    {
        $class = M('class');
//    查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();
//        将当前的操作名分配到模板
        $this->action = ACTION_NAME;


//       查询最新动态
        $say=M('say');
        $follow=M('follow');
        $user=M('user');
        $says=$say->order('inputtime desc')->select();
        foreach($says as &$row){
            $row['user']=$user->find($row['userid']);
            $row['forward']=$say->find($row['forward']);
            if($row['forward']['userid']!=0) {
                $row['forward']['user'] = $user->find($row['forward']['userid']);
            }
        }
        $this->says=array_slice($says,0,20);

//      查询推荐关注用户
        $recomms=$user->select();
        $num=array();
        foreach($recomms as &$row6){
            $num[]=$follow->where("tid={$row6['id']}")->count();
        }
        array_multisort($num,SORT_DESC,$recomms);
        $this->recomms=array_slice($recomms,0,4);


//    查询当前登录用户发表的动态数
        $this->saynum=$say->where("userid={$_SESSION['userid']}")->count();
//        查询当前登录用户的关注数
        $this->folnum=$follow->where("userid={$_SESSION['userid']}")->count();
//        查询当前登录用户的被关注数
        $this->myfolnum=$follow->where("tid={$_SESSION['userid']}")->count();

//      查询热门话题
        $comment=M('comment');
        $rows=$say->select();
        $hotweets=array();
        $comnum=array();
        foreach($rows as &$row7){
            $arr=explode("#",$row7['content']);
//            如果内容里有两个#,那么分割出来的数组长度至少是3个,取数组里的第二个（也就是下标为1），就是取第一个#之间的作为话题，后面的#之间就不算了,z这个是参照微博的
            if(count($arr)>=3 && $arr[1]!=''){
                $row7['content']=$arr[1];
                $hotweets[]=$row7;
            }
        }

        foreach($hotweets as &$row8){
            $condi['typeid']=3;
            $condi['tid']=$row8['id'];
            $condi['pid']=0;
            $comm_num=$comment->where($condi)->count();
            $comnum[]=  $comm_num;
        }

        array_multisort($comnum,SORT_DESC,$hotweets);

        $hotweets=array_unset($hotweets,'content');

        $this->hotweets=array_slice($hotweets,0,10);

//      查询当前登录用户的私信
        $chat=M('chat');
        $chats=$chat->where("fromuserid={$_SESSION['userid']}")->select();

        foreach($chats as &$row9){
             $row9['user']=$user->find($row9['touserid']);
        }

        $this->chats=$chats;

        $this->display();

    }


//    删除上传资源
   public function delesour(){
        unlink($_POST['URL']);

   }

//   添加动态
    public function sayinsert(){
        if(!session('login') || !session('userid')){
            echo "no";
            exit;
        }

        $say=M('say');
        $_POST['content']=htmlspecialchars_decode( $_POST['content']);
        $_POST['content']=strip_tags($_POST['content'],'<img>');
        $arr=explode("#", $_POST['content']);
        if(count($arr)>=3 && $arr[1]!=''){
            foreach($arr as $key=>&$row2){
                if($key==0){
                    $row2=$row2.'<a href="vfgds">';
                }
                if($key==2){
                    $row2='</a>'.$row2;
                }
            }
        }

        $_POST['content']=join('#',$arr);

        if(!isset($_POST['source'])){
            $_POST['source']='';
        }else{
            $_POST['source']=$this->_post('source');
        }

        if(!isset($_POST['forward'])){
            $_POST['forward']='';
        }else{
            $_POST['forward']=$this->_post('forward');
        }

        $_POST['userid']=$_SESSION['userid'];

        $_POST['inputtime']=time();

        if($say->add($_POST)){
            $user=M('user');
            $row=$say->where($_POST)->find();
            $row['forward']=$say->find($row['forward']);
            if($row['forward']['userid']!=0) {
                $row['forward']['user'] = $user->find($row['forward']['userid']);
            }
            $this->row=$row;
            $this->display();
        }


    }

//    加载更多动态
    public function getmoresay(){
        $say=M('say');
        $user=M('user');
        $rows=$say->order('inputtime desc')->select();
        $rows=array_slice($rows,$_POST['index']+1,20);
        foreach($rows as &$row){
            $row['user']=$user->find($row['userid']);
        }
        $this->says=$rows;
        $this->display();
    }

//    获取当前动态对应的回复框内容
    public function replaybox(){
        $say=M('say');
        $user=M('user');
        $row=$say->find($_GET['id']);
        $row['user']=$user->find($row['userid']);
        $row['forward']=$say->find($row['forward']);
        if($row['forward']['userid']!=0){
            $row['forward']['user'] = $user->find($row['forward']['userid']);
        }

        $this->row=$row;
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

//// 获取聊天窗口
//    public function getchatwindow(){
//        $user=M('user');
//        $this->row=$user->find($_POST['to']);
//
//        $this->display();
//    }
//
//
//    public function addorsavechat(){
//        $user=M('user');
//        $chat=M('chat');
//        if(isset($_POST['user'])){
//            $count=$user->where("username={$_POST['user']}")->count();
//            if(!$count){
//                echo 'nouser';
//                exit;
//            }else{
//                $row=$user->where("username={$_POST['user']}")->find();
//                $_POST['fromuserid']=$_SESSION['userid'];
//                $_POST['touserid']=$row['id'];
//                $row2=$chat->where($_POST)->find();
//                if($row2){
//                    echo $row['id'];
//                }else{
//                    $chat->add($_POST);
//                    $relative['fromuserid']=$row['id'];
//                    $relative['touserid']=$_SESSION['userid'];
//                    $chat->add($relative);
//                    echo $row['id'];
//                }
//            }
//        }else{
//            $_POST['fromuserid']=$_SESSION['userid'];
//            $_POST['touserid']=$_POST['to'];
//            $_POST['cont']=htmlspecialchars_decode($_POST['cont']);
//            $_POST['cont']=strip_tags($_POST['cont'],'<img>');
//            $content=htmlspecialchars($_POST['cont']);
//            $row=$chat->where($_POST)->find();
//            $arr=json_decode($row['content'],true);
//            $arr[]=array('id'=>"{$_POST['fromuserid']}",'content'=>"{$content}",'time'=>time());
//            $_POST['content']=json_encode($arr);
//            $_POST['id']=$row['id'];
//            $chat->save($_POST);
//            $relative['fromuserid']=$_POST['to'];
//            $relative['touserid']=$_SESSION['userid'];
//            $relarow=$chat->where($relative)->find();
//            $relative['content']=json_encode($arr);
//            $relative['id']=$relarow['id'];
//            $chat->save($relative);
//        }
//
//    }
//
////    获取聊天内容
//    public function getchat(){
//        $chat=M('chat');
//        $user=M('user');
//        $_POST['fromuserid']=$_SESSION['userid'];
//        $_POST['touserid']=$_POST['to'];
//        $row=$chat->where($_POST)->find();
//
//        $arrs=json_decode($row['content'],true);
//
//        $times=array();
//
//        foreach($arrs as &$row2){
//            $row2['user']=$user->find($row2['id']);
//            $times[]=$row2['time'];
//        }
//        array_multisort($times,SORT_ASC,$arrs);
//        $this->arrs=$arrs;
//
//
//        $this->display();
//    }
//
////    获取私信列表
//    public function getchatlist(){
//        //      查询当前登录用户的私信
//        $chat=M('chat');
//        $user=M('user');
//        $chats=$chat->where("fromuserid={$_SESSION['userid']}")->select();
//
//        foreach($chats as &$row9){
//            $row9['user']=$user->find($row9['touserid']);
//        }
//
//        $this->chats=$chats;
//
//        $this->display();
//    }
//
////    获取新私信窗口
//    public function chooseuserwindow(){
//        $this->display();
//    }
//
////   获取用户
//    public function getuser(){
//        $user=M('user');
//        $this->rows=$user->where("username like '%{$_POST[user]}%'")->select();
//
//        $this->display();
//    }

    public function specialinfo(){
        import("ORG.Util.Page");
        $class = M('class');
//        查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();

        $artispecial=M('artispecial');
        //查询当前专题
        $row=$artispecial->find($_GET['id']);
        $this->spec=$row;

        $article=M('article');
        $count=$article->where("specialid={$_GET['id']}")->count();
        $length=10;
        $page=new Page($count,$length);
        $page->setConfig('header','篇文章');
        $this->show=$page->show();
//        查询当前专题下的文章
        $rows=$article->limit($page->firstRow,$length)->where("specialid={$_GET['id']}")->select();
        foreach($rows as &$row2){
            $row2['content'] = htmlspecialchars_decode($row2['content']);
            preg_match("/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i", $row2['content'], $arr);
            $row2['img']=$arr[0];
            $row2['content'] =strip_tags($row2['content']);
        }
        $this->artis=$rows;

//        查询更多专题
        $rows2=$artispecial->limit("0,5")->select();
        $this->mores=$rows2;

        $this->display();
    }

    public function specialist(){
        $class = M('class');
//        查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();

        $artispecial=M('artispecial');
        $this->rows=$artispecial->select();
        $this->display();
    }


}
