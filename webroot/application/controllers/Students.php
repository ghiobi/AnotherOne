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

        //Loading footer
        $data['add_js'] = ['profile.js'];
        $this->load->view('layouts/footer.php', $data);
	}

	function enroll()
	{
        $data['info_bar'] = 'AND HIS NAME IS BOB SMITH';
		$this->load->view('layouts/header.php', $data);

		$this->load->view('student/scheduler.php');

		$data['add_js'] = ['jquery.schedule.js', 'enroll.js'];
		$this->load->view('layouts/footer.php', $data);
	}

	function ajax_search_course(){
		$input = $this->input->post('input', TRUE);
		echo $input;
	}

	function schedule($semester){

	}

}
?>
