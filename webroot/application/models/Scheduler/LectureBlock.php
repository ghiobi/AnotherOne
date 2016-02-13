<?php
namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Lecture
 * @package Scheduler
 */
class LectureBlock extends Block
{

    /**
     * LectureBlock constructor.
     * @param $start_time
     * @param $end_time
     * @param $weekday
     */
    public function __construct($id, $room, $start_time, $end_time, $weekday)
    {
        parent::__construct($id, $room, $start_time, $end_time, $weekday);
    }


}