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

    var main_schedule = null;

    //Load the main schedule
    $.ajax({
        method: 'POST',
        url: controllerURL + '/load',
        success: function(output) {
            main_schedule = JSON.parse(output);
            drawSchedule(MySchedule, main_schedule);
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
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

    var num_time_pref = 0;
    $time_pref_div = $('.scheduler-pref-time');
    updateTimePref($time_pref_div, num_time_pref);

    /**
     * Time Preferences and Modal
     *
     * + Time blocks should be tagged in the server so it could know which time block to remove from the scheduler object.
     */
    $(document).on('click', '.remove-time-block',function(){
        $(this).remove();

        //TODO: remove preference from scheduler object in cookie
        num_time_pref--;
        updateTimePref($time_pref_div, num_time_pref);
    });

    $('.time_add').click(function(){
        var is_complete = true;
        $time_pref_div.append('<p class="remove-time-block">'
            + '<i class="glyphicon glyphicon-ban-circle fix-icon"></i> Monday: 9:00am to 10:00am</p>');

        num_time_pref++;
        updateTimePref($time_pref_div, num_time_pref);

        /* TODO: valid the preference by sending to server and adding preference to scheduler object
         * + The server should send back a confirmation to if the preference is valid.
         *      + Success or failure bool
         *      + Should come with a tag identifier of this preference 'hash code'
         */

        if(!is_complete)
        {
            //TODO: If server response is not valid. Display error message.
        }

        if (is_complete)
        {
            $('#scheduler-pref-modal').modal({show: false});

            //TODO: Incollapse the time preference to show the user he has added.

            //TODO: Add message of success!
            //TODO: Empty inputs
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

    //Auto Pick
    $auto_pick_btn = $('.auto-pick');
    $auto_pick_btn.click(function(){
        alert('Do something');
    });

    //Generate Schedule
    $generate_btn = $('.generate');
    $generate_div = $('.generated-schedules');

    var generated_schedules;
    $generate_btn.click(function(){
        $.ajax({
            method: 'POST',
            url: controllerURL + '/generate',
            success: function(output){
                generated_schedules = JSON.parse(output);
                console.log("Found " + generated_schedules.length + " results!");

                $generate_div.empty();
                for(var i in generated_schedules)
                {
                    $generate_div.append('' +
                        '<div class="list-group-item scheduler-list-item generated" data-schedule-index="'
                        + i
                        +'">Schedule #' + (parseInt(i) + 1) + '</div>');
                }
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    var curr_schdle_index = -1;

    $(document).on('click', '.generated',function(){
        var index = $(this).data('scheduleIndex');
        curr_schdle_index = index;
        drawSchedule(MySchedule, generated_schedules[index]);
    });

    $(document).on("keyup", function(e) {
        var key = e.which;
        if (key == 39) { //Key or Right
            if(curr_schdle_index != generated_schedules - 1){
                curr_schdle_index++;
                drawSchedule(MySchedule, generated_schedules[curr_schdle_index]);
            }
        } else if (key == 37) { //Key or Left
            if(curr_schdle_index != -1){
                curr_schdle_index--;
                drawSchedule(MySchedule, generated_schedules[curr_schdle_index]);
            }
        }
    });

    //Commit Schedule
    $commit_btn = $('.scheduler-commit');
    $commit_btn.click(function(){
        alert('Do something');
    });

});

function updateTimePref($prefcontainer, num_time_pref)
{
    if(num_time_pref == 0)
        $prefcontainer.append('<p class="no-blocks">No Time Preferences!</p>');
    else
        $('.no-blocks').remove();
}

function drawSchedule(scheduleController, scheduleData)
{
    console.log(scheduleData);
    scheduleController.emptyBlocks();

    //Loop through every section
    for (var i in scheduleData['sections'])
    {
        var section = scheduleData['sections'][i];

        if(section['lecture'] != null)
        {
            for(var j in section['lecture'])
            {
                var start = section['lecture'][j]['start'];
                var end = section['lecture'][j]['end'];

                var title = section['course_subject'] + ' ' + section['course_number'];
                title += '<br>' + 'LECT ' + section['letter']
                    + '<br>' + start + ' - ' + end
                    + '<br>' + section['lecture'][j]['room'];

                scheduleController.addBlock(title, start, end, section['lecture'][j]['weekday'])
            }
        }
        if(section['tutorial'] != null)
        {
            var start = section['tutorial']['start'];
            var end = section['tutorial']['end'];

            var title = section['course_subject'] + ' ' + section['course_number'];
            title += '<br>' + 'TUT ' + section['tutorial']['letter']
                + '<br>' + start + ' - ' + end
                + '<br>' + section['tutorial']['room'];

            scheduleController.addBlock(title, start, end, section['tutorial']['weekday'])
        }
        if(section['laboratory'] != null)
        {
            var start = section['laboratory']['start'];
            var end = section['laboratory']['end'];

            var title = section['course_subject'] + ' ' + section['course_number'];
            title += '<br>' + 'LAB ' + section['laboratory']['letter']
                + '<br>' + start + ' - ' + end
                + '<br>' + section['laboratory']['room'];

            scheduleController.addBlock(title, start, end, section['laboratory']['weekday'])
        }
    }
    //Render schedule
    scheduleController.render();
}
