/**
 * Created by TheChosenOne on 2016-01-22.
 */
$(function(){
    $('.profile-semes-title').click(function(){
        var sound = new Audio('http://localhost:8000/resources/sound/cut.mp3');
        sound.play();
        if(!$(this).next().hasClass('profile-semester-active')){
            $('.profile-semester-active').removeClass('profile-semester-active');
            $(this).next().addClass('profile-semester-active');
        }
    });
});