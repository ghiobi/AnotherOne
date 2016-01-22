/**
 * Created by TheChosenOne on 2016-01-22.
 */
$(function(){
    $('.semester-title').click(function(){
        var sound = new Audio('http://localhost:8000/resources/sound/cut.mp3');
        sound.play();
        if(!$(this).next().hasClass('semester-data-active')){
            $('.semester-data-active').slideUp(300).removeClass('semester-data-active');
            $(this).next().slideDown(300).addClass('semester-data-active');
        }
    });
});