<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
* Redirects different types of users to correct views. TODO: complete description
*/
class Home extends App_Base_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->model('user');

		$data['name'] = $this->user->get_full_name($this->session->userdata('user_id'));

		$this->load->view('layouts/header.php');
		$this->load->view('student/home.php', $data);
		$this->load->view('layouts/footer.php');
	}

}
?>