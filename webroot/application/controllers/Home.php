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
		$data['title'] = 'Homepage';
		$data['info_bar'] = '<i class="glyphicon glyphicon-info-sign"></i> Select a option!';
		$data['name'] = $this->session->userdata('firstname').' '.$this->session->userdata('lastname');

		$json = file_get_contents('http://api.nytimes.com/svc/topstories/v1/world.json?api-key=8d1c8aa8bc26b5bb7a282ac1029df999:11:74126097');
		$data['news'] = json_decode($json, TRUE)['results'];

		$this->load->model('semester');
		$data['semesters'] = $this->semester->getActiveSemesters();

		$this->load->view('layouts/header.php', $data);
		$this->load->view('student/home.php', $data);
		$this->load->view('layouts/footer.php');
	}

}
?>