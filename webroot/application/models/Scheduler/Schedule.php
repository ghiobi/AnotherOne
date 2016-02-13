<?php

namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule
{
    private $section;

    /**
     * Schedule constructor.
     * @param array $section
     */
    public function __construct(array $section)
    {
        $this->section = $section;
    }

    /**
     * @return mixed
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param array $section
     */
    public function setSection(Array $section)
    {
        $this->section = $section;
    }

    public function toJSON()
    {
        $array = [];
        foreach($this->section as $section)
        {
            array_push($array, $section->toArray());
        }
        return json_encode($array);
    }

}