<?php defined("BASEPATH") or exit("No direct script access allowed");

/**
* 	Controls the profile page, the enroll page and the schedule page
*/
class Students extends App_Base_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

    /**
     * Loads the student profile page
     */
	public function profile($data = NULL)
    {
        $this->load->model('student');

        //Loading header
        $data['info_bar'] = 'Student Profile';
		$this->load->view('layouts/header.php', $data);

        //Loading content
		$data['info'] = $this->student->getInfo();
		$data['record'] = $this->student->getRecord();
		$this->load->view('student/profile.php',$data);

        $this->load->view('layouts/footer.php', $data);
	}

	public function update_password(){

		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{

			$this->load->model('user');

			$old_password = $this->input->post('old_password', TRUE);
			$new_password = $this->input->post('new_password', TRUE);
			$confirm_password = $this->input->post('confirm_password', TRUE);

			//Validating and cleaning data
			$this->form_validation->set_rules('old_password', 'Login ID', 'trim|required');
			$this->form_validation->set_rules('new_password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');

			if($this->form_validation->run() === FALSE)
			{
				$this->profile();
				return;
			}

			if(!$result = $this->user->update_password($old_password, $new_password))
				$data['reset_msg'] = 'The old password seems to be incorrect.';
			else
				$data['reset_positive'] = 'Successfully updated the password!';

			$this->profile($data);
		}
	}

	/**
	 * Loads the student enroll page
	 */
	public function enroll($semester_url)
	{
		//Loading models
		$this->load->model('semester');
		$this->load->model('scheduler');

		//Validating if semester name url exist. If not, redirect to main page.
		if(!$semester = $this->semester->getBySlug($semester_url))
			redirect(base_url());

		//If the semester cookie already exists then load data from the cookie or initialize a new scheduler cookie.
		if($this->session->userdata($semester_url) == NULL)
		{
			//Initializing the scheduler object
			$this->scheduler->init($semester->id);

			//After initializing the scheduler, save the data into a session cookie.
			$this->session->set_userdata($semester_url, serialize($this->scheduler));
		}

		//Preparing data for view
		$data['title'] = $semester->name;
		$data['info_bar'] = 'Register in three simple steps. 1. Pick your courses 2. Generate 3. Commit!';

		$data['semester_name'] = $data['title'];
		$data['ajax_route'] = base_url('students/ajax/'.$semester_url);
		$data['add_js'] = ['schedule.js', 'enroll.js'];

		$this->load->view('layouts/header.php', $data);
		$this->load->view('student/scheduler.php', $data);
		$this->load->view('layouts/footer.php', $data);
	}

	public function ajax($semester_url, $action){
		//If the request is not an ajax request, it will redirect the user to the and error page.
		if(!$this->input->is_ajax_request()){
			$data['heading'] = '404 Page Not Found';
			$data['message'] =  '<p>Access denied.</p>';
			$this->load->view('errors/html/error_404.php', $data);
			return;
		}

		//Loads the scheduler model
		$this->load->model('scheduler');

		//Continue work on the scheduler model by extracting the data from the cookie
		$this->scheduler = unserialize($this->session->userdata($semester_url));

		//Actions that can be performed to the scheduler object start here with
		switch ($action):

			//Returns information of preferences and the schedule.
			case 'load': {
				echo $this->scheduler->getMainSchedule();
			} break;

			//Returns the course list to the user.
			case 'search-list': {
				echo $this->scheduler->searchCourseList();
			} break;

			//Adds a course the generator list. Empty string if successful
			case 'add-course': {
				$course = $this->input->post('input', TRUE);

				echo $this->scheduler->add_course($course);
			} break;

			//Auto-picks one course for the user.
			case 'auto-pick':{

				echo $this->scheduler->auto_pick_course();

			} break;

			//Commits the new schedule to the database. 'x' is a dummy data to indicate the commit is successful.
			case 'commit':{
				$new_schedule = $this->input->post('input', TRUE);
				if($this->scheduler->apply_new_schedule($new_schedule))
					echo 'x';
			}break;

			//Returns a list of possible schedules.
			case 'generate': {
				$schedules = $this->scheduler->generateSchedules();

				echo json_encode($schedules,  JSON_NUMERIC_CHECK);
			} break;

			//Drops the section from the schedule
			case 'drop': {
				$hash_id = $this->input->post('input', TRUE);
				$section = $this->scheduler->drop($hash_id);

				echo $section;
			} break;

			//Undos the drop of the section
			case 'undo-drop': {

				$section = $this->input->post('input');
				$response = $this->scheduler->undo_drop($section);

				echo ($response)? 'Re-added section to schedule': 'Failed at re-adding section to schedule';
			} break;

			//Resets the schedule by emptying the cookie.
			case 'reset': {
				$this->session->unset_userdata($semester_url);
				return;
			}

			//Removes the course from the generator list.
			case 'remove-course': {
				$course_id = $this->input->post('input', TRUE);

				echo $this->scheduler->remove_from_generator($course_id);
			} break;

			//Returns the full course list of registered and unregistered courses.
			case 'course-list': {
				echo $this->scheduler->get_course_list();
			} break;

			case 'add-preference': {
				$json_input = $this->input->post('input', TRUE);
				$message = $this->scheduler->addTimePreference($json_input);

				echo $message;
			} break;

			case 'remove-preference': {
				$hash_code = $this->input->post('input', TRUE);
				$message = $this->scheduler->removeTimePreference($hash_code);

				echo $message;
			} break;

			case 'get-preference': {
				echo $this->scheduler->getTimePreferences();
			} break;

			case 'reset': {
				$this->session->unset_userdata($semester_url);
				return;
			}

		endswitch;

		//Serialize the scheduler object model back to the cookie.
		$this->session->set_userdata($semester_url, serialize($this->scheduler));
	}

	/**
	 * Viewing the schedule of a semester.
	 *
	 * @param $semester_url - the semester url slug id.
	 */
	public function view($semester_url)
	{
		$this->load->model('semester');
		$this->load->model('scheduler');

		//Validates if the slug exists. If not, redirects to the main page, ideally redirect to 404.
		if(!$semester = $this->semester->getBySlug($semester_url))
			redirect(base_url());

		//If there the semester cookie already exists then load data from cookie or initialize a new scheduler cookie.
		if($this->session->userdata($semester_url) == NULL)
		{
			//Initializing the scheduler object
			$this->scheduler->init($semester->id);

			//Saving scheduler object into cookie
			$this->session->set_userdata($semester_url, serialize($this->scheduler));
		}

		$this->scheduler = unserialize($this->session->userdata($semester_url));

		$data['info_bar'] = 'Schedule for '.$semester->name;
		$data['title'] = 'Schedule of '.$semester->name;

		$data['schedule'] = $this->scheduler->getMainSchedule();

		$this->load->view('layouts/header.php', $data);
		$this->load->view('student/view_schedule.php', $data);
		$this->load->view('layouts/footer.php');
	}

}
?>
