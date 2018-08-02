/**
 *
 * @param preview   放置预览图的盒子
 * @param path    插件的路径
 */
function multipleimg(preview,path){
    $('#file2').change(function () {
        $.ajaxFileUpload({
            url: path+'uploadimg.php',
            secureuri: false,//是否启用安全机制
            fileElementId: 'file2',//file的id
            dataType: 'application/json',//返回的类型
            success: function (data) {//调用成功时怎么处理
                $(preview).show().html(data);

            }
        });

    });

    $('.form_b').on('click','.del', function () {
        $(this).next().val('');
        var obj = $(this);
        $(this).parent().remove();

        $.ajax({
            url: path+'delimg.php',
            type: "post",
            data: {path: obj.attr('dur')},
            success: function (data) {

            }
        });
    });

}