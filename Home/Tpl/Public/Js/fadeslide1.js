/**
 * 淡入淡出幻灯片函数,这个虽然参数多，但是一个页面上可以用多次而互不干扰
 * @param maindiv  最外层盒子的类名
 * @param imgli    图片选择器
 * @param pagediv  页码栏盒子（ul）的类名
 * @param pageli   页码选择器（li）
 * @param k        添加页码用的for循环变量名 ,随便取名，只要不一样就行
 * @param tal      页码初始样式的类名（这个类名不用加.）
 * @param now      页码被选中的样式的类名（这个类名不用加.）
 * @param i        计数器变量名,随便取名，只要不一样就行
 * @param T        定时器变量名 ,随便取名，只要不一样就行
 * @param siz      获取图片个数的变量名 ,随便取名，只要不一样就行
 * @param v        定时器的间隔时间，这个要传具体的数值
 * @param left     左箭头的类名
 * @param right    右箭头的类名
 */
    function fadeslide1(maindiv,imgli,pagediv,pageli,k,tal,now,i,T,siz,v){
        siz = $(imgli).size();
        for (k = 1; k <= siz; k++) {
            $(pagediv).append("<li></li>");
            $(pageli).eq(k-1).addClass(tal);
        }
        i = 0;
        function move() {
            i++;
            if (i >= siz) {
                i = 0;
            }
            $(imgli).eq(i).fadeIn().siblings().fadeOut();
            $(pageli).eq(i).addClass(now).siblings().removeClass(now);
        }

        $(imgli).eq(0).show().siblings().hide();
        $(pageli).eq(0).addClass(now);
        T = setInterval(move, v);
        $(maindiv).hover(function () {
            clearInterval(T);
        }, function () {
            T = setInterval(move, v);
        })
        $(pageli).mouseenter(function () {
            inde = $(this).index(pageli);
            i = inde;
            $(imgli).eq(inde).fadeIn().siblings().fadeOut();
            $(pageli).eq(inde).addClass(now).siblings().removeClass(now);
        });
        //$(right).click(function () {
        //    move();
        //});
        //$(left).click(function () {
        //    i-=3;
        //    if (i < 0) {
        //        i = siz - 1;
        //    }
        //    $(imgli).eq(i).fadeIn().siblings().fadeOut();
        //    $(pageli).eq(i).addClass(now).siblings().removeClass(now);
        //})
    }
