<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class Semester
 */
class Semester extends CI_Model{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    function getSemesters()
    {
        return $this->db->query("
            SELECT
              *
            FROM semesters
            ORDER BY semesters.id DESC")->result();
    }

}