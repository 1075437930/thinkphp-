/**
 * Created by Administrator on 2017/4/3 0003.
 */
$(function(){
    $(window.parent.document).find('.follow').height($('html').height());

    $(document).on('mouseenter','.have',function(){
        $(this).html('取消关注').css({'background':'#DA235B'})
    });
    $(document).on('mouseleave','.have',function(){
        $(this).html('已经关注').css({'background':'#1C9EEE'})
    });

    //关注start
    $('.btn').click(function(){
        obj=$(this);
        if( obj.html()=='关注') {
            $.ajax({
                url: addfollow,
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
                        obj.html('已经关注').removeClass('now').addClass('have');
                    }
                }
            })
        }else {
            $.ajax({
                url:addfollow,
                type:'get',
                data:{fab:0,thing:id,user:userid,type:typeid},
                success:function(data){
                    if(data==0){
                        obj.html('关注').removeClass('have').removeAttr('style').addClass('now');
                    }
                }
            })
        }
    });
    //关注end

});