/**************************************************************************
  ____       _              _       _
 / ___|  ___| |__   ___  __| |_   _| | ___ _ __
 \___ \ / __| '_ \ / _ \/ _` | | | | |/ _ \ '__|
 ___) | (__| | | |  __/ (_| | |_| | |  __/ |
 |____/ \___|_| |_|\___|\__,_|\__,_|_|\___|_|

 */

function formatTime(minutes){
    var hours = Math.floor(minutes / 60);
    var minutes = minutes % 60;

    minutes = (minutes < 10)? '0' + minutes : minutes;

    return hours + ':' + minutes;
}

function toMinutes(time){
    var colon = time.indexOf(':');

    var hours = parseInt(time.substr(0, colon));
    var minutes = parseInt(time.substr(colon + 1));

    return hours * 60 + minutes;
}

function WeeklySchedule(elm) {

    this.elm = elm;

    this.tattr = []; //table attributes

    this.tblocks = []; //Time Blocks
    this.tblockattr = []; //Cell Attributes

    this.inc = 15; //incrementation, 15 minutes.

    this.sweek = 1; //default start weekday (Monday)
    this.eweek = 5;

    this.stime = toMinutes('8:30');
    this.etime = toMinutes('23:00');

    this.setTableAttr = function (prop)
    {
        this.tattr = prop;
    }

    this.setBlockAttr = function (prop)
    {
        this.tblockattr = prop;
    }

    this.addBlock = function (title, start, end, weekday)
    {
        var start_index = toMinutes(start);

        //If the time block does not start with a multiple of the incrementation then do this
        if(start_index % this.inc != 0)
            start_index = start_index - (start_index % this.inc);

        //Insert time block
        this.tblocks[weekday + '-' + start_index] = {
            title: title,
            start: toMinutes(start),
            end: toMinutes(end),
            weekday: weekday
        }
    }

    this.emptyBlocks = function ()
    {
        this.tblocks = [];
    }

    this.getEarliestWeekday = function ()
    {
        var maxblock = null;

        for (var first in this.tblocks)
        {
            maxblock = this.tblocks[first];
            break;
        }
        for(var newtblock in this.tblocks)
        {
            if (this.tblocks[newtblock]['weekday'] > maxblock['weekday'])
                maxblock = this.tblocks[newtblock];
        }
        return maxblock['weekday'];
    }


    this.getLatestWeekday = function ()
    {
        var minblock = null;

        for (var first in this.tblocks)
        {
            minblock = this.tblocks[first];
            break;
        }

        for(var newtblock in this.tblocks)
        {
            if (this.tblocks[newtblock]['weekday'] < minblock['weekday'])
                minblock = this.tblocks[newtblock];
        }
        return minblock['weekday'];
    }

    //Set table dimension automatically by max and min time
    this.autoDimensions = function()
    {
        var minTime = null;
        var maxTime = null;

        //Getting first minimums and maximums.
        for (var key in this.tblocks)
        {
            minTime = this.tblocks[key]['start'];
            maxTime = this.tblocks[key]['end'];
            break;
        }

        //Comparing times to determine the maximum and minimum times.
        for (var key in this.tblocks){
            if(this.tblocks[key]['start'] < minTime)
                minTime = this.tblocks[key]['start'];
            if(this.tblocks[key]['end'] > maxTime)
                maxTime = this.tblocks[key]['end'];
        }

        //One row padding on the max time and min time.
        this.stime = minTime - this.inc;
        this.etime = maxTime + this.inc;
    }

    this.render = function ()
    {
        //Settings table dimensions automatically
        this.autoDimensions();

        //Emptying inner HTML
        this.elm.innerHTML = '';

        //Drawing table
        var table = '<table';

        //Settings table attributes
        for (var attr in this.tattr)
            table += ' ' + attr + '="' + this.tattr[attr] + '"';
        table += '>';

        //Drawing weekday row starting with time
        table += '<tr><td>Time</td>';

        var weekDay = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        for (var i = this.sweek; i < this.eweek + 1; i++)
            table += '<td>' + weekDay[i] + '</td>';

        table += '</tr>';

        //Fill is a array to determine the empty blocks or occupied
        var fill = [];
        for (var r_time = this.stime; r_time <= this.etime; r_time += this.inc)
        {
            fill[r_time.toString()] = [];
            for (var week = this.sweek; week <= this.eweek; week++)
                fill[r_time.toString()][week.toString()] = false;
        }

        //Drawing the main schedule
        for (var r_time = this.stime; r_time <= this.etime; r_time += this.inc)
        {
            table += '<tr>';

            //Time column
            var time = formatTime(r_time);
            table += '<td>' + time + '</td>';

            for (var week = this.sweek; week <= this.eweek; week++)
            {
                //If block is not null then there is data
                var block = this.tblocks[week + '-' + r_time];
                if (block != null)
                {
                    //Occupying cell
                    fill[r_time.toString()][week.toString()] = true;

                    //Determining the rowspan of a cell
                    var diff =  block['end'] - block['start'];
                    var rowsp = Math.ceil(diff / this.inc);

                    //Cell Attributes
                    table += '<td';
                    for (var attr in this.tblockattr)
                        table += ' ' + attr + '="' + this.tblockattr[attr] + '"';
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

        //Inserting table into element
        elm.insertAdjacentHTML('beforeend', table);
    }

}