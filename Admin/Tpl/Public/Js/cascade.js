/**
 * Created by Administrator on 2017/3/14.
 * 请求栏目下模型
 */
$(function(){
    $('select[name=father]').change(function(){
        obj=$(this);
        $.ajax({
            url:getmodel,
            type:"get",
            data:{id:obj.val()},
            success:function(data){
                $('select[name=model]').html(data)
            }
        })
    })
});