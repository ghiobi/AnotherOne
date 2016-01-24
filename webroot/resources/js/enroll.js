//Globals
var restricted_times = new Array();

$(function()
{
    $('#scheduler-pref-modal').modal({show:true});
    //Load cookies;

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

    //Time Preferences
    $('.pref_tb_add').click(function(){
        var is_complete = true;


        if (is_complete) {
            $('#scheduler-pref-modal').modal({show: false});
            return;
        }
        var temp = new TimeBlock(1, 10, 18);
        console.log('Added time preference: ' + temp.toString());
    });

    $('.pref_tb_remove').click(function(){

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

function TimeBlock(weekday, start, end){
    this.weekday = weekday;
    this.start = start;
    this.end = end;
    this.toString = function(){
        return "Weekday: " + this.weekday + " Start: " + this.start + " End: " + this.end;
    }
}