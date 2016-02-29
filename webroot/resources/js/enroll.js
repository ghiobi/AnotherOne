//Globals

var schedule_container = document.getElementById('schedule-div');
var schedule_title = document.getElementById('schedule-name');
var schedule_panel = document.getElementById('schedule-detail');

var undo_drop_array = [];
var selected_schedule = -1;

$(function() {
    //Scheduler config
    var controllerURL = $('#info-controller').data('controllerUrl');

    var main_schedule = null;

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
    var $srch_input = $('#scheduler-search');
    $srch_input.autocomplete({
        source: function(request, response){
            $.getJSON( controllerURL + '/search-list/',
                function(data){
                    response($.ui.autocomplete.filter(data, request.term));
                });
        },
        minLength: 2,
        select: function(event, ui){
            var course = ui.item.hash;

            $.ajax({
                method: 'POST',
                url: controllerURL + '/add-course',
                data: {input: course},
                success: function (output) {
                    if(output != ''){
                        console.log(output);
                    }
                    else{
                        load_interface();
                    }
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });

            $srch_input.val('');
            return false;
        }
    });
    /*$srch_input.keyup(function () {
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
    });*/

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
        clear_to_main_schedule();
        $.getJSON(
            controllerURL + '/generate',
            function (output) {
                console.log("Generator found " + output.length + " results!");
                for (var i in output) {
                    var name = 'Schedule #' + (parseInt(i) + 1);
                    $generate_div.append('' +
                        '<div class="list-group-item scheduler-list-item schedule" data-schedule-index="'
                        + i + '">'
                        + name + '</div>');

                    generated_schedules.push(
                        new Schedule(schedule_container, schedule_title, schedule_panel,name, output[i][0], output[i][1])
                    );
                }
            }
        );
    });

    $(document).on('click', '.schedule', function () {
        $('.scheduler-selected').removeClass('scheduler-selected');
        $(this).addClass('scheduler-selected');
        if($(this).hasClass('main-schedule')) {
            selected_schedule = -1;
            main_schedule.render();
        }
        else {
            var index = $(this).data('scheduleIndex');
            selected_schedule = index;
            generated_schedules[index].render();
        }
    });

    $(document).on("keydown", function (e) {
        var key = e.which;
        if (key == 39) { //Right Key
            if (selected_schedule < generated_schedules.length - 1) {
                selected_schedule++;
                $('.scheduler-selected').removeClass('scheduler-selected');
                $('.generated-schedules .schedule:nth-child(' + (selected_schedule + 1) + ')').addClass('scheduler-selected');
                generated_schedules[selected_schedule].render();
            }
        } else if (key == 37) {//Left Key
            if (selected_schedule > -1) {
                selected_schedule--;
                if(selected_schedule == -1) {
                    $('.scheduler-selected').removeClass('scheduler-selected');
                    $('.main-schedule').addClass('scheduler-selected');
                    main_schedule.render();
                }
                else {
                    $('.scheduler-selected').removeClass('scheduler-selected');
                    $('.generated-schedules .schedule:nth-child(' + (selected_schedule + 1) + ')').addClass('scheduler-selected');
                    generated_schedules[selected_schedule].render();
                }
            }
        }
    });

    //Commit Schedule //TODO: Confirmation dialogue box
    $commit_btn = $('.scheduler-commit');
    $commit_btn.click(function () {
        if(selected_schedule != -1){
            var new_schedule = generated_schedules[selected_schedule].object;
            $.ajax({
                method: 'POST',
                url: controllerURL + '/commit',
                data: {input: new_schedule},
                success: function (output) {
                    if(output == ''){
                        console.log('Failed at committing new schedule.');
                    }
                    else{
                        load_interface();
                        //Clear undo button
                        undo_drop_array = [];
                        $('.schedule-undo-drop').hide();

                        console.log('Successfully committed new section.');
                    }
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
    });

    //Remove Section
    $undo_btn = $('.schedule-undo-drop');
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
                        load_interface();
                        console.log('Successfully dropped a section.')
                        undo_drop_array.push(output);
                    }
                    $undo_btn.show();
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
    });

    $undo_btn.click(function(){
        if(undo_drop_array.length != 0){
            clear_to_main_schedule();
            var section = undo_drop_array.pop();
            $.ajax({
                method: 'POST',
                url: controllerURL + '/undo-drop',
                data: {input: section},
                success: function (output) {
                    load_interface();
                    if(undo_drop_array.length == 0)
                        $undo_btn.hide();
                    console.log('Successfully undo drop section.');
                },
                error: function (xhr, status, error) {
                    undo_drop_array.push(section);
                    alert(xhr.responseText);
                }
            });
        }
    });

    $('.schedule-reset').click(function(){
        $.ajax({
            method: 'POST',
            url: controllerURL + '/reset',
            success: function(){
                location.reload();
            }
        });
    });

    function load_interface(){
        load_main_schedule();
        clear_to_main_schedule();
        get_course_list();
    }

    /**
     * Clears generated schedules and switches to main schedule
     */
    function clear_to_main_schedule(){
        //Switch to main schedule.
        if(selected_schedule != -1){
            main_schedule.render();
            selected_schedule = -1;
        }

        //Empty generated schedules
        $generate_div.empty();
        generated_schedules = [];
    }

    var $reg_div = $('#scheduler-reg-course');
    var $unreg_div = $('#scheduler-unreg-course');
    function get_course_list(){ //TODO: display no course to display info message
        $.getJSON(controllerURL + '/course-list',
            function(course){
                $reg_div.empty();
                for(var key in course['registered']){
                    $reg_div.append('<div class="list-group-item scheduler-list-item">'+course['registered'][key]+'</div>');
                }
                $unreg_div.empty();
                for(var key in course['unregistered']){
                    $reg_div.append('<div class="list-group-item list-group-item-warning scheduler-list-item">'+key+'<span class="badge">'+course['unregistered'][key]+'</span></div>');
                }
            }
        );
    }
    /**
     * Loads the main schedule on to the user interface.
     */
    function load_main_schedule(){
        $.getJSON( controllerURL + '/load',
            function (schedule) {
                main_schedule = new Schedule(schedule_container, schedule_title, schedule_panel, 'CURRENT SCHEDULE', schedule, null);
                main_schedule.render();
                selected_schedule = -1;
            }
        );
    }

    load_interface();

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
