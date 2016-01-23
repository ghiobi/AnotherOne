$(function()
{
    //User Interface
    var $srch_ctnr = $('.scheduler-search');
    var $srch_cover = $('#scheduler-search-cover');
    var $srch_input = $('#scheduler-search-input');

    $srch_ctnr.mouseenter(function(){
        $srch_cover.slideUp(100);
        $srch_input.slideDown(100).select();
    });
    $srch_ctnr.mouseleave(function(){
        $srch_cover.slideDown(100);
        $srch_input.slideUp(100);
    });

    //Scheduler
    var controllerURL = $('#info-controller').data('controllerUrl');

    //Search
    $srch_input.keyup(function()
    {
        $.ajax({
            method: 'POST',
            url: controllerURL + '/ajax_search_course',
            data: {input: $srch_input.val()},
            success: function(output){
                console.log(output);
            }
        });
    });

});