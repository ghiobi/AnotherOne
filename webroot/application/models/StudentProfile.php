<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*  The Student Profile retrieves necessary data to construct a profile.
*/
class StudentProfile extends CI_Model
{

	private $user_id;

	function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->user_id;
	}

	function get_program(){
		$result = $this->db->query(
		"SELECT
		  program.name
		FROM students
		  INNER JOIN users
			ON students.user_id = users.id
		  INNER JOIN program
			ON students.program_id = program.id
		WHERE users.id = '$this->user_id'");
		return $result->row()->name;
	}

	function get_studentID(){
		$result = $this->db->query(
		"SELECT
		  students.id
		FROM students
		  INNER JOIN users
			ON students.user_id = users.id
		WHERE '$this->user_id' LIMIT 1");
		return $result->row()->id;
	}

	function get_studentInfo(){
		$result = $this->db->query("
		SELECT
		  students.id,
		  users.login_name,
		  users.firstname,
		  users.lastname,
		  users.email,
		  program.name
		FROM students
		  INNER JOIN users
			ON students.user_id = users.id
		  INNER JOIN program
			ON students.program_id = program.id
			WHERE '$this->user_id' LIMIT 1");
		return $result->row();
	}

	function get_semesters(){

	}

	function get_course_by_semester(){

	}


}
?>
