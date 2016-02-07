<?php
/**
 * Created by PhpStorm.
 * User: TheChosenOne
 * Date: 2016-02-06
 * Time: 7:52 PM
 */

namespace Scheduler;


/**
 * Class Laboratory
 * @package Scheduler
 */
class LaboratoryBlock extends TimeBlock
{
    private $id;
    private $instructor;
    private $letter;
    private $capacity;
    private $room;

    /**
     * LaboratoryBlock constructor.
     * @param $instructor
     * @param $letter
     * @param $capacity
     * @param $room
     * @param $start_time
     * @param $end_time
     * @param $weekday
     */
    public function __construct($instructor, $letter, $capacity, $room, $start_time, $end_time, $weekday)
    {
        parent::__construct($start_time, $end_time, $weekday);
        $this->instructor = $instructor;
        $this->letter = $letter;
        $this->capacity = $capacity;
        $this->room = $room;
    }


    /**
     * @return mixed
     */
    public function getInstructor()
    {
        return $this->instructor;
    }

    /**
     * @param mixed $instructor
     */
    public function setInstructor($instructor)
    {
        $this->instructor = $instructor;
    }

    /**
     * @return mixed
     */
    public function getLetter()
    {
        return $this->letter;
    }

    /**
     * @param mixed $letter
     */
    public function setLetter($letter)
    {
        $this->letter = $letter;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
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