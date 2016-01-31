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

    /**
     * @param $semester_name
     * @param $course_code
     * @param $course_number
     * @return array|bool
     */
    function getSectionsBySemesCodeNum($semester_name, $course_code, $course_number)
    {
        $this->db->cache_on();

        $query = $this->db->query("
            SELECT
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
                'lect' => $this->getLecturesBySectID($row['id']),
                'tuts' => $this->getTutorialsBySectID($row['id']),
                'labs' => $this->getLabsBySectID($row['id'])
            ]);
        }

        $this->load->model('course');

        $course = $this->course->getCourseByCodeNumber($course_code, $course_number);

        $this->db->cache_off();

        $data = [
            'course' => $course,
            'sections' => $sections
        ];

        return $data;
    }

    /**
     * @param $section_id
     * @return mixed
     */
    function getLecturesBySectID($section_id)
    {
        return $this->db->query("SELECT * FROM lectures WHERE section_id = '$section_id'")->result_array();
    }

    /**
     * @param $section_id
     * @return mixed
     */
    function getTutorialsBySectID($section_id)
    {
        return $this->db->query("SELECT * FROM tutorials WHERE section_id = '$section_id'")->result_array();
    }

    /**
     * @param $section_id
     * @return mixed
     */
    function getLabsBySectID($section_id)
    {
        return $this->db->query("SELECT * FROM laboratories WHERE section_id = '$section_id'")->result_array();
    }

}
?>