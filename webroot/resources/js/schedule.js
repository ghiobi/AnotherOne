/**************************************************************************
  ____       _              _       _
 / ___|  ___| |__   ___  __| |_   _| | ___ _ __
 \___ \ / __| '_ \ / _ \/ _` | | | | |/ _ \ '__|
 ___) | (__| | | |  __/ (_| | |_| | |  __/ |
 |____/ \___|_| |_|\___|\__,_|\__,_|_|\___|_|

 */
function WeeklySchedule(elm) {

    this.elm = elm;

    this.tattr = [];
	
	this.maxtime=moment('8:15', 'HH:mm');
	
	this.mintime=moment('20:00', 'HH:mm');
	
	this.sweek2 = 1; //weekday
    this.eweek2	= 5;
	

    this.tblocks = [];
    this.tblockattr = [];

    this.inc = 15; //minutes

    this.sweek = 1; //weekday
    this.eweek = 5;

    this.stime = moment('8:15', 'HH:mm');
    this.etime = moment('20:00', 'HH:mm');

    this.setTableAttr = function (prop) {
        this.tattr = prop;
    }

    this.setBlockAttr = function (prop) {
        this.tblockattr = prop;
    }

    this.addBlock = function (title, start, end, weekday) {
        this.tblocks[weekday + '-' + start] = {
            title: title,
            start: moment(start, 'HH:mm'),
            end: moment(end, 'HH:mm'),
            weekday: weekday
        }
    }

    this.emptyBlocks = function () {
        this.tblocks = null;
        this.tblocks = [];
    }



    this.getMaxblock = function () {

        var maxblock = null;

        for (var first in this.tblocks) {

            firstblock = this.tblocks[first];
            console.log("first");
            maxblock = firstblock;
            break;

        }


        for(var newtblock in this.tblocks)
        {

            if (this.tblocks[newtblock]['weekday'] > maxblock['weekday'])
            {
                console.log("bigger");
                maxblock = this.tblocks[newtblock];

            }


        }

        return maxblock['weekday'];


    }


//GET MIN BLOCK DAY IN DAYS


    this.getMinBlock = function () {

        var minblock = null;

        for (var first in this.tblocks) {

            firstblock = this.tblocks[first];
            console.log("first");
            minblock = firstblock;
            break;

        }


        for(var newtblock in this.tblocks)
        {

            if (this.tblocks[newtblock]['weekday'] < minblock['weekday'])
            {
                console.log("bigger");
                minblock = this.tblocks[newtblock];

            }


        }

        return minblock['weekday'];


    }

    //GET MIN BLOCK TIME IN HH:MM


    this.getMinBlocktime = function () {

        var minblocktime = null;

        for (var first in this.tblocks) {

            firstblock = this.tblocks[first];
            console.log("first");
            minblocktime = firstblock;
            break;

        }


        for(var newtblock in this.tblocks)
        {

            if (this.tblocks[newtblock]['start'] < minblocktime['start'])
            {
                console.log("bigger");
                minblocktime = this.tblocks[newtblock];

            }


        }

        return minblocktime['start'];


    }

//GET MAXIMUM BLOCK TIME IN HH:MM

    this.getMaxBlockTime = function () {

        var MaxBlockTime = null;

        for (var first in this.tblocks) {

            firstblock = this.tblocks[first];
            console.log("first");
            MaxBlockTime = firstblock;
            break;

        }


        for(var newtblock in this.tblocks)
        {

            if (this.tblocks[newtblock]['end'] > MaxBlockTime['end'])
            {
                console.log("end");
                MaxBlockTime = this.tblocks[newtblock];
                console.log('test');

            }


        }

        return MaxBlockTime['end'].format('H:mm');


    }

    this.render = function () {

        this.elm.innerHTML = '';

        /***************************************************************************
         TABLE ATTRIBUTES
         ***************************************************************************/
        var table = '<table';

        for (var attr in this.tattr) {

            table += ' ' + attr + '="' + this.tattr[attr] + '"';

        }

        table += '>';

        /***************************************************************************
         WEEKDAYS
         ***************************************************************************/
        table += '<tr><td>Time</td>';

        for (var i = this.getMinBlock(); i < this.getMaxBlockTime() + 1; i++) {

            table += '<td>' + moment(i, 'd').format('dddd') + '</td>';

        }
        table += '</tr>';

        /***************************************************************************
         THE SCHEDULE
         ***************************************************************************/

        var fill = [];
        for (var r_time = this.stime.clone(); r_time.diff(this.etime) != 0; r_time.add(this.inc, 'm')) {

            fill[r_time.format('H:mm')] = [];

            for (var week = this.sweek; week <= this.eweek; week++) {
                fill[r_time.format('H:mm')][week.toString()] = false;
            }

        }

        for (var r_time = this.getMinBlocktime(); r_time.diff(this.etime) != 0; r_time.add(this.inc, 'm')) {

            table += '<tr>';

            var time = r_time.format('H:mm');

            table += '<td>' + time + '</td>';

            for (var week = this.sweek; week <= this.eweek; week++) {

                var block = this.tblocks[week + '-' + time];

                if (block != null) {

                    if(fill[time][week.toString()])
                        throw new DOMException();

                    fill[time][week.toString()] = true;

                    var diff = block['end'].diff(block['start'], 'm');

                    var rowsp = Math.ceil(diff / this.inc);

                    table += '<td';

                    for (var attr in this.tblockattr) {

                        table += ' ' + attr + '="' + this.tblockattr[attr] + '"';

                    }

                    table += '" rowspan="' + rowsp + '">' + block['title'] + '</td>';

                    var f_art = r_time.clone().add(this.inc, 'm');
                    var f_top = r_time.clone().add((rowsp - 1) * this.inc, 'm');

                    for (f_art; f_art.diff(f_top) <= 0; f_art.add(this.inc, 'm')) {
                        fill[f_art.format('H:mm')][week.toString()] = true;
                    }

                    continue;
                }
                if (!fill[time][week.toString()]) {
                    table += '<td></td>';
                }
            }
            table += '</tr>';
        }

        table += '</table>';

        elm.insertAdjacentHTML('beforeend', table);
    }
}