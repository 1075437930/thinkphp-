/**
 * Created by Administrator on 2017/3/22.
 */
$(function(){
    $('.wrap_aside li a').each(function(){
        if(sign==$(this).attr('sign')){
            $(this).addClass('selected');
        }else if(sign==''){
            $('.wrap_aside li a').eq(0).addClass('selected');
        }
    });
    function RandomNumBoth(Min,Max){
        var Range = Max - Min;
        var Rand = Math.random();
        var num = Min + Math.round(Rand * Range); //四舍五入
        return num;
    }

    $('.change').click(function(){
        count=$('.box').attr('num')-5;
        inde=RandomNumBoth(0,count);
        $.ajax({
            url:URL,
            type:"get",
            data:{index:inde},
            success:function(data){
               $('.box').html(data);
           }
        });
    });

//    专题幻灯片start
    $('.special ul li').eq(0).show();
    $('.special ul li').eq(1).show();
    $('.special ul li').eq(2).show();

//    专题幻灯片end
});
