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
    function getCourseByID($course_id){
        return $this->db->query("
            SELECT
              *
            FROM courses
            WHERE courses.id = '$course_id' LIMIT 1")->result_array()[0];
    }


    function getCoursePrereqs(){

    }

}