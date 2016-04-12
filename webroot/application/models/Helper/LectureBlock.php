<?php
namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Lecture holds data of lecture section
 *
 * @package Scheduler
 */
class LectureBlock extends RoomBlock
{

    /**
     * LectureBlock constructor.
     * @param $id
     * @param $room
     * @param $start
     * @param $end_time
     * @param $weekday
     */
    public function __construct($id, $room, $start, $end_time, $weekday)
    {
        parent::__construct($id, $room, $start, $end_time, $weekday);
    }


}