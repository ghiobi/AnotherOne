<?php

namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule
{
    public $sections;

    /**
     * Schedule constructor.
     * @param array $section
     */
    public function __construct(array $section)
    {
        $this->sections = $section;
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
        $array = array_splice($this->sections, $index, 1);
        return $array == TRUE;
    }

    /**
     * Returns the current object into JSON
     *
     * @return string
     */
    public function toJSON(){
        return json_encode($this, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT );
    }

}