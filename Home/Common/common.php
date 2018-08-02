<?php
/**统计文章浏览量的函数
 * @param $arti  文章(或者是音乐，视频等)数据表操作对象  比如 $arti=M('article');
 * @param $lastred   当前文章最后一次被访问时的时间戳  比如 $row['lastred']
 * @param $dayviews  当前文章最后一次被访问所在日的日访问量  比如 $row['dayviews']
 * @param $weekviews 当前文章最后一次被访问所在周的周访问量  比如 $row['weekviews']
 * @param $views 当前文章最后一次被访问时的总访问量  比如 $row['views']
 * @param $ip  当前客户端的ip地址  用get_client_ip()获取
 */
function Statistics($arti, $lastred, $dayviews, $weekviews, $views, $ip)
{
    $str = date('Y-m-d', $lastred);
    //判断cookie里是否存在下标为hid的值，hid是用来存储当前客户浏览过的文章的id，hid的值json数组字符串，因为cookie不能存储数组，只能存储字符串，所以hid的值是用json_encode()转换数组得来的。而这个数组就是存储浏览过的文章id
    if (isset($_COOKIE['hid'])) {
        //如果存在，说明当前客户已经浏览过本站某一篇文章了，把其再转换回数组，下面要用这个数组判断当前客户浏览过当前文章没有
        $is = json_decode(cookie('hid'));
    }

// 判断当前客户端ip在cookie里有没有被存储过，如果没有被存储过，说明当前客户还没有浏览过本站任何文章
    if ($ip != cookie('ip')) {
        //定义空数组$arr2,将其转换为JSON字符串，存储进cookie,下标为hid,这个就是用来存储客户浏览过的文章的id
        $arr2 = array();
        $hid = json_encode($arr2);
        cookie('hid', $hid, 30 * 24 * 60 * 60);

        //获取最后一次被访问当天的零点和24点的时间戳
        $zero = strtotime($str . ' 00:00:00');
        $er = strtotime($str . ' 24:00:00');
        //判断当前时间是否在最后一次被访问当天，如果在就把当前文章的dayviews+1，如果不在，说明已经过了最后一次被访问当天，那就把当前文章的dayviews归零并+1，然后把最后最后一次被访问时间更新为当前时间戳
        if (time() < $er && time() > $zero) {
            $modi['id'] = $_GET['id'];
            $modi['dayviews'] = $dayviews + 1;
            $modi['$lastred'] = time();
            $arti->save($modi);
            //因为客户已经浏览过本站了，所以将客户ip存入cookie
            cookie('ip', $ip, 30 * 24 * 60 * 60);
            //将cookid里的hid(也就是josn字符串)转换为数组
            $arr3 = json_decode(cookie('hid'));
            //将当前文章的id存入数组$arr3,然后再转换为json字符串再存入cookie,这样文章因为被浏览过了其id被存入了cookie
            $arr3[] = $_GET['id'];
            $hid1 = json_encode($arr3);
            cookie('hid', $hid1, 30 * 24 * 60 * 60);
        } else {
            $modi['id'] = $_GET['id'];
            $modi['dayviews'] = 1;
            $modi['$lastred'] = time();
            $arti->save($modi);
            cookie('ip', $ip, 30 * 24 * 60 * 60);
            $arr3 = json_decode(cookie('hid'));
            $arr3[] = $_GET['id'];
            $hid1 = json_encode($arr3);
            cookie('hid', $hid1, 30 * 24 * 60 * 60);
        }

        //获取最后一次被访问当天所在周的第一天和所在周的下一周第一天的时间戳
        function getdays($day)
        {
            $lastday = date('Y-m-d', strtotime("$day Sunday"));
            $firstday = date('Y-m-d', strtotime("$lastday -6 days"));
            $arr = explode('-', $lastday);
            $arr[2] = $arr[2] + 1;
            $lastday = join('-', $arr);
            return array(strtotime($firstday), strtotime($lastday));
        }

        //判断当前时间是否在最后一次被访问当周，如果在就把当前文章的weekviews+1，如果不在，说明已经过了最后一次被访问当周，那就把当前文章的weekviews归零并+1，然后把最后最后一次被访问时间更新为当前时间戳

        if (time() < getdays($str)[1] && time() > getdays($str)[0]) {
            $modi['id'] = $_GET['id'];
            $modi['weekviews'] = $weekviews + 1;
            $modi['$lastred'] = time();
            $arti->save($modi);
            cookie('ip', $ip, 30 * 24 * 60 * 60);
            $arr3 = json_decode(cookie('hid'));
            $arr3[] = $_GET['id'];
            $hid1 = json_encode($arr3);
            cookie('hid', $hid1, 30 * 24 * 60 * 60);
        } else {
            $modi['id'] = $_GET['id'];
            $modi['weekviews'] = 1;
            $modi['$lastred'] = time();
            $arti->save($modi);
            cookie('ip', $ip, 30 * 24 * 60 * 60);
            $arr3 = json_decode(cookie('hid'));
            $arr3[] = $_GET['id'];
            $hid1 = json_encode($arr3);
            cookie('hid', $hid1, 30 * 24 * 60 * 60);
        }

        //        更新总浏览量
        $modi['views'] = $views + 1;
        $modi['$lastred'] = time();
        $arti->save($modi);

        //如果当前客户端的ip没有变，那就判断当前客户是否浏览过当前文章，如果没有浏览过，就还按照上面的步骤进行更新数据库
    } elseif (!in_array($_GET['id'], $is)) {
        $zero = strtotime($str . ' 00:00:00');
        $er = strtotime($str . ' 24:00:00');
        if (time() < $er && time() > $zero) {
            $modi['id'] = $_GET['id'];
            $modi['dayviews'] = $dayviews + 1;
            $modi['$lastred'] = time();
            $arti->save($modi);
            $arr3 = json_decode(cookie('hid'));
            $arr3[] = $_GET['id'];
            $hid1 = json_encode($arr3);
            cookie('hid', $hid1, 30 * 24 * 60 * 60);
        } else {
            $modi['id'] = $_GET['id'];
            $modi['dayviews'] = 1;
            $modi['$lastred'] = time();
            $arti->save($modi);
            $arr3 = json_decode(cookie('hid'));
            $arr3[] = $_GET['id'];
            $hid1 = json_encode($arr3);
            cookie('hid', $hid1, 30 * 24 * 60 * 60);
        }

        //获取最后记录当天所在周的第一天和最后一天
        function getdays($day)
        {
            $lastday = date('Y-m-d', strtotime("$day Sunday"));
            $firstday = date('Y-m-d', strtotime("$lastday -6 days"));
            $arr = explode('-', $lastday);
            $arr[2] = $arr[2] + 1;
            $lastday = join('-', $arr);
            return array(strtotime($firstday), strtotime($lastday));
        }

        if (time() < getdays($str)[1] && time() > getdays($str)[0]) {
            $modi['id'] = $_GET['id'];
            $modi['weekviews'] = $weekviews + 1;
            $modi['$lastred'] = time();
            $arti->save($modi);
            $arr3 = json_decode(cookie('hid'));
            $arr3[] = $_GET['id'];
            $hid1 = json_encode($arr3);
            cookie('hid', $hid1, 30 * 24 * 60 * 60);
        } else {
            $modi['id'] = $_GET['id'];
            $modi['weekviews'] = 1;
            $modi['$lastred'] = time();
            $arti->save($modi);
            $arr3 = json_decode(cookie('hid'));
            $arr3[] = $_GET['id'];
            $hid1 = json_encode($arr3);
            cookie('hid', $hid1, 30 * 24 * 60 * 60);
        }

//        更新总浏览量
        $modi['views'] = $views + 1;
        $modi['$lastred'] = time();
        $arti->save($modi);

    }

}

