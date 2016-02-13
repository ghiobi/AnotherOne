<?php
namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class TimeBlock -
 * @package Scheduler
 */
class Block
{
    private $id;
    private $room;
    private $start_time;
    private $end_time;
    private $weekday;

    /**
     * Block constructor.
     * @param $id
     * @param $room
     * @param $start_time
     * @param $end_time
     * @param $weekday
     */
    function __construct($id, $room, $start_time, $end_time, $weekday)
    {
        $this->id;
        $this->room;
        $this->start_time = new \DateTime($start_time);
        $this->end_time = new \DateTime($end_time);
        if($this->end_time < $this->start_time)
            throw new \InvalidArgumentException('TimeBlock: Start time is greater than end time.');
        if($weekday < 0 || $weekday > 6)
            throw new \InvalidArgumentException('TimeBlock: Invalid Weekday');
        $this->weekday = $weekday;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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

    /**
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * @param \DateTime $start_time
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
    }

    /**
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @param \DateTime $end_time
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
     * Returns true if a block overlaps another one.
     *
     * @param Block $block
     * @return bool
     */
    function overlaps(Block $block)
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