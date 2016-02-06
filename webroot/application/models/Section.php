<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  The section model deals with providing information about a sections in course
 */
class Section extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns all of courses in a semester or subject or precisely a course.
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
                array_push($result, ['course' => $course, 'section' => $this->getSection($semester_id, $course->code, $course->number)]);
            }

        }
        elseif ($semester_id && $course_code && !$course_number)
        {
            $courses = $this->course->getAvailableBySemesterSubject($semester_id, $course_code);

            if(!$courses)
                return FALSE;

            foreach ($courses as $course){
                array_push($result, ['course' => $course, 'section' => $this->getSection($semester_id, $course->code, $course->number)]);
            }
        }
        else
        {
            if(!$section = $this->getSection($semester_id, $course_code, $course_number))
                return FALSE;

            $course = $this->course->getByCodeNumber($course_code, $course_number);

            array_push($result,['course' => $course, 'section' => $section]);
        }

        $this->db->cache_off();

        return $result;
    }

    /**
     *  Gets full detail information of an individual section in a particular semester and course.
     *  Includes all the lectures, all labs and/or tutorials.
     *  Returns false if no data was found.
     *
     * @param $semester_id
     * @param $course_code
     * @param $course_number
     * @return array|bool
     */
    function getSection($semester_id, $course_code, $course_number)
    {
        $query = $this->db->query("
            SELECT
              sections.id,
              sections.letter,
              sections.professor,
              sections.capacity
            FROM sections
              INNER JOIN courses
                ON sections.course_id = courses.id
              INNER JOIN semesters
                ON sections.semester_id = semesters.id
            WHERE semesters.id = '$semester_id' AND courses.code = '$course_code' AND courses.number = '$course_number'");

        if($query->num_rows() == 0)
            return FALSE;

        $sections = [];

        foreach ($query->result() as $row)
        {
            array_push($sections, [
                'sect' => $row,
                'lect' => $this->getLecturesBySectID($row->id),
                'tuts' => $this->getTutorialsBySectID($row->id),
                'labs' => $this->getLabsBySectID($row->id)
            ]);
        }

        return $sections;
    }

    /**
     * Gets lectures of a section by id.
     *
     * @param $section_id
     * @return mixed
     */
    function getLecturesBySectID($section_id)
    {
        return $this->db->query("
            SELECT
              *
            FROM lectures
            WHERE section_id = '$section_id'")->result();
    }

    /**
     * Gets tutorials of section by id.
     *
     * @param $section_id
     * @return mixed
     */
    function getTutorialsBySectID($section_id)
    {
        return $this->db->query("
            SELECT
              *
            FROM tutorials
            WHERE section_id = '$section_id'")->result();
    }

    /**
     * Gets laboratories of a section by id.
     *
     * @param $section_id
     * @return mixed
     */
    function getLabsBySectID($section_id)
    {
        return $this->db->query("
            SELECT
              *
            FROM laboratories
            WHERE section_id = '$section_id'")->result();
    }

}
