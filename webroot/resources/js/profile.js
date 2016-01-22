/**
 * Created by TheChosenOne on 2016-01-22.
 */
$(function(){
    $('.semester-title').click(function(){
        $('.semester-data-active').removeClass('semester-data-active');
        $(this).next().addClass('semester-data-active');
    });
});