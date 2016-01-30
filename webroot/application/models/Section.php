<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Section extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_semesters()
    {
        return $this->db->query("
			SELECT
			  semesters.name
			FROM semesters
			ORDER BY semesters.id DESC")->result();
    }

    function get_sections($semester_name, $course_code, $course_number)
    {
        $query = $this->db->query("SELECT
          sections.letter,
          sections.professor,
          sections.capacity,
          sections.id
        FROM sections
          INNER JOIN courses
            ON sections.course_id = courses.id
          INNER JOIN semesters
            ON sections.semester_id = semesters.id
        WHERE semesters.name = '$semester_name' AND courses.code = '$course_code' AND courses.number = '$course_number'");

        if($query->num_rows() == 0)
            return FALSE;

        $sections = [];
        foreach ($query->result_array() as $row) {
            array_push($sections, [
                'info' => $row,
                'lect' => $this->lect_by_sectionID($row['id']),
                'tuts' => $this->tut_by_sectionID($row['id']),
                'labs' => $this->labs_by_sectionID($row['id'])
            ]);
        }

        $course_info = $this->db->query("
        SELECT
          courses.code,
          courses.number,
          courses.name,
          courses.credit
        FROM courses
        WHERE courses.code = '$course_code' AND courses.number = '$course_number' LIMIT 1")->result_array()[0];

        $data = [
            'course_details' => $course_info,
            'sections' => $sections
        ];

        return $data;
    }

    function lect_by_sectionID($section_id)
    {
        $query = $this->db->query("SELECT * FROM lectures WHERE section_id = '$section_id'");
        if(!$query) return array();
        return $query->result_array();
    }

    function tut_by_sectionID($section_id)
    {
        $query = $this->db->query("SELECT * FROM tutorials WHERE section_id = '$section_id'");
        return $query->result_array();
    }
    function labs_by_sectionID($section_id)
    {
        $query = $this->db->query("SELECT * FROM laboratories WHERE section_id = '$section_id'");
        return $query->result_array();
    }


}
?>