<?php

namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Schedule - holds data of valid schedule.
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
    public function removeSection($hash_id)
    {
        for($i = 0; $i < count($this->sections); $i++)
        {
            if($hash_id == $this->sections[$i]->hash){
                $clone = $this->sections[$i];
                array_splice($this->sections, $i, 1);
                return $clone;
            }
        }
        return FALSE;
    }

    public function addUnregistered($section)
    {
        if(!$this->unregistered && !$this->sections)
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

    /**
     * Returns an associative array of the registered courses.
     *
     * @return array
     */
    public function getCourseList()
    {
        $course_list = [];

        foreach($this->sections as $section)
        {
            $course_list[$section->getCourseId()] = $section->course_subject.' '.$section->course_number.' '.$section->course_name;
        }

        return $course_list;
    }

    public function overlapsUnregistered(PreferenceBlock $preference)
    {
        $all_blocks = [];

        foreach($this->unregistered as $current){
            $blocks = $current->getTimeBlocks();
            $all_blocks = array_merge($all_blocks, $blocks);
        }

        foreach($all_blocks as $block){
            if($preference->overlaps($block)){
                return TRUE;
            }
        }

        return FALSE;
    }

    public function overlapsRegistered(PreferenceBlock $preference){
        $all_blocks = [];

        foreach($this->sections as $current){
            $blocks = $current->getTimeBlocks();
            $all_blocks = array_merge($all_blocks, $blocks);
        }


        foreach($all_blocks as $block){
            if($preference->overlaps($block)){
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * @return mixed
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @return array
     */
    public function getUnregistered()
    {
        return $this->unregistered;
    }

    /**
     * @param array $unregistered
     */
    public function setUnregistered($unregistered)
    {
        $this->unregistered = $unregistered;
    }

    /**
     * @param array $sections
     */
    public function setSections($sections)
    {
        $this->sections = $sections;
    }


}