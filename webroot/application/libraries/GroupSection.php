<?php

namespace Scheduler;


class GroupSection
{
    private $course_id;
    private $section_id;

    private $instructor;
    private $capacity;
    private $letter;

    private $lecture;
    private $tutorial;
    private $laboratory;

    /**
     * GroupSection constructor.
     * @param $course_id
     * @param $section_id
     * @param $instructor
     * @param $capacity
     * @param $letter
     * @param Lecture $lecture
     * @param Tutorial|NULL $tutorial
     * @param Laboratory|NULL $laboratory
     */
    public function __construct($course_id, $section_id, $instructor, $capacity, $letter, Lecture $lecture, Tutorial $tutorial = NULL, Laboratory $laboratory = NULL)
    {
        $this->course_id = $course_id;
        $this->section_id = $section_id;
        $this->instructor = $instructor;
        $this->capacity = $capacity;
        $this->letter = $letter;
        $this->lecture = $lecture;
        $this->tutorial = $tutorial;
        $this->laboratory = $laboratory;
    }

    /**
     * @return mixed
     */
    public function getCourseId()
    {
        return $this->course_id;
    }

    /**
     * @param mixed $course_id
     */
    public function setCourseId($course_id)
    {
        $this->course_id = $course_id;
    }

    /**
     * @return mixed
     */
    public function getSectionId()
    {
        return $this->section_id;
    }

    /**
     * @param mixed $section_id
     */
    public function setSectionId($section_id)
    {
        $this->section_id = $section_id;
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
    public function getLecture()
    {
        return $this->lecture;
    }

    /**
     * @param mixed $lecture
     */
    public function setLecture($lecture)
    {
        $this->lecture = $lecture;
    }

    /**
     * @return mixed
     */
    public function getTutorial()
    {
        return $this->tutorial;
    }

    /**
     * @param mixed $tutorial
     */
    public function setTutorial($tutorial)
    {
        $this->tutorial = $tutorial;
    }

    /**
     * @return mixed
     */
    public function getLaboratory()
    {
        return $this->laboratory;
    }

    public function getTimeBlocks()
    {
        $array = [];
        array_push($array, $this->lecture);
        if(!$this->tutorial)
            array_push($array, $this->tutorial);
        if(!$this->laboratory)
            array_push($array, $this->laboratory);
        return $array;
    }

    /**
     * @param mixed $laboratory
     */
    public function setLaboratory($laboratory)
    {
        $this->laboratory = $laboratory;
    }

    /**
     * Returns true if
     * @param GroupSection $sectionGroup
     * @return bool
     */
    public function overlaps(GroupSection $sectionGroup){
        $thisGroup = $this->getTimeBlocks();
        $thatGroup = $sectionGroup->getTimeBlocks();

        foreach($thisGroup as $thisG)
        {
            foreach($thatGroup as $thatG)
            {
                if($thisG.overlaps($thatG))
                    return TRUE;
            }
        }

    }

}