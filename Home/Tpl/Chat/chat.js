/**
 * Created by Administrator on 2017/5/3.
 */
$(function(){
    //    私信特效start
    $(document).click(function () {
        $('.chat_modal').hide();
        $('.chat').hide();
        $('body').css({'overflow':'auto'})
    });

    $('.chat').on('click','.chat_close',function () {
        $('.chat').hide();
        $('.chat_modal').hide();
        $('body').css({'overflow':'auto'})
    });

    //点击私信a链接弹出私信框start
    $('.letter').click(function (e) {
        if (login != 1) {
            $('.chat_tip').html('请先登录').show();
            T = setTimeout(function () {
                $('.chat_tip').hide();
            }, 2000);
        } else {
            $('.chat').show();
            $('.chat_modal').show();
            $('body').css({'overflow':'hidden'})
        }
        e.stopPropagation();
    });
    //点击私信a链接弹出私信框end

    $('.chat').click(function (e) {
        e.stopPropagation();
    });
    var ChatT;
    //获取聊天窗口start
    $('.chat').on('click','.chat_item_box figure',function () {
        vid = $(this).attr('vid');
        $.ajax({
            url: getchatwindow,
            type: "post",
            data: {to: vid},
            success: function (data) {
                $('.chat').html(data);
                $('.chat_expression').qqFace({

                    id: 'facebox3',

                    assign: 'saytext3',

                    path: headpath
                });
                i2 = 0;

                $('.chat_expression').click(function () {
                    if (i2 % 2 == 0) {
                        $('#facebox3').show();
                    } else {
                        $('#facebox3').hide();
                    }
                    i2++
                });

                $('.chat_bot').on('click', '#facebox3 img', function () {
                    $('#saytext3').append($(this).clone());
                });

                //定时加载聊天内容start
                ChatT = setInterval(function () {
                    vid = $('.chat_bot').attr('vid');
                    $.ajax({
                        url: getchat,
                        type: "post",
                        data: {to: vid},
                        success: function (data) {
                            $('.chat_con').html(data);
                        },
                        complete: function (XHR, TS) {
                            XHR = null;
                        }
                    });
                },300);
                //定时加载聊天内容end
            }
        });
    });
    //获取聊天窗口end

    //发送消息start
    $('.chat').on('click', '.chat_btn', function () {
        vid = $('.chat_bot').attr('vid');
        con = $('#saytext3').html();
        $.ajax({
            url: addorsavechat,
            type: "post",
            data: {to: vid, cont: con},
            success: function (data) {
                //这里给0.5秒的间隔时间是为了赶在定时加载之后再滚动到底部，因为如果在定时加载之前的话滚动到的高度还是原来没有添加数据时.chat_con的底部
                Ht=setTimeout(function(){
                    $('.chat_con').scrollTop($('.chat_con')[0].scrollHeight);
                },500);
                $('#saytext3').html('')
            }
        });
    });
    //发送消息end


    //    点击返回加载私信列表start
    $('.chat').on('click','.reback',function(){
        clearInterval(ChatT);
        $.ajax({
            url:getchatlist,
            type: "post",
            success: function (data) {
                $('.chat').html(data);
            }
        });
    });
    //    点击返回加载私信列表end

    //    点击新私信获取新私信窗口start
    $('.chat').on('click','.chat_heading button',function(){
        $.ajax({
            url:chooseuserwindow ,
            type: "post",
            success: function (data) {
                $('.chat').html(data);
            }
        });
    });
    //    点击新私信获取新私信窗口end

    //   实时监听用户名输入框值的变化获取相应的用户start
    $('.chat').on('input propertychange blur','.touser',function(){
        obj=$(this);
        $.ajax({
            url:getuser ,
            type: "post",
            data: {user:obj.val()},
            success: function (data) {
                $('.userbox').html(data)

            }
        });
    });
    //   实时监听用户名输入框值的变化获取相应的用户end

    //点击用户将用户名放入用户名输入框值
    $('.chat').on('click','.user_item',function(){
        $('.touser').val($(this).find('span').html());
    });

    //点击下一步创建新私信
    $('.chat').on('click','.next',function() {
        val=$('.touser').val();
        $.ajax({
            url:addorsavechat ,
            type: "post",
            data: {user:val},
            success: function (data) {
                console.log(data);
                if(data=='nouser'){

                    $('.chat_tip').html("用户不存在").show();
                    T=setTimeout(function(){
                        $('.chat_tip').hide();
                    },2000)
                }else if(data=='same'){
                    $('.chat_tip').html("不能对自己发送私信").show();
                    T=setTimeout(function(){
                        $('.chat_tip').hide();
                    },2000)
                }else{
                    console.log(data);
                    $.ajax({
                        url: getchatwindow,
                        type: "post",
                        data: {to: data},
                        success: function (data) {
                            $('.chat').html(data);
                            $('.chat_expression').qqFace({

                                id: 'facebox3',

                                assign: 'saytext3',

                                path: headpath
                            });
                            i2 = 0;

                            $('.chat_expression').click(function () {
                                if (i2 % 2 == 0) {
                                    $('#facebox3').show();
                                } else {
                                    $('#facebox3').hide();
                                }
                                i2++
                            });

                            $('.chat_bot').on('click', '#facebox3 img', function () {
                                $('#saytext3').append($(this).clone());
                            });

                            //定时加载聊天内容start
                            ChatT = setInterval(function () {
                                vid = $('.chat_bot').attr('vid');
                                $.ajax({
                                    url: getchat,
                                    type: "post",
                                    data: {to: vid},
                                    success: function (data) {
                                        $('.chat_con').html(data);
                                    },
                                    complete: function (XHR, TS) {
                                        XHR = null;
                                    }
                                });
                            },300);
                            //定时加载聊天内容end
                        }
                    });
                }
            }
        });
    });
//    私信特效end
});