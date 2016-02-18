<?php
namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Laboratory
 * @package Scheduler
 */
class LaboratoryBlock extends Block
{
    public $instructor;
    public $letter;
    public $capacity;

    /**
     * LaboratoryBlock constructor.
     * @param $id
     * @param $instructor
     * @param $letter
     * @param $capacity
     * @param $room
     * @param $start_time
     * @param $end_time
     * @param $weekday
     */
    public function __construct($id, $instructor, $letter, $capacity, $room, $start_time, $end_time, $weekday)
    {
        parent::__construct($id, $room, $start_time, $end_time, $weekday);
        $this->instructor = $instructor;
        $this->letter = $letter;
        $this->capacity = $capacity;
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

}