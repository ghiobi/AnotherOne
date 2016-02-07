<?php

namespace Scheduler;


class Schedule
{
    private $courses;
    private $sectionGroups;

    /**
     * Schedule constructor.
     * @param $courses
     * @param $sectionGroups
     */
    public function __construct($courses, $sectionGroups)
    {
        $this->courses = $courses;
        $this->sectionGroups = $sectionGroups;
    }

    /**
     * @return mixed
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * @param mixed $courses
     */
    public function setCourses($courses)
    {
        $this->courses = $courses;
    }

    /**
     * @return mixed
     */
    public function getSectionGroups()
    {
        return $this->sectionGroups;
    }

    /**
     * @param mixed $sectionGroups
     */
    public function setSectionGroups($sectionGroups)
    {
        $this->sectionGroups = $sectionGroups;
    }


}