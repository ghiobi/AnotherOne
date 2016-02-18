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
    public $room;
    public $start;
    public $end;
    public $weekday;

    /**
     * Block constructor.
     * @param $id
     * @param $room
     * @param $start
     * @param $end
     * @param $weekday
     */
    function __construct($id, $room, $start, $end, $weekday)
    {
        $this->id = $id;
        $this->room = $room;
        $this->start = new \DateTime($start);
        $this->end = new \DateTime($end);
        if($this->end < $this->start)
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
    public function getStart()
    {
        return $this->start->format('G:i');
    }

    /**
     * @param \DateTime $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end->format('G:i');
    }

    /**
     * @param \DateTime $end_time
     */
    public function setEnd($end_time)
    {
        $this->end = $end_time;
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
    public function overlaps(Block $block)
    {
        if($this->weekday != $block->weekday)
            return FALSE;
        if($this->start <= $block->start && $block->start <= $this->end)
            return TRUE;
        if($block->start <= $this->start && $this->start  <= $block->end)
            return TRUE;
        return FALSE;
    }


}