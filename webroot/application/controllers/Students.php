<?php defined("BASEPATH") or exit("No direct script access allowed");

/**
* 	TODO: complete description
*/
class Students extends App_Base_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

    /**
     * loads the student profile page
     */
	function profile()
    {
        $this->load->model('student');

        //Loading header
        $data['info_bar'] = 'AND HIS NAME IS JOHN CENA';
		$this->load->view('layouts/header.php', $data);

        //Loading content
		$data['info'] = $this->student->getInfo();
		$data['record'] = $this->student->getRecord();
		$this->load->view('student/profile.php',$data);

        $this->load->view('layouts/footer.php', $data);
	}

	function enroll($semester_url)
	{
		$semester_name = str_replace('-', ' ', $semester_url);

		//Loading models
		$this->load->model('semester');
		$this->load->model('scheduler');


		//Validating if semester name url exist. If not, redirect to main page.
		if(!$semester_id = $this->semester->getIDByName($semester_name))
			redirect(base_url());

		//If there the semester cookie already exists then load data from that of init a new scheduler object.
		if($this->session->userdata($semester_url) == NULL || $this->session->userdata($semester_url) == 'Reset')
		{
			//Initializing the scheduler because the cookie doesn't exist.
			$this->scheduler->init($semester_id);

			//After initializing the scheduler, it save the data into a session cookie.
			$this->session->set_userdata($semester_url, serialize($this->scheduler));
		}
		$data['title'] = strtoupper(substr($semester_name, 0 , 1)) . substr($semester_name, 1);
		$data['info_bar'] = 'Register in three simple steps. 1. Pick your courses 2. Generate 3. Commit!';

		$data['semester_name'] = $data['title'];
		$data['ajax_route'] = base_url('students/ajax/'.$semester_url);
		$data['add_js'] = ['schedule.js', 'enroll.js'];

		$this->load->view('layouts/header.php', $data);
		$this->load->view('student/scheduler.php', $data);
		$this->load->view('layouts/footer.php', $data);
	}

	function ajax($semester_url, $action){
		$this->load->model('scheduler');

		//Continue work on the scheduler model
		$this->scheduler = unserialize($this->session->userdata($semester_url));

		//Actions that can be performed to the scheduler object start here with

		switch ($action):

			//Returns information of preferences and the schedule.
			case 'load': {
				echo $this->scheduler->getMainSchedule();
			} break;

			//Returns a list of courses the user can take.
			case 'search': {
				echo 'Hello';
			} break;

			case 'addcourse': {

			} break;

			//Returns a list of possible schedules.
			case 'generate': {
				$schedules = $this->scheduler->generateSchedules();
				echo json_encode($schedules,  JSON_NUMERIC_CHECK);
			} break;

			case 'drop': {
				$hash_id = $this->input->post('input', TRUE);

				$section = $this->scheduler->dropSection($hash_id);

				echo $section;
			} break;

			case 'undo-drop': {
				$section = $this->input->post('input');

				$response = $this->scheduler->undoDropSection($section);

				echo ($response)? 'Re-added to section to schedule': 'Failed at re-adding section to schedule';
			} break;

			case'reset': {
				$this->session->unset_userdata($semester_url);
				echo 'Resetting Schedule';
				return;
			}

		endswitch;

		//Serialize the scheduler object model back to the cookie.
		$this->session->set_userdata($semester_url, serialize($this->scheduler));
	}

	function schedule($semester){

	}

}
?>
