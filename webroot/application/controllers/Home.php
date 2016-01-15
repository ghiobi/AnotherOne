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

		$data['name'] = $this->session->userdata('firstname').' '.$this->session->userdata('lastname');
		$data['title'] = 'Homepage';
		$data['info_bar'] = '<i class="glyphicon glyphicon-info-sign"></i> Select a option!';
		
		$this->load->view('layouts/header.php', $data);
		$this->load->view('student/home.php', $data);
		$this->load->view('layouts/footer.php');
	}

}
?>