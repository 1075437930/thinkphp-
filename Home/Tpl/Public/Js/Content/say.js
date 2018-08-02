/**
 * Created by Administrator on 2017/4/10.
 */
$(function () {
    //导航图标切换效果start
    $('.square_tb').parent().hover(function () {
        $(this).find('i').css({'background-image': "url('/jin/Home/Tpl/Public/Images/h2.png')"});
    }, function () {
        $(this).find('i').css({'background-image': "url('/jin/Home/Tpl/Public/Images/h1.png')"});
    });
    $('.si_tb').parent().hover(function () {
        $(this).find('i').css({'background-image': "url('/jin/Home/Tpl/Public/Images/s2.png')"});
    }, function () {
        $(this).find('i').css({'background-image': "url('/jin/Home/Tpl/Public/Images/s1.png')"});
    });
    //导航图标切换效果end

    //表情包start
    $('.expression_tb').qqFace({

        id: 'facebox',

        assign: 'saytext',

        path: '/jin/Home/Tpl/Public/Js/jQuery-qqFace933020160323/qqFace/arclist/'
    });
    i = 0;
    $('.expression_tb').click(function () {
        if (i % 2 == 0) {
            $('#facebox').show();
        } else {
            $('#facebox').hide();
        }
        i++
    });

    $('.form_b').on('click', '#facebox img', function () {
        $('#saytext').append($(this).clone());
    });

    //表情包end


//    点击添加话题start
    $('.mus_tb+a').click(function (e) {
        $('#saytext').html("<a href=''>#在这里输入你想要说的话题#</a>");
        e.stopPropagation();
    });
//    点击添加话题end

    $('.btn_mask~i').click(function () {
        $('#file2').click();
    });


    //实时监听输入框的值start
    $('.form_b #saytext').keydown(function () {

        if ($(this).html() != '') {
            $('.btn_mask').hide();
        } else {
            $('.btn_mask').show();
        }

        $('.font_num').html($(this).attr('maxlength') - $(this).html().length)
    });

    //实时监听输入框的值end

//    ajax提交表单start
    $('.form_b input[type=button]').click(function () {
        if ($('.form_b #saytext').html().length <= 400) {
            con = $('.form_b #saytext').html();
            if ($('.uploaditem div').length) {
                sou = $('.uploaditem div').html();
            } else {
                sou = '';
            }
            $('.mask').hide();
            $('.source_show').hide();
            $.ajax({
                url: sayinsert,
                type: "post",
                data: {content: con, source: sou},
                success: function (data) {
                    if (data == 'no') {
                        $('.Publish_box .tip').html('请先登录').show();
                        T = setTimeout(function () {
                            $('.Publish_box .tip').hide()
                        }, 2000)
                    } else {
                        $('.Publish_box .tip').html('发表成功').show();
                        $('.form_b textarea').val('');
                        $('.form_b .source_show').html('');
                        $('.says_box').prepend(data);
                        $('.form_b').hide();
                        $('.form_a').show();
                        $('.btn_mask').show();
                        T = setTimeout(function () {
                            $('.Publish_box .tip').hide()
                        }, 2000)
                    }
                }
            });
        } else {
            $('.Publish_box .tip').html('发表字符数不能超过400个').show();
            T = setTimeout(function () {
                $('.Publish_box .tip').hide()
            }, 2000)
        }
        return false;
    });
//    ajax提交表单end


//    表单切换特效start
    $('.form_a input').focus(function () {
        $(this).closest('form').hide();
        $('.form_b').show();
    });
    $(document).click(function () {
        $('.form_b').hide();
        $('.form_a').show();
        $('.modal').hide();
    });
    $('.Publish_box').click(function (e) {
        e.stopPropagation();
    });
////    表单切换特效end

//    滑到底部加载更多动态
    $(window).scroll(function () {
        //可视区域的高（注意是当前可以看见的区域）加上滚动的高等于文档总高度时说明滚动到了底部
        if ($(this).scrollTop() + $(this).height() == $(document).height()) {
            ind = $('.says_box>.sat_item').size() - 1;
            $.ajax({
                url: getmoresay,
                type: "post",
                data: {index: ind},
                success: function (data) {
                    $('.says_box').append(data);
                }
            })
        }
    });

//      回复框特效start
    $(document).on('click', '.replay_tb', function (e) {
        $('.replay_box').attr('src', replaybox + '/id/' + $(this).attr('vid')).show();
        $('body').css({'overflow': 'hidden', 'height': '100%'});
        e.stopPropagation();
    });

    $(document).on('click', '.sat_item', function (e) {
        $('.replay_box').attr('src', replaybox + '/id/' + $(this).find('.replay_tb').attr('vid')).show();
        $('body').css({'overflow': 'hidden', 'height': '100%'});
        e.stopPropagation();
    });


    $(document).on('click', '.forward', function (e) {
        $('.replay_box').attr('src', replaybox + '/id/' + $(this).attr('vid')).show();
        $('body').css({'overflow': 'hidden', 'height': '100%'});
        e.stopPropagation();
    });

//     回复框特效end

//     转发动态start
    $(document).on('click','.share_tb', function (e) {
        $('.modal').show();
        $('.share_box').show();
        if ($(this).parent().prev('.forward').html() == undefined) {
            obj = $(this).closest('.sat_item').clone();
            obj.attr('vid', obj.find('.opt .replay_tb').attr('vid'));
            obj.removeClass('sat_item');
            obj.addClass('sat_item_b');
            obj.find('.opt').remove();
        }else{
            obj = $(this).parent().prev('.forward').clone();
        }
        $('.share_con').html(obj);
        e.stopPropagation();
    });

    $('.share_box').click(function (e) {
        e.stopPropagation();
    });

    $(document).click(function () {
        $('.modal').hide();
        $('.share_box').hide();
    });

    $('.share_comm .expression').qqFace({

        id: 'facebox1',

        assign: 'saytext1',

        path: '/jin/Home/Tpl/Public/Js/jQuery-qqFace933020160323/qqFace/arclist/'
    });
    i1 = 0;
    $('.share_comm .expression').click(function () {
        if (i1 % 2 == 0) {
            $('#facebox1').show();
        } else {
            $('#facebox1').hide();
        }
        i1++
    });

    $('.share_box').on('click', '#facebox1 img', function () {
        $('#saytext1').append($(this).clone());
    });

    $('.share_con+div button').click(function () {
        con = $('#saytext1').html();
        if($('.share_con').find('.sat_item_b').attr('vid')!=undefined){
            fid = $('.share_con').find('.sat_item_b').attr('vid');
        }else{
            fid= $('.share_con').find('.forward').attr('vid');
        }
        $.ajax({
            url: sayinsert,
            type: "post",
            data: {content: con, forward: fid},
            success: function (data) {
                if (data == 'no') {
                    $('.tip').html('请先登录').show();
                    T = setTimeout(function () {
                        $('.tip').hide();
                    }, 2000)
                }else{
                    $('.says_box').prepend(data);
                    $('.modal').hide();
                    $('.share_box').hide();

                }
            }
        });
    });
//转发动态end

});
