<?php
namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class TimeBlock -
 * @package Scheduler
 */
class TimeBlock
{

    private $id;
    private $start_time;
    private $end_time;
    private $weekday;

    /**
     * TimeBlock constructor.
     * @param $start_time
     * @param $end_time
     * @param $weekday
     * @throws Exception If start time is greater than end time.
     */
    function __construct($id, $room, $start_time, $end_time, $weekday)
    {
        $this->start_time = new \DateTime($start_time);
        $this->end_time = new \DateTime($end_time);
        if($this->end_time < $this->start_time)
            throw new \InvalidArgumentException('TimeBlock: Start time is greater than end time.');
        if($weekday < 0 || $weekday > 6)
            throw new \InvalidArgumentException('TimeBlock: Invalid Weekday');
        $this->weekday = $weekday;
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
     * Returns true if a time block overlaps anotherone one.
     *
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