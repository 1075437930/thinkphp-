/**
 * Created by Administrator on 2017/4/18.
 */
$(function(){
    //让iframe的高度自适应页面的高度
    function auto(){
        $(window.parent.document).find('.headiframe').height( $(window.parent.document).find('html').height());
        $(window.parent.document).find('.headiframe').width( $(window.parent.document).find('html').width());
    }
    //auto();
    $(document).on('click','.blue .upload',function(e){
        $(this).find('ul').toggle();
        e.stopPropagation();
        //auto()
    });
    $(document).on('click','.blue .head',function(e){
        $(this).find('ul').toggle();
        e.stopPropagation();
        //auto()
    });

    $('.blue ul .del').click(function(e){
        $(this).parent().hide();
        e.stopPropagation();
    });
    $(document).on('click','.blue .upload i+li',function(e){
        $('.blue .upload input').click();
        e.stopPropagation();
    });

    var jcrop_api;
    $(document).on('change','.blue ul input',function(){
        $.ajaxFileUpload({
            url:ajaxupload, //你处理上传文件的服务端
            secureuri:false,//是否启用安全机制
            fileElementId:'file1',//file的id
            dataType: 'application/json',//返回的类型
            success: function (data) {//调用成功时怎么处理
                $('.cutpop').show().find('.original').attr('src',site+ '/Public/Uploads/headport/' + data);
                $('.cutpop .preview img').attr('src',site+ '/Public/Uploads/headport/' + data);
                $('input[type=hidden][name=file]').val('Public/Uploads/headport/' + data);

                $('.headupmodal').show();
                $('.blue ul').hide();

                //头像裁剪框start
                var boundx,
                    boundy,
                    $preview = $('.cutpop .preview'),
                    $pcnt = $('.cutpop .preview .preview_contain'),
                    $pimg = $('.cutpop .preview .preview_contain img'),


                    xsize = $pcnt.width(),
                    ysize = $pcnt.height();
                console.log('init', [xsize, ysize]);

                $('#element_id').Jcrop({
                    aspectRatio: 1,
                    onChange: updateCoords,
                    onSelect: updateCoords,
                    // 上来就显示裁剪框
                    setSelect: [0, 0, 350, 350]
                }, function () {
                    var bounds = this.getBounds();
                    boundx = bounds[0];
                    boundy = bounds[1];
                    jcrop_api=this;
                });

                //  将裁剪框的四个坐标赋值给对应的input，待会儿要发送给php
                function updateCoords(c) {
                    $('#x').val(c.x);
                    $('#y').val(c.y);
                    $('#w').val(c.w);
                    $('#h').val(c.h);
                    if (parseInt(c.w) > 0) {
                        var rx = xsize / c.w;
                        var ry = ysize / c.h;

                        $pimg.css({
                            width: Math.round(rx * boundx) + 'px',
                            height: Math.round(ry * boundy) + 'px',
                            marginLeft: '-' + Math.round(rx * c.x) + 'px',
                            marginTop: '-' + Math.round(ry * c.y) + 'px'
                        });
                    }
                }
                //头像裁剪框end
                auto()
            }
        });
    });
    $(document).on('click','.blue .head .revoke',function(e){
        $.ajax({
            url:revokeimg,
            type:"post",
            data:{file:$('.blue .head img').attr('src')},
            success:function(data){
                $('.blue .head').remove();
                $('.blue').prepend(data);

            }
        });
        jcrop_api.destroy();
        $('.cutpop').find('.original').removeAttr('style');
        $('.cutpop .preview img').removeAttr('style');
        e.stopPropagation();
    });
    //点击关闭头像裁剪弹出框，并发送ajax删除刚刚上传的图片start
    $('.cutpop .cutclose').click(function(e){
        jcrop_api.destroy();
        $('.cutpop').find('.original').removeAttr('style');
        $('.cutpop .preview img').removeAttr('style');

        $('.cutpop').hide();
        $('.headupmodal').hide();
        $.ajax({
            url:imgdel,
            type:"post",
            data:{file:$('input[type=hidden][name=file]').val()},
            success:function(data){

            }
        });
        e.stopPropagation();
    });
    $('.cutpop .cutdel').click(function(e){
        jcrop_api.destroy();
        $('.cutpop').find('.original').removeAttr('style');
        $('.cutpop .preview img').removeAttr('style');

        $('.cutpop').hide();
        $('.headupmodal').hide();
        $.ajax({
            url:imgdel,
            type:"post",
            data:{file:$('input[type=hidden][name=file]').val()},
            success:function(data){

            }
        });
        e.stopPropagation();
    });
    //点击关闭头像裁剪弹出框，并发送ajax删除刚刚上传的图片end

    //发送裁剪坐标及宽高度进行头像裁剪保存start
    $('.cutok').click(function(e){
        $.ajax({
            url:cutimg,
            type:"post",
            data:$('.cut_bot form').serialize(),
            success:function(data){
                $('.blue .upload').remove();
                $('.cutpop').hide();
                $('.headupmodal').hide();
                $('.blue').prepend(data);
                jcrop_api.destroy();
            }
        });
        e.stopPropagation();
        //发送裁剪坐标及宽高度进行头像裁剪保存end
    });
    $(document).click(function(){
        jcrop_api.destroy();
        $('.cutpop').hide();
        $('.cutpop').find('.original').removeAttr('style');
        $('.cutpop .preview img').removeAttr('style');

        $('.cutpop').hide();
        $('.headupmodal').hide();
        $.ajax({
            url:imgdel,
            type:"post",
            data:{file:$('input[type=hidden][name=file]').val()},
            success:function(data){

            }
        });
    });

    $('.cutpop').click(function(e){
        e.stopPropagation();
    });
    //    登录用户框上传裁剪头像特效end
});