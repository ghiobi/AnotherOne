/**************************************************************************
  ____       _              _       _
 / ___|  ___| |__   ___  __| |_   _| | ___
 \___ \ / __| '_ \ / _ \/ _` | | | | |/ _ \
 ___) | (__| | | |  __/ (_| | |_| | |  __/
 |____/ \___|_| |_|\___|\__,_|\__,_|_|\___|

 */

//TODO: comment
//TODO: optimize code
//TODO: when there is no schedule to display it must show: 'Nothing to display'
function Schedule(container, header, panel, name, json, object) { //TODO: add another parameter indicating it's a generated schedule to remove the drop button

    this.table_attr = {
        class: 'table table-bordered table-condensed',
        style: 'color: black'
    };

    this.formatTime = function(minutes){
        var hours = Math.floor(minutes / 60);
        var minutes = minutes % 60;

        minutes = (minutes < 10)? '0' + minutes : minutes;

        return hours + ':' + minutes;
    };

    this.toMinutes = function (time){
        var colon = time.indexOf(':');

        var hours = parseInt(time.substr(0, colon));
        var minutes = parseInt(time.substr(colon + 1));

        return hours * 60 + minutes;
    };
    
    this.addBlock = function (title, start, end, weekday, attr)
    {
        var start_index = this.toMinutes(start);

        //If the time block does not start with a multiple of the incrementation then do this
        if(start_index % this.inc != 0)
            start_index = start_index - (start_index % this.inc);

        //Insert time block
        this.cells[weekday + '-' + start_index] = {
            title: title,
            start: this.toMinutes(start),
            end: this.toMinutes(end),
            weekday: weekday,
            attr: attr
        }
    };

    this.getEarliestWeekday = function ()
    {
        var maxblock = null;

        for (var first in this.cells)
        {
            maxblock = this.cells[first];
            break;
        }
        for(var newtblock in this.cells)
        {
            if (this.cells[newtblock]['weekday'] > maxblock['weekday'])
                maxblock = this.cells[newtblock];
        }
        return maxblock['weekday'];
    };


    this.getLatestWeekday = function ()
    {
        var minblock = null;

        for (var first in this.cells)
        {
            minblock = this.cells[first];
            break;
        }

        for(var newtblock in this.cells)
        {
            if (this.cells[newtblock]['weekday'] < minblock['weekday'])
                minblock = this.cells[newtblock];
        }
        return minblock['weekday'];
    };

    //Set table dimension automatically by max and min time
    this.autoDimensions = function()
    {
        var minTime = null;
        var maxTime = null;

        //Getting first minimums and maximums.
        for (var key in this.cells)
        {
            minTime = this.cells[key]['start'];
            maxTime = this.cells[key]['end'];
            break;
        }

        //Comparing times to determine the maximum and minimum times.
        for (var key in this.cells){
            if(this.cells[key]['start'] < minTime)
                minTime = this.cells[key]['start'];
            if(this.cells[key]['end'] > maxTime)
                maxTime = this.cells[key]['end'];
        }

        if(minTime % this.inc != 0)
            minTime = minTime - (minTime % this.inc);
        if(maxTime % this.inc != 0)
            maxTime = maxTime - (maxTime % this.inc);

        //One row padding on the max time and min time.
        this.start_time = minTime - this.inc;
        this.end_time = maxTime + this.inc;
    };

    this.makeTable = function()
    {
        //Settings table dimensions automatically
        this.autoDimensions();

        //Drawing table
        var table = '<table';

        //Settings table attributes
        for (var attr in this.table_attr)
            table += ' ' + attr + '="' + this.table_attr[attr] + '"';
        table += '>';

        //Drawing weekday row starting with time
        table += '<tr><td>Time</td>';

        var weekDay = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        for (var i = this.start_week; i < this.end_week + 1; i++)
            table += '<td>' + weekDay[i] + '</td>';

        table += '</tr>';

        //Fill is a array to determine the empty blocks or occupied
        var fill = [];
        for (var r_time = this.start_time; r_time <= this.end_time; r_time += this.inc)
        {
            fill[r_time.toString()] = [];
            for (var week = this.start_week; week <= this.end_week; week++)
                fill[r_time.toString()][week.toString()] = false;
        }

        //Drawing the main schedule
        for (var r_time = this.start_time; r_time <= this.end_time; r_time += this.inc)
        {
            table += '<tr>';

            //Time column
            var time = this.formatTime(r_time);
            table += '<td>' + time + '</td>';

            for (var week = this.start_week; week <= this.end_week; week++)
            {
                //If block is not null then there is data
                var block = this.cells[week + '-' + r_time];
                if (block != null)
                {
                    //Occupying cell
                    fill[r_time.toString()][week.toString()] = true;

                    //Determining the rowspan of a cell
                    var diff =  block['end'] - block['start'];
                    var rowsp = Math.ceil(diff / this.inc);

                    //Cell Attributes
                    table += '<td';
                    for (var attr in block['attr'])
                        table += ' ' + attr + '="' + block['attr'][attr] + '"';
                    table += '" rowspan="' + rowsp + '">' + block['title'] + '</td>';

                    //Occupying the spaces
                    var f_top = r_time + ((rowsp) * this.inc);
                    for (var f_art = r_time + this.inc; f_art != f_top; f_art += this.inc)
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
    };

    this.render = function ()
    {
        //Emptying
        this.schedule_container.innerHTML = '';
        this.schedule_header.innerHTML = '';
        this.schedule_detail.innerHTML = '';

        //Insertion
        this.schedule_container.insertAdjacentHTML('beforeend', this.htmlTable);
        this.schedule_header.insertAdjacentHTML('beforeend', this.name);
        this.schedule_detail.insertAdjacentHTML('beforeend', this.details);
    };

    this.extract =  function ()
    {
        var JSON = this.JSON;
        //Loop through every section
        var details = "";

        for (var type in JSON)
        {
            var cell_attributes;
            if(type == 'sections')
                cell_attributes = {class: 'scheduler-cells registered'};
            else
                cell_attributes = {class: 'scheduler-cells unregistered'};

            for (var i in JSON[type])
            {
                var section = JSON[type][i];

                //TODO: Redesign the course details
                details += '<table class="table table-bordered table-condensed">';
                details += '<thead><tr><th>'+section['course_number']+'</th><th colspan="2">'+section['course_name']+'</th>' +
                    //TODO: what if hash is empty, meaning it's not a registered section?
                    '<th><button class="drop-section" data-hash-id="'+ section['hash'] +'">Drop Section</button></th></tr>' +

                    '<tr><th>Section</th><th>Instructor</th><th>Capacity</th><th>Room</th>' +

                    '<th>Start Time</th><th>End Time</th><th>Weekday</th></tr></thead>';

                if(section['lecture'] != null)
                {
                    details += '<tr><th colspan="7">Lectures</th></tr>';

                    for(var j in section['lecture'])
                    {
                        var start = section['lecture'][j]['start'];
                        var end = section['lecture'][j]['end'];

                        var title = section['course_subject'] + ' ' + section['course_number']
                            + '<br>' + 'LECT ' + section['letter']
                            + '<br>' + start + ' - ' + end
                            + '<br>' + section['lecture'][j]['room'];

                        this.addBlock(title, start, end, section['lecture'][j]['weekday'], cell_attributes);

                        details += '<tr><td colspan="3"></td><td>' + section['lecture'][j]['room']
                            + '</td><td>' + start + '</td><td>' + end + '</td><td>'
                            + section['lecture'][j]['weekday'] + '</td></tr>';
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

                    this.addBlock(title, start, end, section['tutorial']['weekday'], cell_attributes);

                    details += '<tr><th colspan="7">Tutorial</th></tr>';
                    details += '<tr><td>' + section['tutorial']['letter'] + '</td><td>'
                        + section['tutorial']['instructor'] + '</td><td>'
                        + section['tutorial']['capacity'] + '</td><td>'
                        + section['tutorial']['room'] + '</td><td>'
                        + start + '</td><td>' + end + '</td><td>'
                        + section['tutorial']['weekday'] + '</td></tr>';
                }
                if(section['laboratory'] != null)
                {
                    var start = section['laboratory']['start'];
                    var end = section['laboratory']['end'];

                    var title = section['course_subject'] + ' ' + section['course_number']
                        + '<br>' + 'LAB ' + section['laboratory']['letter']
                        + '<br>' + start + ' - ' + end
                        + '<br>' + section['laboratory']['room'];

                    this.addBlock(title, start, end, section['laboratory']['weekday'], cell_attributes);

                    details += '<tr><th colspan="7">Laboratory</th></tr>';
                    details += '<tr><td>' + section['laboratory']['letter'] + '</td><td>'
                        + section['laboratory']['instructor'] + '</td><td>'
                        + section['laboratory']['capacity'] + '</td><td>'
                        + section['laboratory']['room'] + '</td><td>'
                        + start + '</td><td>' + end + '</td><td>'
                        + section['laboratory']['weekday'] + '</td></tr>';
                }
                details += '</table>';
            }
        }

        return details;
    };

    this.inc = 15; //incrementation, 15 minutes.

    this.start_week = 1; //Monday to Friday
    this.end_week = 5;

    this.cells = [];

    this.schedule_container = container;
    this.schedule_header = header;
    this.schedule_detail = panel;

    this.JSON = json;
    this.object = object;
    this.name = name;

    this.details = this.extract();
    this.htmlTable = this.makeTable();
}