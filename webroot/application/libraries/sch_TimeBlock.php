<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: TheChosenOne
 * Date: 2016-02-04
 * Time: 2:46 PM
 */
class sch_TimeBlock
{
    public $start_time;
    public $end_time;
    public $weekday;

    function __construct($start_time, $end_time, $weekday)
    {
        $this->start_time = new DateTime($start_time);
        $this->end_time = new DateTime($end_time);
        if($this->end_time < $this->start_time)
            throw new Exception('TimeBlock: Start time greater than end time.');
        $this->weekday = $weekday;
    }

    /**
     * @return DateTime
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @param DateTime $end_time
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
    }

    /**
     * @return DateTime
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * @param DateTime $start_time
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
    }

    /**
     * @return mixed
     */
    public function getWeekday()
    {
        return $this->weekday;
    }

    /**
     * @param mixed $weekday
     */
    public function setWeekday($weekday)
    {
        $this->weekday = $weekday;
    }

    /**
     * @param TimeBlock $block
     * @return bool
     */
    function overlaps(TimeBlock $block)
    {
        if($this->weekday != $block->weekday)
            return FALSE;
        if($this->start_time <= $block->start_time && $block->start_time <= $this->end_time)
            return TRUE;
        if($block->start_time <= $this->start_time && $this->start_time  <= $block->end_time)
            return TRUE;
        return FALSE;
    }
}