<?php

namespace Scheduler;


class GroupSection
{
    private $course_id;

    private $instructor;
    private $capacity;
    private $letter;

    private $lecture;
    private $tutorial;
    private $laboratory;

    /**
     * SectionGroup constructor.
     * @param $course_id
     * @param $instructor
     * @param $capacity
     * @param $letter
     * @param $lecture
     * @param $tutorial
     * @param $laboratory
     */
    public function __construct($course_id, $instructor, $capacity, $letter, Lecture $lecture, Tutorial $tutorial = NULL, Laboratory $laboratory = NULL)
    {
        $this->course_id = $course_id;
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
     * Returns true if
     * @param GroupSection $sectionGroup
     * @return bool
     */
    public function overlaps(GroupSection $sectionGroup){

    }

}