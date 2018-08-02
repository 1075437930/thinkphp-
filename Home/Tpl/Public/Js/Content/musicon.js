/**
 * Created by Administrator on 2017/3/26.
 */
$(function(){


    $('#example-size-picker').on('click', 'li', function(){
        $('#example').attr('data-size', $(this).data('size'));
        clarity.manageLayout();
    });
});