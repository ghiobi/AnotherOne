<?php

class Grade
{

    private $grade;
    private $passing_grade;

    CONST marks = [
        'A+' => 0,
        'A' => 1,
        'A-' => 2,
        'B+' => 3,
        'B' => 4,
        'B-' => 5,
        'C+' => 6,
        'C' => 7,
        'C-' => 8,
        'D+' => 9,
        'D' => 10,
        'D-' => 11,
        'F' => 12
    ];

    /**
     * Grade constructor.
     * @param $grade
     * @param $passing_grade
     */
    public function __construct($grade, $passing_grade)
    {
        $this->grade = $grade;
        $this->passing_grade = $passing_grade;
    }

    /**
     * @return mixed
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param mixed $grade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    /**
     * @return mixed
     */
    public function getPassingGrade()
    {
        return $this->passing_grade;
    }

    /**
     * @param mixed $passing_grade
     */
    public function setPassingGrade($passing_grade)
    {
        $this->passing_grade = $passing_grade;
    }

    public function passed()
    {
        if( ! $this->grade)
            return TRUE;

        if(SELF::marks[$this->grade] <= SELF::marks[$this->passing_grade])
            return TRUE;

        return FALSE;
    }

    public function valid($grade)
    {
        if(key_exists($grade, SELF::marks))
            return TRUE;
    }


}