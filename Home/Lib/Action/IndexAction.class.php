<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
            $class=M('class');
            $this->columns=$class->where('pid=0')->select();

            // 查询幻灯推荐内容
              $art=M('article');
              $wens=$art->order('inputtime desc')->select();

              $all=array();//储存有幻灯片推荐位的内容
             
              foreach ($wens as $key => &$row) {
                    $row['content']=htmlspecialchars_decode($row['content']);
                  preg_match("/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i", $row['content'], $arr);
                    $row['img']=$arr[0];
                    $posarr=explode("-", $row['positionid']);
                    if(in_array(5, $posarr)){
                        $all[]=$row;
                    }   
              }

              $all=array_slice($all,0,5);
              $this->all=$all;


//            查询热门文章
            $art=M('article');
            $remens=$art->order('views desc')->limit('0,4')->select();

            foreach($remens as &$val){
                $val['content']=htmlspecialchars_decode($val['content']);
                preg_match("/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i", $val['content'], $arr);
                $val['img']=$arr[0];
            }
                $this->remens=$remens;

            // 查询热门视频
            $video=M('video');
            $rvids=$video->order('views desc')->limit('0,4')->select();
            $this->rvids=$rvids;
            

            // 查询热门歌曲
            $music=M('music');
            $mus=$music->order('views desc')->limit("0,4")->select();

            foreach ($mus as &$val2) {
                $val2['description']=htmlspecialchars_decode($val2['description']);
                $val2['description']=strip_tags($val2['description']);
            }


            
            $this->mus=$mus;

            // 查询热门动态
            $say=M('say');
            $user=M('user');
            $dys=$say->order("rand()")->limit('0,6')->select();
            foreach ($dys as $key => &$value) {
                $name=$user->find($value['userid'])['username'];
                $port=$user->find($value['userid'])['img'];
                $value['username']=$name;
                 $value['img']=$port;
                $value['content']=htmlspecialchars_decode($value['content']);
            }

            $this->dys=$dys;

            

            $this->display();
    }

    
}