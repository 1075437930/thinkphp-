/**
 * Created by Administrator on 2017/4/2 0002.
 */
$(function(){
    //      表单验证start
    $('.register_form').validate({
        //验证规则
        rules: {
            user: {
                required: true,
                rangelength:[6,10],
                //验证用户名是否已经存在
                remote:{
                    url:isset,
                    type:"post"
                }
            },
            password: {
                required: true,
                minlength:8
            },
            repassword:{
                equalTo:"#password"
            },
            email:{
                required: true,
                email:true
            }

        },
//       设置错误提示
        messages: {
            user: {
                required: "请输入用户名",
                rangelength:"用户名需在6~10个字符之间",
                remote:"用户名已经存在"
            },
            password: {
                required: "密码不能为空",
                minlength:"密码不能少于8位"
            },
            repassword:{
                equalTo:"两次密码输入不一致"
            },
            email:{
                required: "邮箱不能为空",
                email:"邮箱格式有误"
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
                url: hand,
                type: "post",
                data: $('.register_form').serialize(),
                success: function (data) {
                    if (data != 1) {
                        $('.backerror').html(data);
                    }else{
                        location=succ;
                    }
                }
            });
        }
    });
//    表单验证end

});