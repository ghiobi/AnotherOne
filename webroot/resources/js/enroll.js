//Globals

var schedule_container = document.getElementById('schedule-div');
var schedule_title = document.getElementById('schedule-name');
var schedule_panel = document.getElementById('schedule-detail');

$(function() {
    //Scheduler config
    var controllerURL = $('#info-controller').data('controllerUrl');

    var main_schedule = null;

    //Load the main schedule
    $.ajax({
        method: 'POST',
        url: controllerURL + '/load',
        success: function (output) {
            main_schedule = new Schedule(schedule_container, schedule_title, schedule_panel, 'CURRENT SCHEDULE', JSON.parse(output), null);
            main_schedule.render();
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });

    //User Interface
    var $srch_ctnr = $('.scheduler-search');
    var $srch_cover = $('#scheduler-search-cover');
    var $srch_input = $('#scheduler-search-input');

    $srch_ctnr.mouseenter(function () {
        $srch_cover.slideUp(100);
        $srch_input.slideDown(100);
    });
    $srch_ctnr.mouseleave(function () {
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
    $(document).on('click', '.remove-time-block', function () {
        $(this).remove();

        //TODO: remove preference from scheduler object in cookie
        num_time_pref--;
        updateTimePref($time_pref_div, num_time_pref);
    });

    $('.time_add').click(function () {
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

        if (!is_complete) {
            //TODO: If server response is not valid. Display error message.
        }

        if (is_complete) {
            $('#scheduler-pref-modal').modal({show: false});

            //TODO: Incollapse the time preference to show the user he has added.

            //TODO: Add message of success!
            //TODO: Empty inputs
        }
    });

    $('.time_interval').first().keyup(function () {
    });

    $('.time_remove').click(function () {
    });

    $('#time_all_day').change(function () {
        $('.time_interval').prop('disabled', !$('.time_interval').prop('disabled'));
    });


    //Search
    $srch_input.keyup(function () {
        var srch_val = $srch_input.val();

        if (srch_val.length > 1)
            $.ajax({
                method: 'POST',
                url: controllerURL + '/search',
                data: {input: srch_val},
                success: function (output) {
                    console.log(output);
                }
            });
    });

    //Auto Pick
    $auto_pick_btn = $('.auto-pick');
    $auto_pick_btn.click(function () {
        alert('Do something');
    });

    //ate Schedule
    $generate_btn = $('.generate');
    $generate_div = $('.generated-schedules');

    var generated_schedules = [];
    $generate_btn.click(function () {
        $.ajax({
            method: 'POST',
            url: controllerURL + '/generate',
            success: function (output) {
                var generated_data = JSON.parse(output);
                generated_schedules = [];

                console.log("GENERATOR: Found " + generated_data.length + " results!");

                $generate_div.empty();

                for (var i in generated_data) {
                    var name = 'Schedule #' + (parseInt(i) + 1);
                    $generate_div.append('' +
                        '<div class="list-group-item scheduler-list-item generated" data-schedule-index="'
                        + i + '">'
                        + name + '</div>');

                    generated_schedules.push(
                        new Schedule(schedule_container, schedule_title, schedule_panel,name, generated_data[i][0], generated_data[i][1])
                    );
                }

                console.log(generated_schedules);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    var curr_index = -1;

    $(document).on('click', '.generated', function () {
        var index = $(this).data('scheduleIndex');
        curr_index = index;
        generated_schedules[index].render();
    });

    $(document).on("keydown", function (e) {
        var key = e.which;
        if (key == 39) { //Key or Right
            if (curr_index < generated_schedules.length - 1) {
                curr_index++;
                generated_schedules[curr_index].render();
            }
        } else if (key == 37) { //Key or Left
            if (curr_index > -1) {
                if(curr_index == 0) {
                    curr_index--;
                    main_schedule.render();
                }
                else {
                    curr_index--;
                    generated_schedules[curr_index].render();
                }
            }
        }
    });

    //Commit Schedule
    $commit_btn = $('.scheduler-commit');
    $commit_btn.click(function () {
        alert('Do something');
    });


});

function updateTimePref($prefcontainer, num_time_pref) {
    if(num_time_pref == 0)
        $prefcontainer.append('<p class="no-blocks">No Time Preferences!</p>');
    else
        $('.no-blocks').remove();
}
