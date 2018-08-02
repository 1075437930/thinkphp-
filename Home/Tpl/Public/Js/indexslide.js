$(function(){

	// 首页幻灯片start
		siz=$('.imgbox li').size();
		
		for(i=0;i<siz;i++){
			$('.num').append("<li></li>");
		}

		i=0;

		function move(){
			i++;
			if(i==siz){
				i=0;
			}

			$('.imgbox li').eq(i).fadeIn().siblings().fadeOut();

			$('.num li').eq(i).css({'background':'#D6A740'}).siblings().css({'background':'white'})
		}

		T=setInterval(move,2500);
		// 页码初始样式
		$('.imgbox li').eq(0).show().siblings().hide();
		$('.num li').eq(0).css({'background':'#D6A740'}).siblings().css({'background':'white'});

		$('.num li').mouseenter(function(){
			inde=$(this).index();
			i=inde;
			$('.imgbox li').eq(inde).show().siblings().hide();
		$('.num li').eq(inde).css({'background':'#D6A740'}).siblings().css({'background':'white'});
		})		

		$('.main').hover(function(){
			clearInterval(T);
		},function(){
			T=setInterval(move,2500);
		})

		$('.btn-le').click(function(){
			i--;
			if(i<0){
				i=siz-1;
			}

			$('.imgbox li').eq(i).show().siblings().hide();
			$('.num li').eq(i).css({'background':'#D6A740'}).siblings().css({'background':'white'});	
		})

		$('.btn-ri').click(function(){
			move();
		})
	// 首页幻灯片end
})