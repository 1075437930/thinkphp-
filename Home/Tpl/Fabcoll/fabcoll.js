/**
 * Created by Administrator on 2017/4/3 0003.
 */
$(function(){
    $(window.parent.document).find('.fabcoll').height($('html').height());
    //点赞start
    $('.fabulous').click(function(){
        obj=$(this);
        if( obj.find('i').css('background-position')=='-40px -165px') {
            $.ajax({
                url: addfab,
                type: 'get',
                data: {fab: 1,thing: id, user:userid,type:typeid},
                success: function (data) {
                    if (data == 'no') {
                        $('.tip').html('请先登录').show();
                        setTimeout(function () {
                            $('.tip').hide()
                        }, 2000);
                    }
                    if(data==1){
                        obj.find('i').css({'background-position': '-58px  -165px'});
                        $('.tip').html('已赞').show();
                        location.reload();
                        setTimeout(function () {
                            $('.tip').hide()
                        }, 2000);
                    }
                }
            })
        }else {
            $.ajax({
                url:addfab,
                type:'get',
                data:{fab:0,thing:id,user:userid,type:typeid},
                success:function(data){
                    if(data==0){
                        obj.find('i').css({'background-position':'-40px -165px'});
                        $('.tip').html('已取消赞').show();
                        location.reload();
                        setTimeout(function(){
                            $('.tip').hide()
                        },2000);
                    }
                }
            })
        }
    });
    //点赞end
    //收藏start
    $('.coll').click(function(){
        obj=$(this);
        if(obj.find('i').css('background-position')=='-80px -165px') {
            $.ajax({
                url: collhand,
                type: 'get',
                data: {fab: 1, thing: id, user: userid,type:typeid},
                success: function (data) {
                    if (data == 'no') {
                        $('.tip').html('请先登录').show();
                        location.reload();
                        setTimeout(function () {
                            $('.tip').hide()
                        },2000);
                    }
                    if(data==1){
                        obj.find('i').css({'background-position':'-98px  -165px'});
                        $('.tip').html('已收藏').show();
                        location.reload();
                        setTimeout(function () {
                            $('.tip').hide()
                        },2000);
                    }
                }
            })
        }else {
            $.ajax({
                url:collhand,
                type:'get',
                data:{fab:0,thing:id,user: userid,type:typeid},
                success:function(data){
                    if(data==0){
                        obj.find('i').css({'background-position':'-80px -165px'});
                        $('.tip').html('已取消收藏').show();
                        location.reload();
                        setTimeout(function(){
                            $('.tip').hide()
                        },2000);
                    }
                }
            })
        }
    });
    //收藏end
});