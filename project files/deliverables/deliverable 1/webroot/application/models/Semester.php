<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * The Semester model deals with getting data from the database.
 */
class Semester extends CI_Model{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns all semesters available in the database.
     *
     * @return array of objects
     */
    function getSemesters()
    {
        return $this->db->query("
            SELECT
              *
            FROM semesters
            ORDER BY semesters.end DESC")->result();
    }

    /**
     * Returns the semester if by the semester name
     *
     * @param $semester_name not case sensitive
     * @return string
     */
    function getIDByName($semester_name)
    {
        return $this->db->query("
            SELECT
              semesters.id
            FROM semesters
            WHERE semesters.name = '$semester_name'")->row()->id;
    }

    /**
     * Returns the complete semester detail of a semester.
     *
     * @param $semester_id
     * @return object
     */
    function getInfo($semester_id)
    {
        return $this->db->query("
            SELECT
              *
            FROM semesters
            WHERE semesters.id = '$semester_id'
            LIMIT 1")->row();
    }

    /**
     *  Returns a list of active semester where the ending semester is greater then now.
     *
     * @return array of objects
     */
    function getActiveSemesters()
    {
        return $this->db->query("
            SELECT
              *
            FROM semesters
            WHERE semesters.end >= NOW()")->result();
    }

}