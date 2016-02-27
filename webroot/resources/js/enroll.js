//Globals

var schedule_container = document.getElementById('schedule-div');
var schedule_title = document.getElementById('schedule-name');
var schedule_panel = document.getElementById('schedule-detail');

var undo_section_drop = [];

$(function() {
    //Scheduler config
    var controllerURL = $('#info-controller').data('controllerUrl');

    var main_schedule = null;

    //Load the main schedule
    load_main_schedule();

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

    //Schedule Generation
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

    //Remove Section
    $(document).on('click', '.drop-section', function(){
        var response = confirm('Are you sure you want to do this? You are fully responsible if sections renders full and will not re-register!');
        if(response){
            var hash = $(this).data('hashId');
            $.ajax({
                method: 'POST',
                url: controllerURL + '/drop',
                data: {input: hash},
                success: function (output) {
                    if(output == ''){
                        console.log('Failed at dropping section.');
                    }
                    else{
                        load_main_schedule();
                        console.log('Successfully dropped a section.')
                        undo_section_drop.push(output);
                    }
                    $('.schedule-undo-drop').show();
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
    });

    $('.schedule-undo-drop').click(function(){
        if(undo_section_drop.length != 0){
            var section = undo_section_drop.pop();
            $.ajax({
                method: 'POST',
                url: controllerURL + '/undo-drop',
                data: {input: section},
                success: function (output) {
                    load_main_schedule()
                    if(undo_section_drop.length == 0)
                        $('.schedule-undo-drop').hide();
                    console.log('Successfully undo drop section.');
                },
                error: function (xhr, status, error) {
                    undo_section_drop.push(section);
                    alert(xhr.responseText);
                }
            });
        }
    });

    $('.schedule-reset').click(function(){
        $.ajax({
            method: 'POST',
            url: controllerURL + '/reset',
            success: function (output){
                console.log(output);
                location.reload();
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    //TODO: create a function to empty generate schedules and set to main schedule
    function set_to_main_schedule(){

    }

    /**
     * Loads the main schedule on to the user interface.
     */
    function load_main_schedule(){
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
    }

});

/**
 * TODO: Updates the time preference UI
 * @param $prefcontainer
 * @param num_time_pref
 */
function updateTimePref($prefcontainer, num_time_pref) {
    if(num_time_pref == 0)
        $prefcontainer.append('<p class="no-blocks">No Time Preferences!</p>');
    else
        $('.no-blocks').remove();
}
