<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  The course model deals with retrieving data about a courses.
 *  View available courses in a semester or  subject in a semester
 */
class Course extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns true if a particular course is available in a semester.
     *
     * @param $course_id
     * @param $semester_id
     * @return bool
     */
    function isAvailableInSemester($course_id, $semester_id)
    {
        $result = $this->db->query("
        SELECT
          COUNT(sections.id) AS result
        FROM sections
        WHERE sections.course_id = '$course_id' AND sections.semester_id = '$semester_id'")->row->result;
        return $result > 0;
    }

    /**
     * Check if course subject and number is valid.
     *
     * @param $course_code
     * @param $course_number
     * @return bool
     */
    function isValidCourse($course_code, $course_number)
    {
        $result = $this->db->query("
            SELECT
              COUNT(courses.id) AS result
            FROM courses
            WHERE courses.code = '$course_code' AND courses.number = '$course_number' LIMIT 1")->row();
        return $result->result == 1;
    }

    /**
     * Returns the id of course by course subject and number.
     *
     * @param $course_code
     * @param $course_number
     * @return string
     */
    function getIDByCodeNumber($course_code, $course_number)
    {
        return $this->db->query("
            SELECT
              course.id
            FROM courses
            WHERE courses.code = '$course_code' AND courses.number = '$course_number' LIMIT 1")->row()->id;
    }

    /**
     * Returns full details of a course by course subject and number.
     *
     * @param $course_code
     * @param $course_number
     * @return object
     */
    function getByCodeNumber($course_code, $course_number)
    {
        return $this->db->query("
            SELECT
              *
            FROM courses
            WHERE courses.code = '$course_code' AND courses.number = '$course_number' LIMIT 1")->row();
    }

    /**
     * Returns full details of a course by course id
     *
     * @param $course_id
     * @return object
     */
    function getByID($course_id)
    {
        return $this->db->query("
            SELECT
              *
            FROM courses
            WHERE courses.id = '$course_id' LIMIT 1")->row();
    }

    /**
     * Returns all courses and details about that course by semester id.
     *
     * @param $semester_name
     * @return array of objects
     */
    function getAvailableBySemester($semester_id)
    {
        return $this->db->query("
            SELECT DISTINCT
              courses.id,
              courses.code,
              courses.number,
              courses.name,
              courses.credit
            FROM sections
              INNER JOIN semesters
                ON sections.semester_id = semesters.id
              INNER JOIN courses
                ON sections.course_id = courses.id
            WHERE semesters.id = '$semester_id'")->result();
    }

    /**
     * Returns all available courses in a particular semester and subject
     *
     * @param $semester_id
     * @param $subject_code
     * @return array of objects
     */
    function getAvailableBySemesterSubject($semester_id, $subject_code)
    {
        return $this->db->query("
            SELECT DISTINCT
              courses.id,
              courses.code,
              courses.number,
              courses.name,
              courses.credit
            FROM sections
              INNER JOIN semesters
                ON sections.semester_id = semesters.id
              INNER JOIN courses
                ON sections.course_id = courses.id
            WHERE semesters.id = '$semester_id' AND courses.code = '$subject_code' ")->result();
    }

    /**
     * Returns a course's prerequisites
     *
     * @param $course_id
     * @return object->prerequisite_course_id
     */
    function getPrerequisites($course_id)
    {
        return $this->db->query("
            SELECT
              courseprequisites.prerequisite_course_id
            FROM courseprequisites
            WHERE courseprequisites.course_id = 32")->result();
    }

    /**
     * Returns the course sequence of a selected program
     *
     * @param $program_id
     */
    function getCourseSequence($program_id){
        $this->db->query("
            SELECT
              programsequence.course_id
            FROM programsequence
            WHERE programsequence.program_id = '$program_id'")->result();
    }

}