/**
 * 用递归函数把刚刚修改的分类下所有的后代分类全部修改
 * @param $id  刚刚修改的分类的id
 */
function son($id, &$arr, &$time)
{
    $comment = D('comment');
    $user = M('user');
    $rows = $comment->where("pid={$id}")->select();
    foreach ($rows as &$row2) {
        $row2['user'] = $user->find($row2['userid']);
        $fabarr = json_decode($row2['fabuser'], true);
        $row2['fabnum'] = count($fabarr);
        if (in_array($_SESSION['userid'], $fabarr)) {
            $row2['isfab'] = 1;
        } else {
            $row2['isfab'] = 0;
        }
        $arr[] = $row2;
        $time[] = $row2['time'];
        son($row2['id'], $arr, $time);
    }
}

/**
 * @param $str 内容字符串
 * @return mixed
 */
function ubbReplace($str)
{
    $str = str_replace(">", '<；', $str);
    $str = str_replace(">", '>；', $str);
    $str = str_replace("\n", '>；br/>；', $str);
    $str = preg_replace("[\[em_([0-9]*)\]]", "<img src=\"/jin/Home/Tpl/Public/Js/jQuery-qqFace933020160323/qqFace/arclist/$1.gif\" />", $str);
    return $str;
}

/**
 * @param $file  原图的路径
 * @param $minw  缩略图最大宽度
 * @param $minh  缩略图最大高度
 */
