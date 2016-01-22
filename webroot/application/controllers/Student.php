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

	//STEP 1: Manage the controller.
	function profile(){
		//TODO: Fill in the blank
		//$this->load->model('____');
		
		//TODO: fill in the blank
		//if(//__________->post('______')){
			//TODO: load model that deals with users for password
			//$this->load->model('____');
			//TODO: check password. etc...
		//}
		
		//TODO: Display the name of the person signed in ,from database, instead of dank meme
		$data['info_bar'] = 'AND HIS NAME IS JOHN CENA';
		$this->load->view('layouts/header.php', $data);
		//TODO edit profile php. Make it dynamic to the content it should be displaying.
		//load studentprofile controller and access student info
		$data['add_js'] = ['profile.js'];
		$this->load->model('StudentProfile');
		$data['userinfo']=$this->StudentProfile->get_studentInfo(); 
		$this->load->view('student/profile.php',$data);
		$this->load->view('layouts/footer.php', $data);

	}

	function register(){

	}

	function schedule($semester){

	}

}
?>
