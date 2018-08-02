/**
 * Created by Administrator on 2017/4/1.
 */
$(function () {

//      登录框特效start
    $('.log_btn').click(function (e) {
        $('.modal').show();
        $('.login').show();
        e.stopPropagation();
    });
    $('.modal').click(function () {
        $(this).hide();
        $('.login').hide();
    });
    $('.login').click(function(e){
        e.stopPropagation();
    });
//      登录框特效end

//      表单验证start
    $('.login form').validate({

        //验证规则
        rules: {
            user: {
                required: true
            },
            password: {
                required: true
            }
        },
//       设置错误提示
        messages: {
            user: {
                required: "请输入用户名"
            },
            password: {
                required: "密码不能为空"
            }
        },

//    错误信息放置位置,error指错误信息，element指当前发生错误的input
        errorPlacement: function (error, element) {
            $(element).parent().next().append(error);
        },

//    input发生错时误执行的行为,element指当前发生错误的input,可以让其边框变为红色
        highlight: function (element) {
            $(element).css({'border': '1px solid red'});
            $(element).parent().next().css({'color': 'red'})
        },
//    input验证通过时执行的行为,element指当前验证通过的input，可以让其边框变回原来的颜色
        unhighlight: function (element) {
            $(element).css({'border': '1px solid green'});
        },
        submitHandler: function () {
            $.ajax({
                url: check,
                type: "post",
                data: $('.login form').serialize(),
                success: function (data) {
                    if (data != 1) {
                        $('.modal').show();
                        $('.login').show();
                        $('.backerror').html(data);

                    } else {
                        location.reload();
                    }
                }
            });
        }
    });
//    表单验证end


});