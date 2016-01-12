<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
* 
*/
class HomePage extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('user_id'))
		{
			redirect(base_url().'login');
		}
	}

	function index()
	{
		$this->load->model('user_model');

		$data['name'] = $this->user_model->getFullName($this->session->userdata('user_id'));

		$this->load->view('layouts/header.php');
		$this->load->view('users/student.php', $data);
		$this->load->view('layouts/footer.php');
	}

}
?>