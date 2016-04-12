<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
 * 	This controller controls the home page.
 *
 *  It displays the according homepage depending on the user. This allows the user to be a student
 *  and admin at the same time.
*/
class Home extends App_Base_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Loads the home page
	 */
	public function index()
	{
		//Displays the title, info bar, and welcome message.
		$data['title'] = 'Homepage';
		$data['info_bar'] = '<i class="glyphicon glyphicon-info-sign"></i> Select an option!';
		$data['name'] = $this->session->userdata('firstname').' '.$this->session->userdata('lastname');

		//Requesting world news from the New York Times API
		error_reporting(0);
		if(! $json = file_get_contents('http://api.nytimes.com/svc/topstories/v1/world.json?api-key=8d1c8aa8bc26b5bb7a282ac1029df999:11:74126097'))
			$data['news'] = FALSE;
		else
			$data['news'] = json_decode($json, TRUE)['results'];

		//Getting active semesters.
		$this->load->model('semester');
		$data['semesters'] = $this->semester->getActiveSemesters();

		//If this is a student get their academic progress.
		$this->load->model('student');
		$data['progress'] = $this->student->getProgress();

		$this->load->view('layouts/header.php', $data);
		$this->load->view('student/home.php', $data);
		$this->load->view('layouts/footer.php');
	}

/*
	This was used to copy data of a semester semesters into other semesters.
	public function copy()
	{
		$semester_id = [1,2,3,4,5,6,9,10];

		//Selection all sections
		$sections = $this->db->query("
			SELECT
				*
			FROM sections")->result();

		foreach($semester_id as $semester)
		{
			foreach ($sections as $section) {

				$this->db->query("INSERT INTO
				sections (semester_id, course_id, letter, capacity, professor)
				VALUES ('$semester', '$section->course_id', '$section->letter', '$section->capacity', '$section->professor')");

				$last_id = $this->db->query("SELECT LAST_INSERT_ID() AS last_id")->row()->last_id;

				$lectures = $this->db->query("
					SELECT
					  *
					FROM lectures
					WHERE section_id = '$section->id'")->result();

				foreach ($lectures as $lecture) {
					$this->db->query("INSERT INTO lectures (section_id, room, start, end, weekday)
					VALUES ('$last_id', '$lecture->room', '$lecture->start', '$lecture->end', '$lecture->weekday')");
				}

				$tutorials = $this->db->query("
					SELECT
					  *
					FROM tutorials
					WHERE section_id = '$section->id'")->result();

				foreach ($tutorials as $tutorial) {
					$this->db->query("INSERT INTO tutorials (section_id, capacity, instructor, letter, room, start, end, weekday)
					VALUES ('$last_id','$tutorial->capacity',  '$tutorial->instructor', '$tutorial->letter', '$tutorial->room', '$tutorial->start', '$tutorial->end', '$tutorial->weekday')");
				}

				$laboratories = $this->db->query("
					SELECT
					  *
					FROM laboratories
					WHERE section_id = '$section->id'")->result();

				foreach ($laboratories as $laboratory) {
					$this->db->query("INSERT INTO laboratories (section_id, capacity, instructor, letter, room, start, end, weekday)
					VALUES ('$last_id', '$laboratory->capacity', '$laboratory->instructor', '$laboratory->letter', '$laboratory->room', '$laboratory->start', '$laboratory->end', '$laboratory->weekday')");
				}

			}

		}
	}*/

}
?>