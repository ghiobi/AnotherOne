<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Tutorial returns data from the database by section id or the tutorial id.
 */
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

    /**
     * Gets the tutorial by it's exact Id.
     *
     * @param $tutorial_id
     * @return mixed
     */
    function getByID($tutorial_id)
    {
        return $this->db->query("
            SELECT
              *
            FROM tutorials
            WHERE id = '$tutorial_id'")->row();
    }

}