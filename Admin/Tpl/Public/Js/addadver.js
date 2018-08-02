/**
 * Created by Administrator on 2017/3/20.
 */
$(function(){
$('form').submit(function(){
    str='';
    $('input[type=checkbox]:checked').each(function(){
        if($(this).val()!='') {
            str += $(this).val() + '-'
        }
    });
    str=str.substring(0,str.length-1);
    $('input[name=position]').val(str);
});
});