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

    function get_available_semesters()
    {
        return $this->db->query("
			SELECT
			  semesters.name
			FROM semesters
			ORDER BY semesters.id DESC")->result();
    }

    function section_data($semester_name, $course_code, $course_number)
    {
        $query = $this->db->query("SELECT
          courses.code,
          courses.number,
          courses.name,
          courses.credit,
          sections.letter,
          sections.professor,
          sections.capacity,
          sections.id
        FROM sections
          INNER JOIN courses
            ON sections.course_id = courses.id
          INNER JOIN semesters
            ON sections.semester_id = semesters.id
        WHERE semesters.name = '$semester_name' AND courses.code = '$course_code' AND courses.number = '$course_number'
    	");
        if($query->num_rows() == 0)
            return FALSE;
        $data = [];
        foreach ($query->result_array() as $row) {
            $data[$row['id']]['detail'] = $row;
            $data[$row['id']]['lect'] = $this->lect_by_section($row['id']);
            $data[$row['id']]['tuts'] = $this->tut_by_section($row['id']);
            $data[$row['id']]['labs'] = $this->labs_by_section($row['id']);
        }
        return $data;
    }

    function lect_by_section($section_id)
    {
        $query = $this->db->query("SELECT * FROM lectures WHERE section_id = '$section_id'");
        if(!$query) return array();
        return $query->result_array();
    }

    function tut_by_section($section_id)
    {
        $query = $this->db->query("SELECT * FROM tutorials WHERE section_id = '$section_id'");
        return $query->result_array();
    }
    function labs_by_section($section_id)
    {
        $query = $this->db->query("SELECT * FROM laboratories WHERE section_id = '$section_id'");
        return $query->result_array();
    }


}
?>