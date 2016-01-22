/**
 * Created by TheChosenOne on 2016-01-22.
 */
$(function(){
    $('.semester-title').click(function(){
        if(!$(this).next().hasClass('semester-data-active')){
            $('.semester-data-active').slideUp(200).removeClass('semester-data-active');
            $(this).next().slideDown(200).addClass('semester-data-active');
        }
    });
});