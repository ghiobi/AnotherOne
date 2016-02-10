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
     * @param $time
     * @param $start_time
     * @param $end_time
     * @param $weekday
     */
    public function __construct($room, $time, $start_time, $end_time, $weekday)
    {
        parent::__construct($start_time, $end_time, $weekday);
        $this->room = $room;
        $this->time = $time;
    }


    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
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