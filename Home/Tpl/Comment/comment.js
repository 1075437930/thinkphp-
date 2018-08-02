/**
 * Created by Administrator on 2017/4/6 0006.
 */

$(function(){
    //让iframe的高度自适应页面的高度
    $(window.parent.document).find('.iframeId').height($('html').height())

    //评论回复start
    $(document).on('click','.form-group_t input[type=submit]',function(){
        var obj=$(this);
        if($(this).parent().hasClass('three')){
            du=" //@"+obj.attr('user')+' : '+obj.attr('con')
        }else{
            du=''
        }
        $.ajax({
           url:addcomment,
           type:"post",
            data:{
                content:obj.parent().prev().find('textarea').val(),
                contact:du,
                pid:obj.parent().next().val(),
                tid:$('.comment input[name=tid]').val(),
                typeid:$('.comment input[name=typeid]').val()
            },
            success:function(data){
                if (data == 'no') {
                    obj.parent().find('span').css({'color':'red'}).html('请先登录');
                    setTimeout(function () {
                        obj.parent().find('span').html('')
                    },2000);
                }else if(data==0){
                    if(obj.parent().hasClass('one')) {
                        obj.parent().find('span').css({'color': 'red'}).html('评论不能为空');
                        setTimeout(function () {
                            obj.parent().find('span').html('')
                        }, 2000);
                    }else{
                        obj.parent().find('span').css({'color': 'red'}).html('回复不能为空');
                        setTimeout(function () {
                            obj.parent().find('span').html('')
                        }, 2000);
                    }
                }else{
                    if(obj.parent().hasClass('one')) {
                        obj.parent().find('span').css({'color':'green'}).html('发表成功');
                        setTimeout(function () {
                            obj.parent().find('span').html('')
                        },2000);
                        $('.comment_info').prepend(data);
                        $(window.parent.document).find('.iframeId').height($('html').height())
                        location.reload();
                    }else if(obj.parent().hasClass('two')){
                        obj.parent().find('span').css({'color':'green'}).html('回复成功');
                        setTimeout(function () {
                            obj.parent().find('span').html('')
                        },2000);
                        obj.closest('.replay_form').next().prepend(data)
                        $(window.parent.document).find('.iframeId').height($('html').height())
                    }else{
                        obj.parent().find('span').css({'color':'green'}).html('回复成功');
                        setTimeout(function () {
                            obj.parent().find('span').html('')
                        },2000);
                        obj.closest('.item').after(data)
                        $(window.parent.document).find('.iframeId').height($('html').height())
                    }
                }
            }
        });
        return false;
    });
    $(document).on('click','.replay',function(){
        $(this).parent().next().slideToggle('fast','linear',function(){
            $(window.parent.document).find('.iframeId').height($('html').height())
        });

    });
    i=0;
    $(document).on('click','.showreplay',function(){
        if(i%2==0){
            $(this).find('span').html('∧')
        }else{
            $(this).find('span').html('∨')
        }
        i++;
        $(this).parent().next().next().slideToggle('fast','linear',function(){
            $(window.parent.document).find('.iframeId').height($('html').height())

        });

    });
//    评论回复end

//    加载更多评论start
    $('.comment_box>.more').click(function(){
       inde=$('.comment_info>.item').size()-1;
        $.ajax({
            url:getmorecomment,
            type:"post",
            data:{index:inde,typeid:type,tid:td,order:ord},
            success:function(data){
                if(data!='') {
                    $('.comment_info').append(data);
                    $(window.parent.document).find('.iframeId').height($('html').height())
                }else{
                    $('.more').html('没有更多了')
                }
            }
        })
    });
//    加载更多评论end

//    加载更多回复start
    $(document).on('click','.replay_info>.more',function(){
        inde=$(this).parent().find('.item').size()-1;
        cid=$(this).attr('cid');
        var obj=$(this);
        $.ajax({
            url:getmorereplay,
            type:"post",
            data:{index:inde,typeid:type,tid:td,id:cid},
            success:function(data){
                if(data!='') {
                    obj.before(data);
                    $(window.parent.document).find('.iframeId').height($('html').height())
                }else{
                    obj.html('没有更多了')
                }
            }
        });
    });
//    加载更多回复end

//    评论点赞start
    $(document).on('click','.comm_fab',function(){
        var obj=$(this);
        cid=$(this).attr('cid');
        $.ajax({
            url:addcommfab,
            type:"post",
            data:{id:cid},
            success:function(data){
                if(data=='no'){
                    obj.parent().prev().html('请先登录').show();
                    setTimeout(function () {
                        obj.parent().prev().hide()
                    },2000);
                }else if(data==0){
                    obj.parent().prev().html('不能重复点赞').show();
                    setTimeout(function () {
                        obj.parent().prev().hide()
                    },2000);
                }else{
                    obj.parent().prev().html('点赞成功').show();
                    setTimeout(function () {
                        obj.parent().prev().hide()
                    },2000);
                    obj.find('i').css({'background-position':'-40px -2px'})
                }
            }
        })
    });
//    评论点赞end
});