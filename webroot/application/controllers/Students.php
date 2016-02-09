<?php defined("BASEPATH") or exit("No direct script access allowed");
/**
* 	Controls the profile page, the enroll page and the schedule page
*/
class Students extends App_Base_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

    /**
     * Loads the student profile page
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

	/**
	 * Loads the student enroll page
	 */
	function enroll()
	{
        $data['info_bar'] = 'AND HIS NAME IS BOB SMITH';
		$this->load->view('layouts/header.php', $data);

		$this->load->view('student/scheduler.php');

		$data['add_js'] = ['moment.js', 'schedule.js', 'enroll.js'];
		$this->load->view('layouts/footer.php', $data);
	}

	function ajax_search_course(){
		$input = $this->input->post('input', TRUE);
		echo $input;
	}

	/**
	 * Loads the schedule of a semester by id
	 * @param $semester
	 */
	function schedule($semester){

	}

}
?>
