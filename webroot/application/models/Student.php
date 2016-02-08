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
     * Gets the program the student is enrolled in.
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
        $result = $this->db->query("
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
            ORDER BY sections.semester_id DESC");

        if($result->num_rows() == 0)
            return FALSE;

        $record = [];

        foreach($result->result() as $row){
            $record[$row->name] = $this->getRecordbySemester($row->id);
        }
        return $record;
    }

    /**
     * Gets the record of a student's semester by the semester's id
     *
     * @param $semester_id - The semester to get
     * @return mixed
     */
    function getRecordbySemester($semester_id)
    {
        return $this->db->query("
            SELECT
              courses.id,
              courses.code,
              courses.number,
              courses.name,
              courses.credit,
              registered.grade
            FROM registered
              INNER JOIN students
                ON registered.student_id = students.id
              INNER JOIN sections
                ON registered.section_id = sections.id
              INNER JOIN courses
                ON sections.course_id = courses.id
            WHERE sections.semester_id = '$semester_id' AND students.user_id = '$this->user_id'")->result();
    }

    /**
     * Returns true if the student is registered to the course
     *
     * @param $course_id
     */
    function isRegistered($course_id)
    {
        $this->db->query("

        ");
    }

    /**
     * Gets the progress to completing his program
     */
    function getProgramProgress()
    {
        $this->load('course');

        $this->course->getCourseSequence($this->getProgram()->id);

        //TODO
    }
}