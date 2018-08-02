<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/3
 * Time: 9:43
 */
class ChatAction extends Action{

    public function index(){
        //      查询当前登录用户的私信
        $user=M('user');
        $chat=M('chat');
        $chats=$chat->where("fromuserid={$_SESSION['userid']}")->select();

        foreach($chats as &$row9){
            $row9['user']=$user->find($row9['touserid']);
        }

        $this->chats=$chats;
        $this->display();
    }

    // 获取聊天窗口
    public function getchatwindow(){
        $user=M('user');
        $this->row=$user->find($_POST['to']);

        $this->display();
    }


    public function addorsavechat(){
        $user=M('user');
        $chat=M('chat');
        if(isset($_POST['user'])){
            $count=$user->where("username='{$_POST[user]}'")->count();
            if(!$count){
                echo 'nouser';
                exit;
            }else{
                if($_POST['user']!=$_SESSION['username']) {
                    $row = $user->where("username='{$_POST[user]}'")->find();
                    $_POST['fromuserid'] = $_SESSION['userid'];
                    $_POST['touserid'] = $row['id'];
                    $row2 = $chat->where($_POST)->find();
                    if ($row2) {
                        echo $row['id'];
                    } else {
                        $chat->add($_POST);
                        $relative['fromuserid'] = $row['id'];
                        $relative['touserid'] = $_SESSION['userid'];
                        $chat->add($relative);
                        echo $row['id'];
                    }
                }else{
                    echo "same";
                    exit;
                }
            }
        }else{
            $_POST['fromuserid']=$_SESSION['userid'];
            $_POST['touserid']=$_POST['to'];
            $_POST['cont']=htmlspecialchars_decode($_POST['cont']);
            $_POST['cont']=strip_tags($_POST['cont'],'<img>');
            $content=htmlspecialchars($_POST['cont']);
            $row=$chat->where($_POST)->find();
            $arr=json_decode($row['content'],true);
            $arr[]=array('id'=>"{$_POST['fromuserid']}",'content'=>"{$content}",'time'=>time());
            $_POST['content']=json_encode($arr);
            $_POST['id']=$row['id'];
            $chat->save($_POST);
            $relative['fromuserid']=$_POST['to'];
            $relative['touserid']=$_SESSION['userid'];
            $relarow=$chat->where($relative)->find();
            $relative['content']=json_encode($arr);
            $relative['id']=$relarow['id'];
            $chat->save($relative);
        }

    }

//    获取聊天内容
    public function getchat(){
        $chat=M('chat');
        $user=M('user');
        $_POST['fromuserid']=$_SESSION['userid'];
        $_POST['touserid']=$_POST['to'];
        $row=$chat->where($_POST)->find();

        $arrs=json_decode($row['content'],true);

        $times=array();

        foreach($arrs as &$row2){
            $row2['user']=$user->find($row2['id']);
            $times[]=$row2['time'];
        }
        array_multisort($times,SORT_ASC,$arrs);
        $this->arrs=$arrs;


        $this->display();
    }

//    获取私信列表
    public function getchatlist(){
        //      查询当前登录用户的私信
        $chat=M('chat');
        $user=M('user');
        $chats=$chat->where("fromuserid={$_SESSION['userid']}")->select();

        foreach($chats as &$row9){
            $row9['user']=$user->find($row9['touserid']);
        }

        $this->chats=$chats;

        $this->display();
    }

//    获取新私信窗口
    public function chooseuserwindow(){
        $this->display();
    }

//   获取用户
    public function getuser(){
        $user=M('user');
        $this->rows=$user->where("username like '%{$_POST[user]}%'")->select();

        $this->display();
    }
}