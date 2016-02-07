<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tutorial extends CI_Model
{

    function __construct()
    {
        parent::__construct();
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

    function getByID($tutorial_id)
    {
        return $this->db->query("
            SELECT
              *
            FROM tutorials
            WHERE id = '$tutorial_id'")->result();
    }

}