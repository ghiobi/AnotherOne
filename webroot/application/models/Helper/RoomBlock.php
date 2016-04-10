<?php
namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class RoomBlock takes care of location and time
 *
 * @package Scheduler
 */
class RoomBlock extends Block
{
    private $id;
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
        parent::__construct($start, $end, $weekday);
        $this->id = $id;
        $this->room = $room;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns true it overlaps another block
     *
     * @param Block $block
     * @return bool
     */
    public function overlaps(Block $block)
    {
        if($this->room == 'Online' || $block->room == 'Online')
            return FALSE;
        return parent::overlaps($block);
    }

}