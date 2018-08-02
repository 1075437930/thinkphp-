/**
 * Created by Administrator on 2017/3/15.
 */
$(function(){
    $('.bot').click(function(){
        $(this).next().show();
        $('.bot').not($(this)).next().hide();
    });

    $('iframe').load(function(){
        $('.bot').each(function(){
            if($(this).attr('classid')==$("iframe").contents().find(".wh").attr('classid')){
                $(this).next().show();
            }
        });
    });
});