/**
 * Created by Administrator on 2017/3/16.
 */
$(function(){
    var editor;
    var editor1;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[name="description"]', {
            resizeType : 1,
            allowPreviewEmoticons : false,
            allowImageUpload : false,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'link']
        });
        editor1 = K.create('textarea[name="content"]', {
            allowFileManager : true,
            resizeType : 0,
            height:300
        });

    });


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

    $('input[name=music]').change(function(){
        $('.showmusic').html($(this).val());
    })
    $('input[name=link]').change(function(){
        $('.showmusic').html($(this).val());
    })
});