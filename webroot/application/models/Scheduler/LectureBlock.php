<?php
namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Lecture
 * @package Scheduler
 */
class LectureBlock extends TimeBlock
{
    private $room;

    /**
     * LectureBlock constructor.
     * @param $room
     * @param $start_time
     * @param $end_time
     * @param $weekday
     */
    public function __construct($room, $start_time, $end_time, $weekday)
    {
        parent::__construct($start_time, $end_time, $weekday);
        $this->room = $room;
    }

    /**
     * @return mixed
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param mixed $room
     */
    public function setRoom($room)
    {
        $this->room = $room;
    }

}