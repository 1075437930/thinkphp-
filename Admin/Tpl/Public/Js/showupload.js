/**
 * Created by Administrator on 2017/3/13.
 */
$(window).load(function(){
    //实时显示上传图片
    $('input[type=file]').eq(0).change(function(){
        $(this).attr('name','img');
        if($(this).val()!='') {
            $('form').attr('action',upload).attr('target','uploadbox').submit();
            $('form').attr('action',ins).attr('target','');
            $(this).attr('name','');
        }
    });

    $('.view').attr("src",'');

    $('input[name=head]').val('');

    if($('.help').val()!=''){
        $('input[name=head]').val($('.help').val());
    }
});