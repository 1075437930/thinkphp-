/**
 * Created by Administrator on 2017/3/26.
 */
$(function(){
    //鼠标移入频道图片特效start
    $('.disk').next().hide();
    $('.channel_img').hover(function(){
       $(this).find('.disk').animate({'left':'264px'});
       $(this).find('.disk').next().animate({'left':'224px','opacity':'1','display':'block'});
   },function(){
       $(this).find('.disk').animate({'left':'0px'});
       $(this).find('.disk').next().animate({'left':'100px','opacity':'0'});
   })
    //鼠标移入频道图片特效end
});