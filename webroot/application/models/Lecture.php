<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lecture extends CI_Model
{

    function __construct()
    {
        parent::__construct();
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

    function getByID($lecture_id)
    {
        return $this->db->query("
            SELECT
              *
            FROM lectures
            WHERE id = '$lecture_id'")->result();
    }

}