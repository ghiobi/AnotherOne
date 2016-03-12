<?php
namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class RoomBlock takes care of location and time of blocks
 *
 * @package Scheduler
 */
class RoomBlock extends Block
{
    public $room;

    /**
     * RoomBlock constructor.
     * @param $id
     * @param $room
     * @param $start
     * @param $end
     * @param $weekday
     */
    function __construct($id, $room, $start, $end, $weekday)
    {
        parent::__construct($id, $start, $end, $weekday);
        $this->room = $room;
    }

    public function overlapsRoom(Block $block)
    {
        if($this->room == 'Online' || $block->room == 'Online')
            return FALSE;
        return $this->timeOverlaps($block);
    }

}