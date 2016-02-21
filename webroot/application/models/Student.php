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
    function getRegisteredSemesters(){
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
     * TODO: @eric
     * Returns array with info of course progress.
     *
     * @return array - Returns an array that contains associative arrays with
     *      - String => The course full name ex: 'SOEN 341 Software Process'
     *      - Boolean => Is completed course with a passing grade
     *      - Boolean => Can he take the course? (If course is already completed )
     */
    function getProgress()
    {
        $program_id = $this->getProgram()->id;

        //Loading course model
        $this->load->model('course');

        $array = [];


        array_push($array, [
            'name' => 'SOEN 341 Software Process',
            'completed' => $this->isCompleted(31),
            'take' => false
        ]);

        //Please use the functions in the course model, and this.

        return $array;
    }

    /**
     * TODO: @eric
     * Determines if a course is completed with passing grade
     *
     * @param $course_id
     * @return bool
     */
    function isCompleted($course_id)
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

        var_dump($result);
        $grade=$result[0]->grade;
        var_dump($grade);


        if($result==="A+"){
            return true;
        }
        else
            return false;


    }

    /**
     * TODO: @eric
     * Determines if this student can take a course. INFO: Independent of student records
     * 
     * @param $course_id
     * @return bool
     */
    function isTakeable($course_id)
    {
        return TRUE;
    }

}