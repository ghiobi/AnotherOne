<?php
namespace Scheduler;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GroupSection
{
    private $course_id;
    private $register_id;
    public $hash;
    public $course_name;
    public $course_subject;
    public $course_number;

    private $section_id;

    public $instructor;
    public $capacity;
    public $letter;

    public $lecture;
    public $tutorial;
    public $laboratory;

    /**
     * GroupSection constructor.
     * @param $register_id
     * @param $course_id
     * @param $section_id
     * @param $instructor
     * @param $capacity
     * @param $letter
     * @param $lecture
     * @param TutorialBlock|NULL $tutorial
     * @param LaboratoryBlock|NULL $laboratory
     */
    public function __construct($register_id, $course_id, $course_name, $course_subject, $course_number, $section_id,
                                $instructor, $capacity, $letter, $lecture, TutorialBlock $tutorial = NULL, LaboratoryBlock $laboratory = NULL)
    {
        $this->register_id = $register_id;
        if($register_id != NULL)
            $this->hash = hash('ripemd128' ,$register_id);
        $this->course_id = $course_id;
        $this->course_name = $course_name;
        $this->course_subject = $course_subject;
        $this->course_number = $course_number;
        $this->section_id = $section_id;
        $this->instructor = $instructor;
        $this->capacity = $capacity;
        $this->letter = $letter;
        $this->lecture = $lecture;
        $this->tutorial = $tutorial;
        $this->laboratory = $laboratory;
    }

    /**
     * Returns the register id.
     *
     * @return integer
     */
    public function getRegisterId()
    {
        return $this->register_id;
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

    /**
     * @param mixed $laboratory
     */
    public function setLaboratory($laboratory)
    {
        $this->laboratory = $laboratory;
    }

    /**
     * Returns all the blocks for this group section
     * @return array
     */
    public function getTimeBlocks()
    {
        $array = [];
        foreach ($this->lecture as $lect)
            array_push($array, $lect);
        if($this->tutorial != NULL)
            array_push($array, $this->tutorial);
        if($this->laboratory != NULL)
            array_push($array, $this->laboratory);
        return $array;
    }

    /**
     * Returns true if
     * @param GroupSection $sectionGroup
     * @return bool
     */
    public function overlaps(GroupSection $sectionGroup)
    {
        $thisGroup = $this->getTimeBlocks();
        $thatGroup = $sectionGroup->getTimeBlocks();

        foreach($thisGroup as $thisG)
        {
            foreach($thatGroup as $thatG)
            {
                if($thisG->overlaps($thatG))
                    return TRUE;
            }
        }
        return FALSE;
    }

}