<?php

/**
 * Class Grade Deals with evaluating grades.
 */
class Grade
{

    private $grade;

    public static $marks = [
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
     * @throws Exception if it's an invalid grade
     */
    public function __construct($grade)
    {
        if(! $grade)
            $this->grade = $grade;
        elseif ( ! SELF::validate($grade))
            throw new Exception('Invalid Grade');
        $this->grade = $grade;
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

    public function passed($passing_grade)
    {
        if( ! SELF::validate($passing_grade))
            throw new Exception('Invalid Grade');

        if( ! $this->grade)
            return TRUE;

        if(SELF::$marks[$this->grade] <= SELF::$marks[$passing_grade])
            return TRUE;

        return FALSE;
    }

    public static function validate($grade)
    {
        if(key_exists($grade, SELF::$marks))
            return TRUE;
        return FALSE;
    }


}