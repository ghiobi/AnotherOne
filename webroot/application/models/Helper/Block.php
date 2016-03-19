<?php
namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Block takes care of location and time of blocks
 *
 * @package Scheduler
 */
class Block
{
    public $start;
    public $end;
    public $weekday;

    private $intStart;
    private $intEnd;

    /**
     * Block constructor.
     * @param $id
     * @param $room
     * @param $start
     * @param $end
     * @param $weekday
     */
    function __construct($start, $end, $weekday)
    {
        $this->start = $this->formatFromDB($start);
        $this->end = $this->formatFromDB($end);

        $this->intStart = $this->toMinutes($this->start);
        $this->intEnd = $this->toMinutes($this->end);

        if($this->intEnd < $this->intStart)
            throw new \InvalidArgumentException('TimeBlock: Start time is greater than end time.');
        if($weekday < 0 || $weekday > 6)
            throw new \InvalidArgumentException('TimeBlock: Invalid Weekday');
        $this->weekday = $weekday;
    }
    /**
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
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
        return $this->end;
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
     * Converts from HH:MM:SS to just HH:MM
     *
     * @param $time
     * @return string
     */
    private function formatFromDB($time)
    {
        $colon = strrpos($time, ':');
        return substr($time, 0, $colon);
    }

    private function toMinutes($time)
    {
        $colon = strpos($time, ':');

        $hours = substr($time, 0, $colon);
        $minutes = substr($time, $colon + 1, $colon + 3);

        return $hours * 60 + $minutes;
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
        if($this->intStart <= $block->intStart && $block->intStart <= $this->intEnd)
            return TRUE;
        if($block->intStart <= $this->intStart && $this->intStart  <= $block->intEnd)
            return TRUE;
        return FALSE;
    }


}