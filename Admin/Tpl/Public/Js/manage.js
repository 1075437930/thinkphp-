/**
 * Created by Administrator on 2017/3/14.
 */
$(function(){
    //点击全选,$('.all')是全选按钮
    var i=0;
    $('.all').click(function(){
        if(i%2==0){
            $('input[type=checkbox]').prop('checked',true)
        }else{
            $('input[type=checkbox]').prop('checked',false);
        }
        i++;
    });

    //批量删除，$('.delall')是删除按钮
    $('.delall').click(function(){
        m=0;
        $('input[type=checkbox]').each(function(){
            if($(this).prop('checked')==true){
               m++;
            }
        });
        if(m){
            str='';
            $('input[type=checkbox]').each(function(){
                if($(this).prop('checked')==true) {
                    //把复选框所在的记录的id存入复选框的uid属性
                    str += $(this).attr('uid') + ',';
                }
            });
            str=str.substring(0,str.length-1);
            if(window.confirm('确定删除吗？')){
                $.ajax({
                    //dele是在引用此js文件的页面进行定义的，也就是处理批量删除的页面,var dele="<{:U('delete')}>";
                    url:dele,
                    type:"get",
                    data:{all:str},
                    success:function(data){
                       alert(data);
                       location=''
                    }
                })
            }
        }else{
            alert('请选择')
        }
    });
});