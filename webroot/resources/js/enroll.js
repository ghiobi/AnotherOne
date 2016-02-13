//Globals
var restricted_times = new Array();

$(function()
{
    //Scheduler config
    var controllerURL = $('#info-controller').data('controllerUrl');

    var MySchedule = new WeeklySchedule(document.getElementById('mySchedule'));

    MySchedule.setTableAttr({
        class: 'table table-bordered table-condensed',
        style: 'color: black'
    });
    MySchedule.setBlockAttr({
        style: 'background-color: #00cc99; text-align:center; vertical-align:middle'
    });

    //Load
    var schedule = null;
    $.ajax({
        method: 'POST',
        url: controllerURL + '/load',
        success: function(output){
            schedule = JSON.parse(output);

            MySchedule.emptyBlocks();
            for (var i in schedule['sections'])
            {
                var section = schedule['sections'][i];

                if(section['lecture'] != null)
                {
                    for(var j in section['lecture'])
                    {
                        var start = section['lecture'][j]['start_time']['date'];
                        var end = section['lecture'][j]['end_time']['date'];

                        start = moment(start).format('H:mm');
                        end = moment(end).format('H:mm');

                        MySchedule.addBlock('Lecture', start, end, section['lecture'][j]['weekday'])
                    }
                }
                if(section['tutorial'] != null)
                {
                    var start = section['tutorial']['start_time']['date'];
                    var end = section['tutorial']['end_time']['date'];

                    start = moment(start).format('H:mm');
                    end = moment(end).format('H:mm');

                    MySchedule.addBlock('tutorial', start, end, section['tutorial']['weekday'])
                }
                console.log(section['laboratory']);
                if(section['laboratory'] != null)
                {
                    var start = section['laboratory']['start_time']['date'];
                    var end = section['laboratory']['end_time']['date'];

                    start = moment(start).format('H:mm');
                    end = moment(end).format('H:mm');

                    MySchedule.addBlock('laboratory', start, end, section['laboratory']['weekday'])
                }
            }
            MySchedule.render();
        }
    });

    //User Interface
    var $srch_ctnr = $('.scheduler-search');
    var $srch_cover = $('#scheduler-search-cover');
    var $srch_input = $('#scheduler-search-input');

    $srch_ctnr.mouseenter(function(){
        $srch_cover.slideUp(100);
        $srch_input.slideDown(100);
    });
    $srch_ctnr.mouseleave(function(){
        $srch_cover.slideDown(100);
        $srch_input.slideUp(100);
    });

    //Time Preferences and Modal
    $('.scheduler-pref-time').append(
        '<p class="remove-time-block"><i class="glyphicon glyphicon-ban-circle fix-icon"></i> Monday: 9:00am to 10:00am</p>'
    );
    $('.remove-time-block').click(function(){
        $parent = $('.remove-time-block').parent();
        if($parent.length == 0){
            $parent.append('<p class="no-blocks"></p>');
        }
    });
    $('.time_add').click(function(){
        var is_complete = true;

        if (!is_complete) {
            $('#scheduler-pref-modal').modal({show: false});
            return;
        }
    });

    $('.time_interval').first().keyup(function(){
    });

    $('.time_remove').click(function(){
    });

    $('#time_all_day').change(function()
    {
        $('.time_interval').prop('disabled', !$('.time_interval').prop('disabled'));
    });



    //Search
    $srch_input.keyup(function()
    {
        var srch_val = $srch_input.val();

        if(srch_val.length > 1)
            $.ajax({
                method: 'POST',
                url: controllerURL + '/search',
                data: {input: srch_val},
                success: function(output){
                    console.log(output);
                }
            });
    });


});