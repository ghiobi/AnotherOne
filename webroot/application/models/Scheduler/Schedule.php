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
        foreach($this->sections as $current)
        {
            if($section->overlaps($current))
                return FALSE;
        }

        array_push($this->sections, $section);

        return TRUE;
    }

    public function removeSection(){

    }

    public function toJSON(){
        return json_encode($this, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT );
    }

}