function thumb($file,$minw,$minh)
{
//    获取大图的图像信息
    $imgarr = getimagesize($file);
    $maxw = $imgarr[0];
    $maxh = $imgarr[1];
    $maxt = $imgarr[2];
    $dir = dirname($file);
    $basename = basename($file);
    $minpath = $dir . '/thumb_' . $basename;
//     变量函数(就是把函数名赋值给一个变量) 判断大图的格式，然后将对应的获取图片资源的函数赋值给变量
    switch ($maxt) {
        case 1:
            $imgfun = 'imagecreatefromgif';
            break;
        case 2:
            $imgfun = 'imagecreatefromjpeg';
            break;
        case 3:
            $imgfun = 'imagecreatefrompng';
            break;
    }

//    获取大图资源
    $max = $imgfun($file);

//    根据缩略图的最大宽高计算缩放比例（等比例）
    $scale = ($maxw / $minw) > ($maxh / $minh) ? ($maxw / $minw) : ($maxh / $minh);

//    计算缩略图的真实宽高
    $minw = floor($maxw / $scale);
    $minh = floor($maxh / $scale);

//    创建目标画布
    $min = imagecreatetruecolor($minw, $minh);

//    对大图进行等比例缩放
    imagecopyresampled($min, $max, 0, 0, 0, 0, $minw, $minh, $maxw, $maxh);

//    判断大图的格式，然后将对应的保存图片的函数赋值给变量
    switch ($maxt) {
        case 1:
            $imgour = 'imagegif';
            break;
        case 2:
            $imgour = 'imagejpeg';
            break;
        case 3:
            $imgour = 'imagepng';
            break;
    }
//    保存缩略图
    $imgour($min,$minpath,90);
    return $minpath;
}

    function cut($file,$minw,$minh,$cutx,$cuty,$cutw,$cuth){
//    获取大图的图像信息
        $imgarr=getimagesize($file);
        $maxw=$imgarr[0];
        $maxh=$imgarr[1];
        $maxt=$imgarr[2];
        $dir=dirname($file);
        $basename=basename($file);
        $minpath=$dir.'/cut_'.$basename;
//     变量函数(就是把函数名赋值给一个变量) 判断大图的格式，然后将对应的获取图片资源的函数赋值给变量
        switch($maxt){
            case 1:
                $imgfun='imagecreatefromgif';
                break;
            case 2:
                $imgfun='imagecreatefromjpeg';
                break;
            case 3:
                $imgfun='imagecreatefrompng';
                break;
        }
//    获取大图资源
        $max=$imgfun($file);

//    根据裁剪后图片的最大宽高计算缩放比例（等比例）
        $scale=($maxw/$minw)>($maxh/$minh)?($maxw/$minw):($maxh/$minh);

//    计算裁剪后图片的真实宽高
        $minw=floor($maxw/$scale);
        $minh=floor($maxh/$scale);

//    创建目标画布
        $min=imagecreatetruecolor($minw,$minh);

//    对大图进行等比例裁剪
        imagecopyresampled($min,$max,0,0,$cutx,$cuty,$minw,$minh,$cutw,$cuth);

//    判断大图的格式，然后将对应的保存图片的函数赋值给变量
        switch($maxt){
            case 1:
                $imgour='imagegif';
                break;
            case 2:
                $imgour='imagejpeg';
                break;
            case 3:
                $imgour='imagepng';
                break;
        }

//    保存裁剪后的图片
        $imgour($min,$minpath,90);
        return $minpath;
    }


//二维数组去除特定键的重复项
function array_unset($arr,$key){   //$arr->传入数组   $key->判断的key值
    //建立一个目标数组
    $res = array();
    foreach ($arr as $value) {
        //查看有没有重复项
        if(!isset($res[$value[$key]])){
            $res[$value[$key]] = $value;
        }
    }
    return $res;
}