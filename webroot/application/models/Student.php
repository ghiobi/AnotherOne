<?php

class Student extends CI_Model
{
    private $user_id;

    function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->user_id;
    }

    /**
     * Returns the name of the program the student is enrolled in.
     *
     * @return object
     */
    function getProgram()
    {
        $result = $this->db->query(
            "SELECT
              program.id,
              program.name
            FROM students
              INNER JOIN users
                ON students.user_id = users.id
              INNER JOIN program
                ON students.program_id = program.id
            WHERE users.id = '$this->user_id'");
        return $result->row();
    }

    /**
     * Returns the student id of a user. If user is not a student then it returns null.
     *
     * @return string
     */
    function getID()
    {
        $result = $this->db->query(
            "SELECT
              students.id
            FROM students
            WHERE students.user_id='$this->user_id' LIMIT 1");
        return $result->row()->id;
    }

    /**
     * Full detail of a student.
     * Returns student id, login name, first name, last name, email, and program name of a student.
     *
     * @return object
     */
    function getInfo()
    {
        $result = $this->db->query("
            SELECT
              students.id,
              users.login_name,
              users.firstname,
              users.lastname,
              users.email,
              program.name
            FROM students
              INNER JOIN users
                ON students.user_id = users.id
              INNER JOIN program
                ON students.program_id = program.id
            WHERE students.user_id ='$this->user_id' LIMIT 1");
        return $result->row();
    }

    /**
     * Gets the record of this student.
     *
     * @return associative array - returns an associative array, where the index is the semester name.
     */
    function getRecord()
    {
        $result = $this->getRegisteredSemesters();

        if(!$result)
            return FALSE;

        $record = [];

        $this->load->model('course');

        foreach($result as $row){
            $courses = [];
            foreach($this->getRecordBySemester($row->id) as $course){
                array_push($courses, [
                    'detail' => $this->course->getByID($course->course_id),
                    'grade' => $course->grade
                ]);
            }
            $record[$row->name] = $courses;
        }
        return $record;
    }

    /**
     * @return array of semester objects
     */
    function getRegisteredSemesters()
    {
        return $this->db->query("
            SELECT DISTINCT
              semesters.id,
              semesters.name
            FROM sections
              INNER JOIN semesters
                ON sections.semester_id = semesters.id
              INNER JOIN registered
                ON registered.section_id = sections.id
              INNER JOIN students
                ON registered.student_id = students.id
            WHERE students.user_id = '$this->user_id'
            ORDER BY sections.semester_id DESC")->result();
    }

    /**
     * Gets the registered sections in a particular semesters
     *
     * @param $semester_id - The semester to get
     * @return mixed
     */
    function getRecordBySemester($semester_id)
    {
        return $this->db->query("
            SELECT
              sections.course_id,
              sections.semester_id,
              registered.id,
              registered.section_id,
              registered.tutorial_id,
              registered.laboratory_id,
              registered.grade
            FROM registered
              INNER JOIN students
                ON registered.student_id = students.id
              INNER JOIN sections
                ON registered.section_id = sections.id
            WHERE sections.semester_id = '$semester_id' AND students.user_id = '$this->user_id'")->result();
    }

    /**
     * Returns array with info of course progress.
     *
     * @return array - Returns an array that contains associative arrays with
     *      - String => The course full name ex: 'SOEN 341 Software Process'
     *      - Boolean => Is completed course with a passing grade
     *      - Boolean => Can he take the course? (If course is already completed )
     */
    function getProgress()
    {
        $program = $this->getProgram();

        //Loading course model
        $this->load->model('course');
        $sequence = $this->course->getCourseSequence($program->id);

        $progress = [];

        foreach($sequence as $value)
        {
            $course = $this->course->getByID($value->course_id);

            array_push($progress, [
                'name' => $course->code ." ". $course->number." ".$course->name,
                'completed' => $this->isCompleted($value->course_id, $course->passing_grade),
                'takable' => $this->isTakable($value->course_id)
            ]);
        }

        return ['program_name' => $program->name, 'progress' => $progress];
    }

    /**
     * Determines if a course is completed with passing grade or going to be completed.
     *
     * @param $course_id
     * @return bool
     */
    function isCompleted($course_id, $passing_grade = '-C')
    {
        $result = $this->db->query("
            SELECT
              registered.grade
            FROM registered
              INNER JOIN students
                ON registered.student_id = students.id
              INNER JOIN sections
                ON registered.section_id = sections.id
            WHERE  sections.course_id='$course_id' AND students.user_id='$this->user_id'")->result();

        foreach($result as $value)
        {
            $grade = $value->grade;

            //If grade is empty or meaning in progress, it assumes he is going to complete it.
            if(!$grade)
                return true;

            //Check if passed the course @eric this doesn't work
            if(($grade==="A+"||"A"||"A-"||"B+"||"B"||"B-"||"C+"||"C"||"C-")&&!empty($grade) ){
                return true;
            }
        }
        return false;
    }

    /**
     * Determines if this student can take a course.
     * FIX: Doesn't take corequisite into account
     * @param $course_id
     * @return bool
     */
    function isTakable($course_id)
    {
        $this->load->model('course');
        $prereqs = $this->course->getPrerequisites($course_id);

        //Check if course prerequisites are completed
        foreach ($prereqs as $value)
        {
            $x = $value->prerequisite_course_id;

            if (!$this->isCompleted($x)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Checks if the student is registered in the course and has not completed it.
     *
     * note: this is almost just repeating isComplete. it is somewhat just the negation of iscomplete.
     *
     * @param $course_id
     * @return bool
     */
    function isRegistered($course_id)
    {
        $result=$this->db->query("
            SELECT
              registered.grade
              FROM registered
              INNER JOIN students
                ON registered.student_id = students.id
              INNER JOIN sections
                ON registered.section_id = sections.id
              WHERE  sections.course_id='$course_id' AND students.user_id='$this->user_id'")->result();

        foreach($result as $value)
        {
            $x=$value->grade;

            //Check if doesn't have a grade and is registered
            if(empty($x))
            {
                return true;
            }
        }
        return false;
    }

}