<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/13
 * Time: 19:32
 */
class SearchAction extends Action{
    public function index(){
        import('ORG.Util.Page');
        $class = M('class');
//        查询头部顶级栏目
        $this->columns = $class->where('pid=0')->select();
        $search=M('search');
        if($_GET['type']=='all'){
            $total=array();
            $article=M('article');
            $arts=$article->where("title like '%{$_GET['key']}%'")->select();
            foreach($arts as &$row){
                $row['content']=htmlspecialchars_decode($row['content']);
                preg_match("/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i",$row['content'],$arr);
                $row['img']=$arr[0];
                $row['content']=strip_tags($row['content']);
                $row['type']=1;
                $total[]=$row;
            }

            $music=M('music');
            $mus=$music->where("title like '%{$_GET['key']}%'")->select();
            foreach($mus as &$row2){
                $row2['type']=2;
                $row2['description']=htmlspecialchars_decode($row2['description']);
                $row2['description']=strip_tags($row2['description']);
                $total[]=$row2;
            }
            $say=M('say');
            $says=$say->where("content like '%{$_GET['key']}%'")->select();
            foreach($says as &$row3){
                $row3['type']=3;
                $total[]=$row3;
            }
            $video=M('video');
            $vids=$video->where("title like '%{$_GET['key']}%'")->select();
            foreach($vids as &$row4){
                $row4['type']=4;
                $total[]=$row4;
            }
//            添加搜索记录
            if(!empty($total)) {
                $totstr = json_encode($total);
                $record['searecord'] = $totstr;
                $search->add($record);
            }

            $count=count($total);
            $length=10;
            $page=new Page($count,$length);
            $page->setConfig('theme', "%first% %prePage% %linkPage%  %end%");
            $this->show=$page->show();
            $total=array_slice($total,$page->firstRow,$length);
            $this->rows=$total;
        }elseif($_GET['type']==1){
            $article=M('article');
            $arts=$article->where("title like '%{$_GET['key']}%'")->select();
            foreach($arts as &$row){
                $row['content']=htmlspecialchars_decode($row['content']);
                preg_match("/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i",$row['content'],$arr);
                $row['img']=$arr[0];
                $row['content']=strip_tags($row['content']);
                $row['type']=1;
            }
            //            添加搜索记录
            if(!empty($arts)) {
                $totstr = json_encode($arts);
                $record['searecord'] = $totstr;
                $search->add($record);
            }

            $count=count($arts);
            $length=10;
            $page=new Page($count,$length);
            $page->setConfig('theme', "%first% %prePage% %linkPage%  %end%");
            $this->show=$page->show();
            $arts=array_slice($arts,$page->firstRow,$length);
            $this->arts=$arts;
        }elseif($_GET['type']==2){
            $music=M('music');
            $mus=$music->where("title like '%{$_GET['key']}%'")->select();
            foreach($mus as &$row2){
                $row2['description']=htmlspecialchars_decode($row2['description']);
                $row2['description']=strip_tags($row2['description']);
            }
            //            添加搜索记录
            if(!empty($mus)) {
                $totstr = json_encode($mus);
                $record['searecord'] = $totstr;
                $search->add($record);
            }

            $count=count($mus);
            $length=10;
            $page=new Page($count,$length);
            $page->setConfig('theme', "%first% %prePage% %linkPage%  %end%");
            $this->show=$page->show();
            $mus=array_slice($mus,$page->firstRow,$length);
            $this->mus=$mus;
        }elseif($_GET['type']==3){
            $user=M('user');
            $say=M('say');
            $says=$say->where("content like '%{$_GET['key']}%'")->select();
            foreach($says as &$row5){
                $row5['user']=$user->find($row5['userid']);
            }
            //            添加搜索记录
            if(!empty($says)) {
                $totstr = json_encode($says);
                $record['searecord'] = $totstr;
                $search->add($record);
            }

            $count=count($says);
            $length=10;
            $page=new Page($count,$length);
            $page->setConfig('theme', "%first% %prePage% %linkPage%  %end%");
            $this->show=$page->show();
            $says=array_slice($says,$page->firstRow,$length);
            $this->says=$says;
        }elseif($_GET['type']==4){
            $video=M('video');
            $vids=$video->where("title like '%{$_GET['key']}%'")->select();
            //            添加搜索记录
            if(!empty($vids)) {
                $totstr = json_encode($vids);
                $record['searecord'] = $totstr;
                $search->add($record);
            }

            $count=count($vids);
            $length=10;
            $page=new Page($count,$length);
            $page->setConfig('theme', "%first% %prePage% %linkPage%  %end%");
            $this->show=$page->show();
            $vids=array_slice($vids,$page->firstRow,$length);
            $this->vids=$vids;
        }

        $this->display();
    }

    public function hotsearch(){

    }
}


