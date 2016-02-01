<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Course extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $course_code
     * @param $course_number
     * @return mixed
     */
    function getCourseByCodeNumber($course_code, $course_number){
        return $this->db->query("
            SELECT
              *
            FROM courses
            WHERE courses.code = '$course_code' AND courses.number = '$course_number' LIMIT 1")->result_array()[0];
    }

    /**
     * @param $course_id
     * @return mixed
     */
    function getCourseByID($course_id)
    {
        return $this->db->query("
            SELECT
              *
            FROM courses
            WHERE courses.id = '$course_id' LIMIT 1")->result_array()[0];
    }

    /**
     * @param $semester_name
     * @return mixed
     */
    function getCoursesBySemesterName($semester_name)
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
            WHERE semesters.name = '$semester_name'")->result_array();
    }

    /**
     *
     */
    function getCoursesBySemesterSubject($semester_name, $subject)
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
        WHERE semesters.name = '$semester_name' AND courses.code = '$subject' ")->result_array();
    }

    function getCoursePrereqs(){

    }

}