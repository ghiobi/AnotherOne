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
	
	this.sweek2 = 1; //weekday
    this.eweek2	= 5;
	

    this.tblocks = [];
    this.tblockattr = [];

    this.inc = 15; //minutes

    this.sweek = 1; //weekday
    this.eweek = 5;

    this.stime = moment('8:15', 'HH:mm');
    this.etime = moment('23:00', 'HH:mm');

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
	
	this.setStartTime=function()
	{
		//i have no idea what im doing
	 for (var r_time = this.stime.clone(); r_time.diff(this.etime) != 0; r_time.add(this.inc, 'm')) {
				var time = r_time.format('H:mm');

		             for (var week = this.sweek; week <= this.eweek; week++) { 
						 
						var block1 = this.tblocks[week + '-' + time];
						 if(block1 != null)
						if(mintime > block1['start'])
							mintime = block1['start'];

					
	 }
	 
	 
	 }
	 
	 return mintime;
		
		
	}
	
	
	this.setEndTime=function()
	{
		
		
		for (var r_time = this.stime.clone(); r_time.diff(this.etime) != 0; r_time.add(this.inc, 'm')) {
				var time = r_time.format('H:mm');

		             for (var week = this.sweek; week <= this.eweek; week++) { 
						 
						var block1 = this.tblocks[week + '-' + time];
						 if(block1 != null)
						if(maxtime < block1['end'])
							maxtime = block1['end'];

					
	 }
	 
	 
	 }
	 
	 return maxtime;
		
		
	}
	this.setStartWeekday=function()
	{
		
		
			
		for (var r_time = this.stime.clone(); r_time.diff(this.etime) != 0; r_time.add(this.inc, 'm')) {
				var time = r_time.format('H:mm');

		             for (var week = this.sweek; week <= this.eweek; week++) { 
						 
						var block1 = this.tblocks[week + '-' + time];
						 if(block1 != null)
						if( sweek2 > block1['weekday'])
							sweek2 = block1['weekday'];
		
		
	}
	}
	return sweek2;
	}
	this.setEndWeekday=function()
	{
		
		
			
		for (var r_time = this.stime.clone(); r_time.diff(this.etime) != 0; r_time.add(this.inc, 'm')) {
				var time = r_time.format('H:mm');

		             for (var week = this.sweek; week <= this.eweek; week++) { 
						 
						var block1 = this.tblocks[week + '-' + time];
						 if(block1 != null)
						if( eweek2 < block1['weekday'])
							eweek2 = block1['weekday'];
		
		
	}
	}
	return eweek2;
		
		
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

        for (var i = this.sweek; i < this.eweek + 1; i++) {

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

        for (var r_time = this.stime.clone(); r_time.diff(this.etime) != 0; r_time.add(this.inc, 'm')) {

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