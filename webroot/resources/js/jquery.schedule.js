/**************************************************************************
  ____       _              _       _
 / ___|  ___| |__   ___  __| |_   _| | ___ _ __
 \___ \ / __| '_ \ / _ \/ _` | | | | |/ _ \ '__|
 ___) | (__| | | |  __/ (_| | |_| | |  __/ |
 |____/ \___|_| |_|\___|\__,_|\__,_|_|\___|_|

 */
function WeeklySchedule(dom){

    this.dom = dom;

    this.tableAttr = [];

    this.timeBlocks = [];


    this.setTableProperties = function(property)
    {
        this.tableAttr = property;
    }

    this.addBlock = function(title, start, end, weekday)
    {
        this.timeBlocks.push({
                title: title,
                start: moment(start, 'HH:mm'),
                end: moment(end, 'HH:mm'),
                weekday: weekday
            }
        );
    }

    this.emptyTimeBlocks = function ()
    {
        this.timeBlocks = null;
        this.timeBlocks = [];
    }

    this.render = function()
    {
        this.dom.empty();

        /***************************************************************************
                        TABLE ATTRIBUTES
         ***************************************************************************/

        var tbl = '<table';

        for (var attr in this.tableAttr){
            tbl += ' ' + attr + '="' + this.tableAttr[attr] + '"';
        }
        tbl += '>';

        /***************************************************************************
                        WEEKDAYS
        ***************************************************************************/
        tbl += '<tr><td>Time</td>';
        for(var i = 0; i < 7; i++){ //
            tbl += '<td>' + moment(i, 'd').format('dddd') + '</td>'
        }
        tbl += '</tr>';

        /***************************************************************************
                        THE SCHEDULE
         ***************************************************************************/
        var start = moment('15:15', 'HH:mm');
        for(var row = 545; row <= 840; row += 15){ // starts at 8:45 to 14:00 increments by 15 mins
            tbl += '<tr>';
            for (var col = 0; col < 8; col++){
                if(col == 0){

                    //TIME
                    tbl += '<td>'+start.format('H:mm')+'</td>';
                }
                else{
                    //BLOCKS
                    tbl += '<td></td>';
                }
            }
            tbl += '</tr>';
        }

        tbl += '</table>';

        dom.append(tbl);
    }
}