<?php defined("BASEPATH") or exit("No direct script access allowed");
/**
* 	TODO: complete description
*/
class Student extends App_Base_Controller
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
        $this->load->model('StudentProfile');

        //Loading header
        $data['info_bar'] = 'AND HIS NAME IS JOHN CENA';
		$this->load->view('layouts/header.php', $data);

        //Loading content
		$data['userinfo'] = $this->StudentProfile->get_studentInfo();
		$this->load->view('student/profile.php',$data);

        //Loading footer
        $data['add_js'] = ['profile.js'];
        $this->load->view('layouts/footer.php', $data);
	}

	function register(){

	}

	function schedule($semester){

	}

}
?>
