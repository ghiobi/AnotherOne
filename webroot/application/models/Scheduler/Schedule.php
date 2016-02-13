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

    public function toJSON(){
        return die(json_encode($this, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT ));
    }

}