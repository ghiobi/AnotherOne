<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

    function getByID($lab_id)
    {
        return $this->db->query("
            SELECT
              *
            FROM laboratories
            WHERE id = '$lab_id'")->row();
    }

}