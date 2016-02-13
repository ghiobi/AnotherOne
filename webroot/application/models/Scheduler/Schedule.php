<?php

namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule
{
    private $section;

    /**
     * Schedule constructor.
     * @param $section
     */
    public function __construct(Array $section)
    {
        $this->sectionGroups = $section;
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



}