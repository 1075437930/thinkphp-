/**
 * Created by Administrator on 2017/3/13.
 */
//实时显示时间特效
T = setInterval(function () {
    t = new Date();
    y = t.getFullYear();
    m = t.getMonth() + 1;
    d = t.getDate();
    h = t.getHours();
    min = t.getMinutes();
    s = t.getSeconds();
    $('.now').html('当前时间:' + y + '年' + m + '月' + d + '日' + ' ' + h + ':' + min + ':' + s);
});
$(function () {
    //侧边栏上下滑动特效
    $('.panel-collapse').hide();
    $('.contr').click(function () {
        $(this).closest('.panel-heading').next().slideToggle();
    });
    $('.panel-collapse').eq(0).show();

    //面包屑导航特效
    $('.list-group-item').click(function () {
        $('.module').html($(this).attr('module'))
        $('.action').html($(this).attr('action'))
        $('.Separator').show();
    });


});