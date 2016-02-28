<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
* Controls the student's home page.
*/
class Home extends App_Base_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * loads the home page
	 */
	function index()
	{
		$data['title'] = 'Homepage';
		$data['info_bar'] = '<i class="glyphicon glyphicon-info-sign"></i> Select an option!';
		$data['name'] = $this->session->userdata('firstname').' '.$this->session->userdata('lastname');

		$json = file_get_contents('http://api.nytimes.com/svc/topstories/v1/world.json?api-key=8d1c8aa8bc26b5bb7a282ac1029df999:11:74126097');
		$data['news'] = json_decode($json, TRUE)['results'];

		$this->load->model('semester');
		$data['semesters'] = $this->semester->getActiveSemesters();

		$this->load->view('layouts/header.php', $data);
		$this->load->view('student/home.php', $data);
		$this->load->view('layouts/footer.php');
	}

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
	}

}
?>