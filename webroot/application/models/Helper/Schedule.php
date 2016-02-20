<?php

namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Schedule
 * @package Scheduler
 */
class Schedule
{
    public $sections;
    public $unregistered;


    /**
     * Schedule constructor.
     * @param array $section
     * @param array $unregistered
     */
    public function __construct(array $section, array $unregistered)
    {
        $this->sections = $section;
        $this->unregistered = $unregistered;
    }

    /**
     * @return mixed
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param array $sections
     */
    public function setSections(Array $sections)
    {
        $this->sections = $sections;
    }

    /**
     * Adds a section to the schedule
     *
     * @param GroupSection $section
     * @return bool - Returns true if operation is successful
     */
    public function addSection(GroupSection $section)
    {
        //If section is empty or not set, meaning schedule is empty, do this.
        if(!$this->sections)
        {
            array_push($this->sections, $section);
            return TRUE;
        }

        foreach($this->sections as $current)
        {
            if($section->overlaps($current)) //If the section overlaps one of the current sections, return false.
                return FALSE;
        }

        array_push($this->sections, $section);

        return TRUE;
    }

    /**
     * Removes a section of the schedule
     *
     * @param $index
     * @return bool
     */
    public function removeSection($index)
    {
        if($index < 0 || $index > count($this->sections) - 1)
            return FALSE;

        $array = array_splice($this->sections, $index, 1); //array, index, number of blocks
        return $array;
    }

    public function addUnregistered($section)
    {
        if(!$this->unregistered && !$section)
        {
            array_push($this->unregistered, $section);
            return TRUE;
        }

        foreach($this->sections as $current)
        {
            if($current->overlaps($section))
                return FALSE;
        }

        foreach($this->unregistered as $current)
        {
            if($current->overlaps($section))
                return FALSE;
        }

        array_push($this->unregistered, $section);

        return TRUE;
    }

}