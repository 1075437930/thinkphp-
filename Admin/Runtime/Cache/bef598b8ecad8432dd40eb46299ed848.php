<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script src="__PUBLIC__/Js/jquery.js"></script>
    <script src="__PUBLIC__/Js/ajaxfileupload.js"></script>


    <script>
        $(function(){
           $('input[type=file]').change(function(){
               $.ajaxFileUpload({
                   url:"<?php echo U('uploadimg');?>", //你处理上传文件的服务端
                   secureuri:false,//是否启用安全机制
                   fileElementId:'file1',//file的id
                   dataType: 'application/json',//返回的类型
                   success: function (data) {//调用成功时怎么处理
                       $('.preview').html(data)
                   }
               });
           });


            $(document).on('click','.del',function(){
                $(this).prev().hide();
                $(this).next().val('');
                $(this).hide()
            });

            $('form').submit(function(){
                str=''
                $('input[name=item]').each(function(){
                    if($(this).val()!=''){
                        str+=$(this).val()+'-'
                    }
                });
                str=str.substring(0,str.length-1);
                $('input[name=total]').val(str);

            });

        });
    </script>
    <style>
        .del{
            background-color: red;
            cursor: pointer;
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <form action="__URL__/insert1" method="post">
        <input id='file1' type="file"  name="img[]" multiple="true">
        <div class="preview">

        </div>
        <input type="hidden" name="total">
        <input type="submit" value="提交">
    </form>
</body>
</html>