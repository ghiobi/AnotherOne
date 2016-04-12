<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  The section model deals with providing information about a sections in course.
 */
class Section extends CI_Model
{

    /**
     * Section constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns all sections in a semester of a course by the course subject and number
     *
     * @param $semester_id
     * @param null $course_code
     * @param null $course_number
     * @return array|bool
     */
    function getAllSections($semester_id, $course_code = NULL, $course_number = NULL)
    {
        $this->load->model('course');
        $this->db->cache_on();

        $result = [];

        if ($semester_id && !$course_code && !$course_number)
        {
            $courses = $this->course->getAvailableBySemester($semester_id);

            if(!$courses)
                return FALSE;

            foreach ($courses as $course){
                array_push($result, ['course' => $course, 'section' => $this->getSection($semester_id, $course->id)]);
            }

        }
        elseif ($semester_id && $course_code && !$course_number)
        {
            $courses = $this->course->getAvailableBySemesterSubject($semester_id, $course_code);

            if(!$courses)
                return FALSE;

            foreach ($courses as $course){
                array_push($result, ['course' => $course, 'section' => $this->getSection($semester_id, $course->id)]);
            }
        }
        else
        {
            if(!$course = $this->course->getByCodeNumber($course_code, $course_number))
                return FALSE;

            if(!$section = $this->getSection($semester_id, $course->id))
                return FALSE;

            array_push($result,['course' => $course, 'section' => $section]);
        }

        $this->db->cache_off();

        return $result;
    }

    /**
     *  Gets all sections of a course in a particular semester.
     *  Includes all the lectures, all labs and/or tutorials.
     *  Returns false if no data was found.
     *
     * @param $semester_id
     * @param $course_id
     * @return array|bool
     */
    function getSection($semester_id, $course_id)
    {
        $query = $this->db->query("
        SELECT
          *
        FROM sections
        WHERE semester_id = '$semester_id' AND course_id = '$course_id'");

        if($query->num_rows() == 0)
            return FALSE;

        $sections = [];

        $this->load->model('lecture');
        $this->load->model('tutorial');
        $this->load->model('laboratory');

        foreach ($query->result() as $row)
        {
            array_push($sections, [
                'sect' => $row,
                'lect' => $this->lecture->getLecturesBySectID($row->id),
                'tuts' => $this->tutorial->getTutorialsBySectID($row->id),
                'labs' => $this->laboratory->getLabsBySectID($row->id)
            ]);
        }

        return $sections;
    }

    /**
     * @param $section_id
     * @return mixed
     */
    function getBySectID($section_id)
    {
        return $this->db->query("
            SELECT
              *
            FROM sections
            WHERE id = '$section_id'")->row();
    }

}
