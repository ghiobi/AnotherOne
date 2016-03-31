/**************************************************************************
 ____       _              _       _
 / ___|  ___| |__   ___  __| |_   _| | ___
 \___ \ / __| '_ \ / _ \/ _` | | | | |/ _ \
 ___) | (__| | | |  __/ (_| | |_| | |  __/
 |____/ \___|_| |_|\___|\__,_|\__,_|_|\___|

 */

var Schedule = (function (){

    function Schedule(container, header, panel, name, json, object, generated) {

        this.schedule_container = container;
        this.schedule_header = header;
        this.schedule_detail = panel;
        this.generated = generated;

        this.json_data = json;
        this.object = object;
        this.name = name;

        var inc = 15; //incrementation, 15 minutes.
        var cells = [];

        var addBlock = function (title, start, end, weekday, attr)
        {
            var toMinutes = function (time){
                var colon = time.indexOf(':');

                var hours = parseInt(time.substr(0, colon));
                var minutes = parseInt(time.substr(colon + 1));

                return hours * 60 + minutes;
            };

            var start_index = toMinutes(start);

            //If the time block does not start with a multiple of the incrementation then do this
            if(start_index % inc != 0)
                start_index = start_index - (start_index % inc);

            //Insert time block
            cells[weekday + '-' + start_index] = {
                title: title,
                start: toMinutes(start),
                end: toMinutes(end),
                weekday: weekday,
                attr: attr
            }
        };

        var weekDay = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        var json_data = this.json_data;
        //Loop through every section
        var details = "";

        for (var type in json_data)
        {
            var cell_attributes;
            if(type == 'sections')
                cell_attributes = {class: 'scheduler-cells green'};
            else
                cell_attributes = {class: 'scheduler-cells yellow'};

            for (var i in json_data[type])
            {
                var section = json_data[type][i];

                details += '<table class="table table-bordered table-condensed ' +
                    ((type == 'sections')? '' : 'yellow') +
                    '">';
                details += '<thead><th>'+section['course_subject']+' '+ section['course_number']+'</th><th>' +
                    section['letter'] + '</th><th></th><th>' + section['instructor'] + '</th><th>' +section['capacity'] + '</th><th></th>' +

                    ((generated)?'<th></th>':'<th colspan="2"><button class="btn btn-danger btn-xs drop-section pull-right" data-hash-id="'+ section['hash'] +'"><i class="glyphicon glyphicon-trash fix-icon"></i> Drop</button></th>')+'</tr>' +
                    '</thead>';

                if(section['lecture'] != null)
                {

                    for(var j in section['lecture'])
                    {
                        var start = section['lecture'][j]['start'];
                        var end = section['lecture'][j]['end'];

                        var title = section['course_subject'] + ' ' + section['course_number']
                            + '<br>' + 'LECT ' + section['letter']
                            + '<br>' + start + ' - ' + end
                            + '<br>' + section['lecture'][j]['room'];

                        if(section['lecture'][j]['room'] != 'Online')
                            addBlock(title, start, end, section['lecture'][j]['weekday'], cell_attributes);

                        details += '<tr><td>LECT</td><td></td><td>'
                            + section['lecture'][j]['room'] + '</td><td></td><td></td><td>'
                            + start + ' - ' + end + '</td><td>'
                            + weekDay[section['lecture'][j]['weekday']] + '</td></tr>';
                    }
                }
                if(section['tutorial'] != null)
                {
                    var start = section['tutorial']['start'];
                    var end = section['tutorial']['end'];

                    var title = section['course_subject'] + ' ' + section['course_number']
                        + '<br>' + 'TUT ' + section['tutorial']['letter']
                        + '<br>' + start + ' - ' + end
                        + '<br>' + section['tutorial']['room'];

                    if(section['tutorial']['room'] != 'Online')
                        addBlock(title, start, end, section['tutorial']['weekday'], cell_attributes);

                    details += '<tr><td>TUT</td><td>'
                        + section['tutorial']['letter'] + '</td><td>'
                        + section['tutorial']['room'] + '</td><td>'
                        + section['tutorial']['instructor'] + '</td><td>'
                        + section['tutorial']['capacity'] + '</td><td>'
                        + start + ' - ' + end + '</td><td>'
                        + weekDay[section['tutorial']['weekday']] + '</td></tr>';
                }
                if(section['laboratory'] != null)
                {
                    var start = section['laboratory']['start'];
                    var end = section['laboratory']['end'];

                    var title = section['course_subject'] + ' ' + section['course_number']
                        + '<br>' + 'LAB ' + section['laboratory']['letter']
                        + '<br>' + start + ' - ' + end
                        + '<br>' + section['laboratory']['room'];

                    if(section['laboratory']['room'] != 'Online')
                        addBlock(title, start, end, section['laboratory']['weekday'], cell_attributes);

                    details += '<tr><td>LAB</td><td>'
                        + section['laboratory']['letter'] + '</td><td>'
                        + section['laboratory']['room'] + '</td><td>'
                        + section['laboratory']['instructor'] + '</td><td>'
                        + section['laboratory']['capacity'] + '</td><td>'
                        + start + ' - ' + end + '</td><td>'
                        + weekDay[section['laboratory']['weekday']] + '</td></tr>';
                }

                details += '</table>';
            }
        }


        this.details =  details;

        if(details.length == 0){
            var nodetails = '<div class="text-center" style="padding: 20px">No details. Start by adding courses to your list!</div>';
            this.details = nodetails;
        }

        this.htmlTable = (function() {

            if(Object.keys(cells).length == 0){
                var notable = '<div class="text-center" style="text-align: center; padding: 30px 0; color: black">No schedule to display. ):</div>';
                return notable;
            }

            var table_attr = {
                class: 'table table-bordered table-condensed',
                style: 'color: black'
            };

            var start_week = 1; //Monday to Friday
            var end_week = 5;

            //Settings table dimensions automatically
            var minTime = null;
            var maxTime = null;

            //Getting first minimums and maximums.
            for (var key in cells)
            {
                minTime = cells[key]['start'];
                maxTime = cells[key]['end'];
                break;
            }

            //Comparing times to determine the maximum and minimum times.
            for (var key in cells){
                if(cells[key]['start'] < minTime)
                    minTime = cells[key]['start'];
                if(cells[key]['end'] > maxTime)
                    maxTime = cells[key]['end'];
            }

            if(minTime % inc != 0)
                minTime = minTime - (minTime % inc);
            if(maxTime % inc != 0)
                maxTime = maxTime - (maxTime % inc);

            //One row padding on the max time and min time.
            var start_time = minTime - inc;
            var end_time = maxTime + inc;

            //Drawing table
            var table = '<table';

            //Settings table attributes
            for (var attr in table_attr)
                table += ' ' + attr + '="' + table_attr[attr] + '"';
            table += '>';

            //Drawing weekday row starting with time
            table += '<tr><td>Time</td>';

            var weekDay = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            for (var i = start_week; i < end_week + 1; i++)
                table += '<td>' + weekDay[i] + '</td>';

            table += '</tr>';

            //Fill is a array to determine the empty blocks or occupied
            var fill = [];
            for (var r_time = start_time; r_time <= end_time; r_time += inc)
            {
                fill[r_time.toString()] = [];
                for (var week = start_week; week <= end_week; week++)
                    fill[r_time.toString()][week.toString()] = false;
            }

            //Drawing the main schedule
            for (var r_time = start_time; r_time <= end_time; r_time += inc)
            {
                table += '<tr>';

                //Time column
                var hours = Math.floor(r_time / 60);
                var minutes = r_time % 60;

                minutes = (minutes < 10)? '0' + minutes : minutes;

                var time =  hours + ':' + minutes;

                table += '<td>' + time + '</td>';

                for (var week = start_week; week <= end_week; week++)
                {
                    //If block is not null then there is data
                    var block = cells[week + '-' + r_time];
                    if (block != null)
                    {
                        //Occupying cell
                        fill[r_time.toString()][week.toString()] = true;

                        //Determining the rowspan of a cell
                        var diff =  block['end'] - block['start'];
                        var rowsp = Math.ceil(diff / inc);

                        //Cell Attributes
                        table += '<td';
                        for (var attr in block['attr'])
                            table += ' ' + attr + '="' + block['attr'][attr] + '"';
                        table += '" rowspan="' + rowsp + '">' + block['title'] + '</td>';

                        //Occupying the spaces
                        var f_top = r_time + ((rowsp) * inc);
                        for (var f_art = r_time + inc; f_art != f_top; f_art += inc)
                            fill[f_art.toString()][week.toString()] = true

                        continue;
                    }
                    if (!fill[r_time.toString()][week.toString()])
                    {
                        table += '<td></td>';
                    }
                }
                table += '</tr>';
            }
            table += '</table>';
            return table;
        })();


    }

    Schedule.prototype.render = function(){
        //Emptying
        this.schedule_container.innerHTML = '';
        this.schedule_container.insertAdjacentHTML('beforeend', this.htmlTable);

        if(this.schedule_header != null){
            this.schedule_header.innerHTML = '';
            this.schedule_header.insertAdjacentHTML('beforeend', this.name);
        }

        if(this.schedule_detail != null){
            this.schedule_detail.innerHTML = '';
            this.schedule_detail.insertAdjacentHTML('beforeend', this.details);
        }
    };

    return Schedule;

})();

