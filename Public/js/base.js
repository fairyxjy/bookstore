/*基础公共脚本*/
$(function(){
    // 导航滑过
    $('.type_show, .nav_b .list_title').mouseenter(function(){
        $('.f_type').show();
    });
    $('.type_show, .nav_b .list_title').mouseleave(function(){
        $('.s_type').hide();
        if($('.f_type').attr('webIndex') == 'true'){
            return;
        } else{
            $('.f_type').hide();
        }
    });
    $('.type_show .f_type>li').hover(function(){
        $(this).addClass('now');
        $('.s_type').hide();
        $(this).find('.s_type').show();
    }, function(){
        $(this).removeClass('now');
    });
});