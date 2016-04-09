<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Laboratory deals with gettings laboratory data from the database.
 */
class Laboratory extends CI_Model
{

    function __construct()
    {
        parent::__construct();
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

    /**
     * Gets laboratory by id
     *
     * @param $lab_id
     * @return mixed
     */
    function getByID($lab_id)
    {
        return $this->db->query("
            SELECT
              *
            FROM laboratories
            WHERE id = '$lab_id'")->row();
    }

}