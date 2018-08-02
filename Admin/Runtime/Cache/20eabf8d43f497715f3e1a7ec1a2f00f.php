<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>首页</title>
    <link rel="stylesheet" href="../Public/bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Public/CSS/index.css">
    <script src="__PUBLIC__/Js/jquery-1.10.2.min_65682a2.js"></script>
    <script src="../Public/bs/js/bootstrap.min.js"></script>
    <script src="../Public/js/index.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="javascript:" class="now"></a> </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="__ROOT__/index.php">前台首页</a> </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo ($_SESSION['img']); ?>" width="20px" height="20px"><?php echo ($_SESSION['username']); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:" data-toggle="modal" data-target="#myModal">修改密码</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="__APP__/Login/loginout">退出后台</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--修改密码模态框start-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 href="">修改密码</h3>
                    </div>
                    <div class="modal-body">
                        <form action="__APP__/Login/update" method="post">
                         <div class="form-group">
                            <label>用户名</label>
                            <input type="text" value="<?php echo ($_SESSION['username']); ?>" disabled class="form-control">
                         </div>
                        <div class="form-group">
                            <label>原密码</label>
                            <input type="password"  name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>新密码</label>
                            <input type="password"  name="newpassword" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-default" >确认</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--修改密码模态框end-->
    </div>
</nav>


<div class="container-fluid">
    <div class="row">
        <!--侧边导航start-->
        <div class="col-md-2 leftce">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse"  class="contr" data-parent="#accordion" href="javascript:" aria-expanded="true" aria-controls="collapseOne">
                                <span class="glyphicon glyphicon-user"></span>用户模块
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="__APP__/User/admin"  target="right" class="list-group-item" module="用户模块" action="管理员信息">
                                    管理员信息
                                </a>
                                <a href="__APP__/User/add"  target="right" class="list-group-item" module="用户模块" action="添加管理员">
                                    添加管理员
                                </a>
                                <a href="__APP__/User/manage"  target="right" class="list-group-item" module="用户模块" action="用户管理">
                                    用户管理
                                </a>
                                <a href="__APP__/User/adduser"  target="right" class="list-group-item" module="用户模块" action="添加用户">
                                    添加用户
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="false">
                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingOne1">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse"  class="contr"
data-parent="#accordion" href="javascript:" aria-expanded="false" aria-controls="collapseOne">
                                <span class="
glyphicon glyphicon-book"></span>内容模块
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="__APP__/Content/column" class="list-group-item" target="right" module="内容模块" action=" 管理栏目">
                                    管理栏目
                                </a>
                                <a href="__APP__/Content/substance" class="list-group-item" target="right" module="内容模块" action="管理内容">管理内容</a>
                                <a href="__APP__/Content/recommend" class="list-group-item" module="内容模块" action="推荐位管理" target="right">推荐位管理</a>
                                <a href="__APP__/Content/artispecial" class="list-group-item" module="内容模块" action="文章专题" target="right">文章专题</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="false">
                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingOne2">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse"  class="contr"
                               data-parent="#accordion" href="javascript:" aria-expanded="false" aria-controls="collapseOne">
                                <span class="glyphicon glyphicon-globe"></span>评论模块
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="__APP__/Comment/index" class="list-group-item" target="right" module="评论模块" action=" 管理评论">
                                    管理评论
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-group" id="accordion3" role="tablist" aria-multiselectable="false">
                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingOne3">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse"  class="contr"
                               data-parent="#accordion" href="javascript:" aria-expanded="false" aria-controls="collapseOne">
                                <span class="
glyphicon glyphicon-bullhorn"></span>广告模块
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne3" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="__APP__/Advertisement/index" class="list-group-item" target="right" module="广告模块" action=" 管理广告">
                                    管理广告
                                </a>
                                <a href="__APP__/Advertisement/recommend" class="list-group-item" target="right" module="广告模块" action=" 广告位置">
                                    广告位置
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--侧边导航end-->
        <div class="col-md-10">
            <p class="bg-info crumbs">
                <span class="glyphicon glyphicon-home"></span>
                <a href="">首页</a>
                <span class="Separator">> </span>
                <span class="module"></span>
                <span class="Separator">> </span>
                <span class="action"></span>
            </p>
            <iframe src="__URL__/information" name="right" width="100%"
                    height="480px" >

            </iframe>
        </div>

    </div>
</div>

</body>
</html>